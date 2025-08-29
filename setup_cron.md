# Setup Cron Job untuk Update Harga Otomatis

## Sistem yang Sudah Dibuat

✅ **MarketPriceService**: Service untuk update harga otomatis  
✅ **UpdateHargaAuto Command**: Command untuk menjalankan update  
✅ **Batch/Shell Script**: Script untuk cron job  
✅ **Simulasi Data Pasar**: Data harga realistis dari berbagai sumber  

## Cara Setup Cron Job

### **A. Windows (Task Scheduler)**

1. **Buka Task Scheduler**
   - Tekan `Win + R`, ketik `taskschd.msc`
   - Atau cari "Task Scheduler" di Start Menu

2. **Create Basic Task**
   - Klik "Create Basic Task" di panel kanan
   - Nama: "Update Harga Komoditas"
   - Description: "Update harga otomatis setiap pagi jam 6:00"

3. **Set Trigger**
   - Daily → Next → Start time: 06:00:00
   - Recur every: 1 days

4. **Set Action**
   - Start a program
   - Program: `C:\Users\Yongky\OneDrive\Documents\PasarModern\cron_harga_update.bat`

5. **Finish**
   - Review settings dan klik Finish

### **B. Linux/Mac (Cron)**

1. **Edit Crontab**
   ```bash
   crontab -e
   ```

2. **Tambahkan Line Berikut**
   ```bash
   # Update harga komoditas setiap pagi jam 6:00
   0 6 * * * /path/to/your/project/PasarModern/cron_harga_update.sh
   ```

3. **Save dan Exit**
   - Tekan `Ctrl + X`, lalu `Y`, lalu `Enter`

### **C. Manual Testing**

1. **Test Command**
   ```bash
   php spark harga:update-auto
   ```

2. **Test dengan Dry Run**
   ```bash
   php spark harga:update-auto --dry-run
   ```

3. **Test Komoditas Tertentu**
   ```bash
   php spark harga:update-auto --komoditas="Beras"
   ```

## Sumber Data Harga (Gratis)

### **1. Simulasi BPS** 📊
- **Beras**: Rp 12.000 - 15.000/kg
- **Gula**: Rp 1.000 - 1.500/kg
- **Minyak**: Rp 8.000 - 12.000/liter
- **Telur**: Rp 2.000 - 3.000/kg
- **Daging**: Rp 80.000 - 120.000/kg
- **Ayam**: Rp 25.000 - 35.000/kg
- **Ikan**: Rp 15.000 - 25.000/kg
- **Sayuran**: Rp 5.000 - 15.000/kg
- **Buah**: Rp 10.000 - 30.000/kg

### **2. Simulasi Pasar Induk** 🏪
- **Sayuran**: ±15% variasi harian
- **Buah**: ±15% variasi harian
- **Daging**: ±15% variasi harian
- **Lainnya**: ±15% variasi harian

### **3. Fallback Default** 🔄
- Jika sumber lain gagal, gunakan harga terbaru + variasi ±5%

## Monitoring dan Log

### **1. Log File**
- **Location**: `writable/logs/`
- **Files**: 
  - `log-YYYY-MM-DD.php` (CodeIgniter logs)
  - `cron_harga_update.log` (Cron execution logs)

### **2. Command Monitoring**
```bash
# Lihat log terbaru
tail -f writable/logs/cron_harga_update.log

# Lihat log CodeIgniter
tail -f writable/logs/log-$(date +%Y-%m-%d).php
```

### **3. Dashboard Monitoring**
- Admin panel akan menampilkan:
  - Total komoditas
  - Komoditas dengan foto
  - Update terakhir
  - Status perubahan harga

## Troubleshooting

### **1. Command Tidak Ditemukan**
```bash
# Pastikan di directory project
cd /path/to/PasarModern

# Test command
php spark list
php spark harga:update-auto --help
```

### **2. Permission Error**
```bash
# Linux/Mac: Buat script executable
chmod +x cron_harga_update.sh

# Windows: Run as Administrator
```

### **3. Path Error**
- Update path di `cron_harga_update.bat` dan `cron_harga_update.sh`
- Pastikan path sesuai dengan struktur folder Anda

## Fitur Tambahan (Opsional)

### **1. Email Notification**
```php
// Di MarketPriceService
public function sendEmailNotification(array $results): void
{
    // Kirim email ke admin
}
```

### **2. Slack/Telegram Notification**
```php
// Webhook notification
public function sendWebhookNotification(array $results): void
{
    // Kirim notifikasi ke Slack/Telegram
}
```

### **3. Dashboard Real-time**
```php
// Live update di admin panel
public function getLiveUpdateStatus(): array
{
    // Status update terbaru
}
```

## Keamanan

### **1. Rate Limiting**
- Update maksimal 1x per jam
- Log semua aktivitas update

### **2. Validation**
- Validasi harga sebelum update
- Rollback jika ada error

### **3. Backup**
- Backup database sebelum update besar
- Log semua perubahan harga

## Next Steps

1. **Setup Cron Job** sesuai OS Anda
2. **Test Command** manual terlebih dahulu
3. **Monitor Logs** untuk memastikan berjalan lancar
4. **Integrasi API Nyata** (BPS, Pasar Induk) jika diperlukan

## Support

Jika ada masalah atau pertanyaan:
1. Check logs di `writable/logs/`
2. Test command manual
3. Pastikan cron job berjalan
4. Check permission dan path
