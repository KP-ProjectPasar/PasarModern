// Feedback List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchFeedback');
    const feedbackRows = document.querySelectorAll('.feedback-row');
    const filterButtons = document.querySelectorAll('[data-filter]');

    // Search functionality
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            feedbackRows.forEach(row => {
                const name = row.querySelector('.feedback-name')?.textContent.toLowerCase() || '';
                const email = row.querySelector('.feedback-email')?.textContent.toLowerCase() || '';
                const subject = row.querySelector('.feedback-subject')?.textContent.toLowerCase() || '';
                const status = row.querySelector('.feedback-status')?.textContent.toLowerCase() || '';
                
                const matches = name.includes(searchTerm) || 
                               email.includes(searchTerm) || 
                               subject.includes(searchTerm) || 
                               status.includes(searchTerm);
                
                row.style.display = matches ? '' : 'none';
            });
        });
    }

    // Filter functionality
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter rows
            feedbackRows.forEach(row => {
                const status = row.querySelector('.feedback-status')?.textContent.toLowerCase() || '';
                
                if (filter === 'all' || status.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // Status update functionality
    window.updateFeedbackStatus = function(id, status) {
        fetch(`/admin/feedback/update-status/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `status=${status}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the status display
                const statusElement = document.querySelector(`[data-feedback-id="${id}"] .feedback-status`);
                if (statusElement) {
                    statusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                    statusElement.className = `feedback-status badge bg-${getStatusColor(status)}`;
                }
                
                // Show success message
                showAlert('Status berhasil diperbarui!', 'success');
                
                // Reload page after 1 second to update stats
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showAlert(data.message || 'Gagal memperbarui status!', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat memperbarui status!', 'error');
        });
    };

    // Delete functionality
    window.deleteFeedback = function(id, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus feedback dari "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            window.location.href = `/admin/feedback/delete/${id}`;
        }
    };

    // Export functionality
    window.exportFeedback = function() {
        // Create export options modal
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'exportModal';
        modal.innerHTML = `
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-download me-2"></i>
                            Export Data Feedback
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted mb-3">Pilih format export yang diinginkan:</p>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary btn-lg" onclick="exportToPDF()">
                                <i class="bi bi-file-pdf me-2"></i>
                                Export ke PDF
                            </button>
                            <button type="button" class="btn btn-outline-success btn-lg" onclick="exportToExcel()">
                                <i class="bi bi-file-excel me-2"></i>
                                Export ke Excel
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Show modal
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
        
        // Remove modal from DOM after hidden
        modal.addEventListener('hidden.bs.modal', function() {
            document.body.removeChild(modal);
        });
    };

    // Export to PDF
    window.exportToPDF = function() {
        window.open('/admin/feedback/export/pdf', '_blank');
        const modal = bootstrap.Modal.getInstance(document.getElementById('exportModal'));
        if (modal) modal.hide();
    };

    // Export to Excel
    window.exportToExcel = function() {
        window.open('/admin/feedback/export/excel', '_blank');
        const modal = bootstrap.Modal.getInstance(document.getElementById('exportModal'));
        if (modal) modal.hide();
    };

    // Helper function to get status color
    function getStatusColor(status) {
        switch (status) {
            case 'pending': return 'warning';
            case 'dibaca': return 'info';
            case 'dibalas': return 'primary';
            case 'selesai': return 'success';
            default: return 'secondary';
        }
    }

    // Helper function to show alerts
    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.parentNode.removeChild(alertDiv);
            }
        }, 5000);
    }
});
