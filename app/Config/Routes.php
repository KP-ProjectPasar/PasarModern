<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingPage::index');

// Feedback Routes
$routes->get('feedback', 'Feedback::index');
$routes->post('feedback/submit', 'Feedback::submit');

$routes->get('api/komoditas', 'Api::komoditas');
$routes->get('api/galeri', 'Api::galeri');
$routes->get('api/berita', 'Api::berita');
$routes->post('api/galeri/(:num)/view', 'Api::incrementGaleriView/$1');
$routes->get('api/dashboard/stats', 'Api::dashboardStats');
$routes->get('api/test-db', 'Api::testDb');

$routes->get('tentang-kami/ringkasan', 'TentangKami::ringkasan');
$routes->get('tentang-kami/visi-misi', 'TentangKami::visi_misi');
$routes->get('tentang-kami/peraturan', 'TentangKami::peraturan');
$routes->get('tentang-kami/pesan-direksi', 'TentangKami::pesan_direksi');
$routes->get('informasi/berita', 'Informasi::berita');
$routes->get('informasi/berita/(:num)', 'Informasi::beritaDetail/$1');
$routes->post('api/berita/(:num)/view', 'Api::incrementBeritaView/$1');
$routes->get('informasi/harga', 'Informasi::harga');
$routes->get('informasi/informasi-pasar', 'Informasi::informasi_pasar');
$routes->get('admin/login', 'Admin\Admin::login');
$routes->post('admin/login', 'Admin\Admin::login');
$routes->get('admin/dashboard', 'Admin\Admin::dashboard');
$routes->post('admin/update-activity', 'Admin\Admin::updateActivity');
$routes->get('admin/logout', 'Admin\Admin::logout');

// CRUD User Admin
$routes->get('admin/user', 'Admin\AdminUser::index');
$routes->get('admin/user/create', 'Admin\AdminUser::create');
$routes->post('admin/user/store', 'Admin\AdminUser::store');
$routes->get('admin/user/edit/(:num)', 'Admin\AdminUser::edit/$1');
$routes->post('admin/user/update/(:num)', 'Admin\AdminUser::update/$1');
$routes->get('admin/user/delete/(:num)', 'Admin\AdminUser::delete/$1');

// CRUD Kelola Role
$routes->get('admin/role', 'Admin\AdminRole::index');
$routes->get('admin/role/create', 'Admin\AdminRole::create');
$routes->post('admin/role/store', 'Admin\AdminRole::store');
$routes->get('admin/role/edit/(:num)', 'Admin\AdminRole::edit/$1');
$routes->post('admin/role/update/(:num)', 'Admin\AdminRole::update/$1');
$routes->get('admin/role/delete/(:num)', 'Admin\AdminRole::delete/$1');

// CRUD Berita
$routes->get('admin/berita', 'Admin\AdminBerita::index');
$routes->get('admin/berita/create', 'Admin\AdminBerita::create');
$routes->post('admin/berita/store', 'Admin\AdminBerita::store');
$routes->get('admin/berita/edit/(:num)', 'Admin\AdminBerita::edit/$1');
$routes->post('admin/berita/update/(:num)', 'Admin\AdminBerita::update/$1');
$routes->get('admin/berita/delete/(:num)', 'Admin\AdminBerita::delete/$1');
$routes->get('admin/berita/status/(:num)/(:any)', 'Admin\AdminBerita::changeStatus/$1/$2');

// CRUD Harga
$routes->get('admin/harga', 'Admin\AdminHarga::index');
$routes->get('admin/harga/create', 'Admin\AdminHarga::create');
$routes->post('admin/harga/store', 'Admin\AdminHarga::store');
$routes->get('admin/harga/edit/(:num)', 'Admin\AdminHarga::edit/$1');
$routes->post('admin/harga/update/(:num)', 'Admin\AdminHarga::update/$1');
$routes->get('admin/harga/delete/(:num)', 'Admin\AdminHarga::delete/$1');

// CRUD Galeri
$routes->get('admin/galeri', 'Admin\AdminGaleri::index');
$routes->get('admin/galeri/create', 'Admin\AdminGaleri::create');
$routes->post('admin/galeri/store', 'Admin\AdminGaleri::store');
$routes->get('admin/galeri/edit/(:num)', 'Admin\AdminGaleri::edit/$1');
$routes->post('admin/galeri/update/(:num)', 'Admin\AdminGaleri::update/$1');
$routes->get('admin/galeri/delete/(:num)', 'Admin\AdminGaleri::delete/$1');
$routes->get('admin/galeri/status/(:num)/(:any)', 'Admin\AdminGaleri::changeStatus/$1/$2');

// CRUD Video
$routes->get('admin/video', 'Admin\AdminVideo::index');
$routes->get('admin/video/create', 'Admin\AdminVideo::create');
$routes->post('admin/video/store', 'Admin\AdminVideo::store');
$routes->get('admin/video/edit/(:num)', 'Admin\AdminVideo::edit/$1');
$routes->post('admin/video/update/(:num)', 'Admin\AdminVideo::update/$1');
$routes->get('admin/video/delete/(:num)', 'Admin\AdminVideo::delete/$1');
$routes->get('admin/video/changeStatus/(:num)/(:any)', 'Admin\AdminVideo::changeStatus/$1/$2');
// Alias agar konsisten dengan berita/galeri
$routes->get('admin/video/status/(:num)/(:any)', 'Admin\AdminVideo::changeStatus/$1/$2');

// CRUD Komoditas
$routes->get('admin/komoditas', 'Admin\AdminKomoditas::index');
$routes->get('admin/komoditas/create', 'Admin\AdminKomoditas::create');
$routes->post('admin/komoditas/store', 'Admin\AdminKomoditas::store');
$routes->get('admin/komoditas/edit/(:num)', 'Admin\AdminKomoditas::edit/$1');
$routes->post('admin/komoditas/update/(:num)', 'Admin\AdminKomoditas::update/$1');
$routes->get('admin/komoditas/delete/(:num)', 'Admin\AdminKomoditas::delete/$1');

// CRUD Data Pasar
$routes->get('admin/pasar', 'Admin\AdminPasar::index');
$routes->get('admin/pasar/create', 'Admin\AdminPasar::create');
$routes->post('admin/pasar/store', 'Admin\AdminPasar::store');
$routes->get('admin/pasar/edit/(:num)', 'Admin\AdminPasar::edit/$1');
$routes->post('admin/pasar/update/(:num)', 'Admin\AdminPasar::update/$1');
$routes->get('admin/pasar/delete/(:num)', 'Admin\AdminPasar::delete/$1');

// CRUD Feedback
$routes->get('admin/feedback', 'Admin\AdminFeedback::index');
$routes->get('admin/feedback/view/(:num)', 'Admin\AdminFeedback::view/$1');
$routes->post('admin/feedback/update-status/(:num)', 'Admin\AdminFeedback::updateStatus/$1');
$routes->get('admin/feedback/delete/(:num)', 'Admin\AdminFeedback::delete/$1');
