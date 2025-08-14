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
$routes->get('api/berita', 'Api::berita');

$routes->get('tentang-kami/ringkasan', 'TentangKami::ringkasan');
$routes->get('tentang-kami/visi-misi', 'TentangKami::visi_misi');
$routes->get('tentang-kami/peraturan', 'TentangKami::peraturan');
$routes->get('tentang-kami/pesan-direksi', 'TentangKami::pesan_direksi');
$routes->get('informasi/berita', 'Informasi::berita');
$routes->get('informasi/harga', 'Informasi::harga');
$routes->get('informasi/informasi-pasar', 'Informasi::informasi_pasar');
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/login', 'Admin::login');
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->post('admin/update-activity', 'Admin::updateActivity');
$routes->get('admin/logout', 'Admin::logout');

// CRUD User Admin
$routes->get('admin/user', 'AdminUser::index');
$routes->get('admin/user/create', 'AdminUser::create');
$routes->post('admin/user/store', 'AdminUser::store');
$routes->get('admin/user/edit/(:num)', 'AdminUser::edit/$1');
$routes->post('admin/user/update/(:num)', 'AdminUser::update/$1');
$routes->get('admin/user/delete/(:num)', 'AdminUser::delete/$1');

// CRUD Kelola Role
$routes->get('admin/role', 'AdminRole::index');
$routes->get('admin/role/create', 'AdminRole::create');
$routes->post('admin/role/store', 'AdminRole::store');
$routes->get('admin/role/edit/(:num)', 'AdminRole::edit/$1');
$routes->post('admin/role/update/(:num)', 'AdminRole::update/$1');
$routes->get('admin/role/delete/(:num)', 'AdminRole::delete/$1');

// CRUD Berita
$routes->get('admin/berita', 'AdminBerita::index');
$routes->get('admin/berita/create', 'AdminBerita::create');
$routes->post('admin/berita/store', 'AdminBerita::store');
$routes->get('admin/berita/edit/(:num)', 'AdminBerita::edit/$1');
$routes->post('admin/berita/update/(:num)', 'AdminBerita::update/$1');
$routes->get('admin/berita/delete/(:num)', 'AdminBerita::delete/$1');

// CRUD Harga
$routes->get('admin/harga', 'AdminHarga::index');
$routes->get('admin/harga/create', 'AdminHarga::create');
$routes->post('admin/harga/store', 'AdminHarga::store');
$routes->get('admin/harga/edit/(:num)', 'AdminHarga::edit/$1');
$routes->post('admin/harga/update/(:num)', 'AdminHarga::update/$1');
$routes->get('admin/harga/delete/(:num)', 'AdminHarga::delete/$1');

// CRUD Galeri
$routes->get('admin/galeri', 'AdminGaleri::index');
$routes->get('admin/galeri/create', 'AdminGaleri::create');
$routes->post('admin/galeri/store', 'AdminGaleri::store');
$routes->get('admin/galeri/edit/(:num)', 'AdminGaleri::edit/$1');
$routes->post('admin/galeri/update/(:num)', 'AdminGaleri::update/$1');
$routes->get('admin/galeri/delete/(:num)', 'AdminGaleri::delete/$1');

// CRUD Video
$routes->get('admin/video', 'AdminVideo::index');
$routes->get('admin/video/create', 'AdminVideo::create');
$routes->post('admin/video/store', 'AdminVideo::store');
$routes->get('admin/video/edit/(:num)', 'AdminVideo::edit/$1');
$routes->post('admin/video/update/(:num)', 'AdminVideo::update/$1');
$routes->get('admin/video/delete/(:num)', 'AdminVideo::delete/$1');

// CRUD Komoditas
$routes->get('admin/komoditas', 'AdminKomoditas::index');
$routes->get('admin/komoditas/create', 'AdminKomoditas::create');
$routes->post('admin/komoditas/store', 'AdminKomoditas::store');
$routes->get('admin/komoditas/edit/(:num)', 'AdminKomoditas::edit/$1');
$routes->post('admin/komoditas/update/(:num)', 'AdminKomoditas::update/$1');
$routes->get('admin/komoditas/delete/(:num)', 'AdminKomoditas::delete/$1');

// CRUD Data Pasar
$routes->get('admin/pasar', 'AdminPasar::index');
$routes->get('admin/pasar/create', 'AdminPasar::create');
$routes->post('admin/pasar/store', 'AdminPasar::store');
$routes->get('admin/pasar/edit/(:num)', 'AdminPasar::edit/$1');
$routes->post('admin/pasar/update/(:num)', 'AdminPasar::update/$1');
$routes->get('admin/pasar/delete/(:num)', 'AdminPasar::delete/$1');

// CRUD Feedback
$routes->get('admin/feedback', 'AdminFeedback::index');
$routes->get('admin/feedback/view/(:num)', 'AdminFeedback::view/$1');
$routes->post('admin/feedback/update-status/(:num)', 'AdminFeedback::updateStatus/$1');
$routes->get('admin/feedback/delete/(:num)', 'AdminFeedback::delete/$1');
