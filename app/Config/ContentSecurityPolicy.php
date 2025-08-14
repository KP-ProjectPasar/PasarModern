<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Menyimpan pengaturan default untuk ContentSecurityPolicy.
 * Nilai di sini akan dibaca dan diset sebagai default untuk situs.
 * Jika diperlukan, dapat diganti per halaman.
 *
 * Referensi untuk penjelasan:
 *
 * @see https://www.html5rocks.com/en/tutorials/security/content-security-policy/
 */
class ContentSecurityPolicy extends BaseConfig
{
    // -------------------------------------------------------------------------
    // Manajemen CSP secara umum
    // -------------------------------------------------------------------------

    /**
     * Konteks laporan CSP default
     */
    public bool $reportOnly = false;

    /**
     * Menentukan URL tempat browser akan mengirim laporan
     * ketika kebijakan keamanan konten dilanggar.
     */
    public ?string $reportURI = null;

    /**
     * Memberi petunjuk kepada user agent untuk menulis ulang skema URL,
     * mengubah HTTP menjadi HTTPS. Direktif ini untuk website dengan
     * banyak URL lama yang perlu ditulis ulang.
     */
    public bool $upgradeInsecureRequests = false;

    // -------------------------------------------------------------------------
    // Sources yang diizinkan
    // Catatan: setelah policy diset ke 'none', tidak bisa dibatasi lagi
    // -------------------------------------------------------------------------

    /**
     * Akan default ke self jika tidak diganti
     *
     * @var list<string>|string|null
     */
    public $defaultSrc;

    /**
     * Daftar URL script yang diizinkan.
     *
     * @var list<string>|string
     */
    public $scriptSrc = 'self';

    /**
     * Daftar URL stylesheet yang diizinkan.
     *
     * @var list<string>|string
     */
    public $styleSrc = 'self';

    /**
     * Menentukan asal dari mana gambar dapat dimuat.
     *
     * @var list<string>|string
     */
    public $imageSrc = 'self';

    /**
     * Membatasi URL yang dapat muncul di elemen `<base>` halaman.
     *
     * Akan default ke self jika tidak diganti
     *
     * @var list<string>|string|null
     */
    public $baseURI;

    /**
     * Daftar URL untuk worker dan konten frame yang disematkan
     *
     * @var list<string>|string
     */
    public $childSrc = 'self';

    /**
     * Membatasi asal yang dapat Anda hubungi (melalui XHR,
     * WebSockets, dan EventSource).
     *
     * @var list<string>|string
     */
    public $connectSrc = 'self';

    /**
     * Menentukan asal yang dapat menyediakan web font.
     *
     * @var list<string>|string
     */
    public $fontSrc;

    /**
     * Daftar endpoint yang valid untuk pengiriman dari tag `<form>`.
     *
     * @var list<string>|string
     */
    public $formAction = 'self';

    /**
     * Menentukan asal yang dapat menyematkan halaman saat ini.
     * Direktif ini berlaku untuk tag `<frame>`, `<iframe>`, `<embed>`,
     * dan `<applet>`. Direktif ini tidak dapat digunakan di
     * tag `<meta>` dan hanya berlaku untuk sumber non-HTML.
     *
     * @var list<string>|string|null
     */
    public $frameAncestors;

    /**
     * Direktif frame-src membatasi URL yang dapat dimuat ke konteks navigasi bersarang.
     *
     * @var list<string>|string|null
     */
    public $frameSrc;

    /**
     * Membatasi asal yang diizinkan untuk menyediakan video dan audio.
     *
     * @var list<string>|string|null
     */
    public $mediaSrc;

    /**
     * Memungkinkan kontrol atas Flash dan plugin lainnya.
     *
     * @var list<string>|string
     */
    public $objectSrc = 'self';

    /**
     * @var list<string>|string|null
     */
    public $manifestSrc;

    /**
     * Membatasi jenis plugin yang dapat dipanggil oleh halaman.
     *
     * @var list<string>|string|null
     */
    public $pluginTypes;

    /**
     * Daftar tindakan yang diizinkan.
     *
     * @var list<string>|string|null
     */
    public $sandbox;

    /**
     * Nonce tag untuk style
     */
    public string $styleNonceTag = '{csp-style-nonce}';

    /**
     * Nonce tag untuk script
     */
    public string $scriptNonceTag = '{csp-script-nonce}';

    /**
     * Ganti nonce tag secara otomatis
     */
    public bool $autoNonce = true;
}
