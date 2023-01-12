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
$routes->get('teachersettings', 'Home::teacher_setting');
$routes->get('event', 'Home::event');
$routes->get('year/(:num)', 'Home::student_year/$1');
$routes->get('section/(:any)', 'Home::student_section/$1');
$routes->post('update_teacher', 'Home::update_teacher_info');
$routes->post('update_teacher_account', 'Home::update_teacher_account');
$routes->post('register', 'Home::add_student');
$routes->get('notification', 'Home::notification');
$routes->post('update_student_status', 'Home::update_student_status');
$routes->get('attendance', 'Home::attendance');
$routes->post('add_attendance', 'Home::add_attendance');
$routes->get('section_list', 'Home::section_list');
$routes->get('gradeSection/(:any)', 'Home::section_attendance/$1');
$routes->post('add_section_attendance', 'Home::add_section_attendance');
$routes->post('add_section', 'Home::add_section');
$routes->get('viewstudentdata/(:any)', 'Home::view_student_data/$1');
$routes->post("update_event_schedule", 'Home::update_event_schedule');
$routes->get('section_date_attendance/(:any)', 'Home::section_date_attendance/$1');
$routes->post('update_section_date_attendance', 'Home::update_section_date_attendance');
$routes->get("test", 'Home::test');



//PDF ROUTES
$routes->get('php', 'PdfController::index');
$routes->get("convertToPDF/(:any)", 'PdfController::htmlToPDF/$1');
$routes->get("convertStudentDataToPDF/(:any)", 'PdfController::studenHTMLTOPDF/$1');
$routes->get("convertStudentAttendanceToPDF/(:any)", 'PdfController::studentAttendanceToPDF/$1');


//ADMIN ROUTES
// $routes->get('admin_homepage', 'Admin::homepage');
$routes->get('admin_add_user', 'Admin::add_user');
$routes->get('admin_settings', 'Admin::admin_settings');
$routes->post('create_user', 'Admin::create_user');
$routes->post('create_event', 'Admin::create_event');
$routes->post('update_account', 'Admin::update_account');
$routes->get('delete/(:num)', 'Admin::delete_account/$1');
$routes->get('admin_print_records', 'Admin::print_records');
$routes->get("admin_student", 'Admin::student');
$routes->post("admin_add_student", 'Admin::add_student');
$routes->get('admin_teachers', 'Admin::admin_teachers' );
$routes->get('admin_teacher_subjects/(:num)', 'Admin::admin_teacher_subjects/$1');
$routes->post('admin_assign_subject/(:num)', 'Admin::admin_assign_new_subject/$1');
$routes->get('admin_grade_level', 'Admin::admin_grade_level');
$routes->get('admin_homepage', 'Admin::admin_calendar');
$routes->get('admin_student_status', 'Admin::admin_student_status');
$routes->post('admin_update_student_status', 'Admin::admin_update_student_status');
$routes->get('admin_year/(:any)', 'Admin::admin_year/$1');
$routes->get('admin_section/(:any)', 'Admin::admin_section/$1');
$routes->get("admin_section_student_attendance/(:any)", 'Admin::admin_section_student_attendance/$1');

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
