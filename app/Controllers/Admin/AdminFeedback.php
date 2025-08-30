<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminFeedback extends BaseController
{
    /**
     * Check if current user has permission for specific action
     */
    private function checkPermission($permission)
    {
        $currentRole = session()->get('admin_role');
        
        if (!$currentRole) {
            return false;
        }
        
        // Superadmin has all permissions
        if (strtolower($currentRole) === 'superadmin') {
            return true;
        }
        
        try {
            $roleModel = new \App\Models\RoleModel();
            $role = $roleModel->getRoleByName($currentRole);
            
            if ($role && !empty($role['permissions'])) {
                $permissions = json_decode($role['permissions'], true) ?: [];
                return isset($permissions[$permission]) && $permissions[$permission] === true;
            }
        } catch (\Exception $e) {
            log_message('error', 'Permission check error: ' . $e->getMessage());
        }
        
        return false;
    }

    public function index()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('feedback_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }
        
        $feedbackModel = new FeedbackModel();
        $feedbacks = $feedbackModel->orderBy('created_at', 'DESC')->findAll();
        
        $data = [
            'title' => 'Kelola Feedback',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'feedbacks' => $feedbacks,
            'active_page' => 'feedback'
        ];
        
        return view('admin/feedback/feedback_list', $data);
    }

    public function view($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('feedback_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }
        
        $feedbackModel = new FeedbackModel();
        $feedback = $feedbackModel->find($id);
        
        if (!$feedback) {
            return redirect()->to('/admin/feedback')->with('error', 'Feedback tidak ditemukan');
        }
        
        // Update status to 'dibaca' if still pending
        if ($feedback['status'] === 'pending') {
            $feedbackModel->update($id, ['status' => 'dibaca']);
            $feedback['status'] = 'dibaca';
        }
        
        $data = [
            'title' => 'Detail Feedback',
            'admin_nama' => session()->get('admin_nama'),
            'admin_role' => session()->get('admin_role'),
            'feedback' => $feedback,
            'active_page' => 'feedback'
        ];
        
        return view('admin/feedback/feedback_detail', $data);
    }

    public function updateStatus($id)
    {
        if (!session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        // Check permission
        if (!$this->checkPermission('feedback_management')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Anda tidak memiliki akses untuk fitur ini!']);
        }
        
        $status = $this->request->getPost('status');
        $validStatuses = ['pending', 'dibaca', 'dibalas', 'selesai'];
        
        if (!in_array($status, $validStatuses)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid']);
        }
        
        $feedbackModel = new FeedbackModel();
        $feedbackModel->update($id, ['status' => $status]);
        
        return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil diperbarui']);
    }

    public function delete($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('feedback_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }
        
        $feedbackModel = new FeedbackModel();
        $feedback = $feedbackModel->find($id);
        
        if ($feedback) {
            // Delete file if exists
            if ($feedback['file_lampiran'] && file_exists(ROOTPATH . 'public/uploads/feedback/' . $feedback['file_lampiran'])) {
                unlink(ROOTPATH . 'public/uploads/feedback/' . $feedback['file_lampiran']);
            }
            
            $feedbackModel->delete($id);
            return redirect()->to('/admin/feedback')->with('success', 'Feedback berhasil dihapus');
        }
        
        return redirect()->to('/admin/feedback')->with('error', 'Feedback tidak ditemukan');
    }

    public function export($type = 'pdf')
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        // Check permission
        if (!$this->checkPermission('feedback_management')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk fitur ini!');
            return redirect()->to('/admin/dashboard');
        }

        $feedbackModel = new FeedbackModel();
        $feedbacks = $feedbackModel->orderBy('created_at', 'DESC')->findAll();

        if ($type === 'pdf') {
            return $this->exportPDF($feedbacks);
        } elseif ($type === 'excel') {
            return $this->exportExcel($feedbacks);
        } else {
            return redirect()->to('/admin/feedback')->with('error', 'Format export tidak valid');
        }
    }

    private function exportPDF($feedbacks)
    {
        // Create PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        // Generate HTML content
        $html = $this->generatePDFContent($feedbacks);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF
        $dompdf->stream('feedback_report_' . date('Y-m-d_H-i-s') . '.pdf', ['Attachment' => false]);
    }

    private function exportExcel($feedbacks)
    {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Sistem Informasi Pasar Modern')
            ->setLastModifiedBy('Admin')
            ->setTitle('Laporan Feedback')
            ->setSubject('Data Feedback Pengguna')
            ->setDescription('Laporan feedback dari pengguna sistem informasi pasar modern');

        // Set headers
        $headers = ['No', 'Nama', 'Email', 'Subjek', 'Pesan', 'Status', 'File Lampiran', 'Tanggal Dibuat'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $col++;
        }

        // Style header
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('E2E8F0');

        // Add data
        $row = 2;
        foreach ($feedbacks as $index => $feedback) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $feedback['nama']);
            $sheet->setCellValue('C' . $row, $feedback['email']);
            $sheet->setCellValue('D' . $row, $feedback['subjek']);
            $sheet->setCellValue('E' . $row, $feedback['pesan']);
            $sheet->setCellValue('F' . $row, ucfirst($feedback['status']));
            $sheet->setCellValue('G' . $row, $feedback['file_lampiran'] ?: '-');
            $sheet->setCellValue('H' . $row, date('d/m/Y H:i', strtotime($feedback['created_at'])));
            $row++;
        }

        // Add borders
        $sheet->getStyle('A1:H' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'feedback_report_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    private function generatePDFContent($feedbacks)
    {
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Laporan Feedback</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .header h1 { color: #333; margin-bottom: 5px; }
                .header p { color: #666; margin: 0; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f8f9fa; font-weight: bold; }
                .status-pending { color: #ffc107; }
                .status-dibaca { color: #17a2b8; }
                .status-dibalas { color: #28a745; }
                .status-selesai { color: #6c757d; }
                .footer { margin-top: 30px; text-align: center; color: #666; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Laporan Feedback</h1>
                <p>Sistem Informasi Pasar Modern</p>
                <p>Tanggal: ' . date('d/m/Y H:i') . '</p>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($feedbacks as $index => $feedback) {
            $statusClass = 'status-' . $feedback['status'];
            $html .= '
                    <tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . htmlspecialchars($feedback['nama']) . '</td>
                        <td>' . htmlspecialchars($feedback['email']) . '</td>
                        <td>' . htmlspecialchars($feedback['subjek']) . '</td>
                        <td class="' . $statusClass . '">' . ucfirst($feedback['status']) . '</td>
                        <td>' . date('d/m/Y H:i', strtotime($feedback['created_at'])) . '</td>
                    </tr>';
        }

        $html .= '
                </tbody>
            </table>
            
            <div class="footer">
                <p>Total Feedback: ' . count($feedbacks) . '</p>
                <p>Dicetak pada: ' . date('d/m/Y H:i:s') . '</p>
            </div>
        </body>
        </html>';

        return $html;
    }
} 