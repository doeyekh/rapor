<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


// $routes->get('/', 'Home::index');
$routes->addRedirect('/', 'admin');
$routes->get('/admin', 'Home::index');

// Tahun Pelajaran
$routes->get('/admin/tahun-pelajaran', 'TahunAjar::index');
$routes->get('/admin/tahunPelajaran', 'TahunAjar::get');
$routes->post('/admin/tahun-pelajaran', 'TahunAjar::Insert');
$routes->PUT('/admin/tahun-pelajaran', 'TahunAjar::Update');


// jenjang level
$routes->get('/admin/jenjang-level', 'Jenjang::index');
$routes->get('/admin/jenjanglevel', 'Jenjang::get');
$routes->post('/admin/jenjang-level', 'Jenjang::insertUpdate');
$routes->PUT('/admin/jenjang-level', 'Jenjang::edit');

// guru
$routes->get('/admin/data-guru','Guru::index');
$routes->post('/admin/data-guru','Guru::import');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
