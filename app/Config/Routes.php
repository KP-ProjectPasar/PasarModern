<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingPage::index');

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
$routes->get('admin/logout', 'Admin::logout');
