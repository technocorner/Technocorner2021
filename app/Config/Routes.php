<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Page::index');
$routes->get('/auth/test', 'Auth::index');
$routes->get('/page/competition/transporter', 'Page::transporter');
$routes->get('/page/competition/line', 'Page::linefollower');
$routes->get('/page/competition/iot', 'Page::iot');
$routes->get('/page/competition/eec', 'Page::eec');
$routes->get('/page/gallery', 'Page::gallery');
$routes->get('/page/webinar', 'Page::webinar');
$routes->get('/page/workshop', 'Page::workshop');
$routes->get('/admin', 'Admin::index', ['filter' => 'auth']);
$routes->get('/admin/menu', 'Menu::index', ['filter' => 'auth']);
$routes->get('/admin/menu/manageUser', 'Menu::manageUser', ['filter' => 'auth']);
$routes->get('/admin/menu/manageTeam', 'Menu::manageTeam', ['filter' => 'auth']);
$routes->get('/admin/menu/managePemberitahuan', 'Menu::managePemberitahuan', ['filter' => 'auth']);
$routes->post('/admin/menu/(:any)', 'Menu::$1', ['filter' => 'auth']);
$routes->get('/user', 'User::index', ['filter' => 'auth']);

$routes->post('/api/getTeamInfo', 'Api::getTeamInfo');
$routes->post('/api/submitPaper', 'Api::submitPaper');
$routes->post('/api/saveAnswer', 'Api::saveAnswer');
/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
