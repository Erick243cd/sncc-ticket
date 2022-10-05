<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('views');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::views');
$routes->get('pages', 'Pages::views/$1');

$myroutes = [];

$myroutes['dashboard'] = 'Pages::dashboard';
$myroutes['login'] = 'Users::login';$myroutes['register'] = 'Users::register';
$myroutes['signin'] = 'Users::login';$myroutes['signup'] = 'Users::register';
$myroutes['logout'] = 'Users::logout';$myroutes['signout'] = 'Users::logout';
$myroutes['logandbook'] = 'Bookings::logforbook';
$myroutes['booktrip'] = 'Bookings::booknow';
$myroutes['trips'] = 'Trips::index';
$myroutes['profile'] = 'Users::myprofile';
$myroutes['cities'] = 'Cities::index';
$myroutes['airlines'] = 'Airlines::index';
$myroutes['settings'] = 'Users::settings';
$myroutes['booking-list'] = 'Bookings::listbooking';
$myroutes['booking-trip'] = 'Bookings::index';
$myroutes['programs-trips'] = 'Trips::searchOneaway';
$myroutes['create-trip'] = 'Trips::create';

$myroutes['viewTripDetails/(:segment)'] = 'Trips::viewmore/$1';
$myroutes['admin-more-booking/(:segment)'] = 'Bookings::adminMore/$1';
$myroutes['confirm-booking/(:segment)'] = 'Bookings::confirmBooking/$1';
$myroutes['send-ticket/(:segment)'] = 'Bookings::confirmTicket/$1';
$myroutes['cancel-booking/(:segment)'] = 'Bookings::cancelBooking/$1';
$myroutes['booking-status/(:segment)'] = 'Bookings::bookingstatus/$1';

$routes->set404Override(function(){
    echo view('errors/err_404');
});

$routes->map($myroutes);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
