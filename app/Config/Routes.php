<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::login');
$routes->post('login', 'Login::verifyData');


//USER ROUTES
$routes->get('user_homepage', 'Home::homepage');
$routes->get('studentrecords', 'Home::student_records');
$routes->get('studentattendance', 'Home::student_attendance');
$routes->get('event', 'Home::event');
$routes->get('year/(:num)', 'Home::student_year/$1');
$routes->get('section/(:any)', 'Home::student_section/$1');
$routes->post('register', 'Home::add_student');







//ADMIN ROUTES
$routes->get('admin_homepage', 'Admin::homepage');
$routes->get('admin_add_user', 'Admin::add_user');
$routes->get('admin_settings', 'Admin::admin_settings');
$routes->post('create_user', 'Admin::create_user');
$routes->post('create_event', 'Admin::create_event');
$routes->post('update_account', 'Admin::update_account');
$routes->get('delete/(:num)', 'Admin::delete_account/$1');


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
