<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('PagesController');
$routes->setDefaultMethod('home');
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

// ROUTES PAGES
$routes->get('', 'PagesController::home');
$routes->get('home', 'PagesController::home');
$routes->get('suggestions', 'PagesController::suggestions');
$routes->get('basket', 'PagesController::basket');

// ARTICLES
$routes->get('market', 'MarketController::market');
$routes->get('article/(:num)', 'MarketController::article/$1');

// RECIPES
$routes->get('recipes', 'RecipesController::recipes');
$routes->get('recipes/tag/(:num)', 'TagsController::tag/$1');
$routes->get('recipe/(:num)', 'RecipesController::recipe/$1');

// ROUTES TAGS

$routes->get('/tags', 'TagsController::tags');
$routes->get('/tag/(:num)', 'TagsController::tag/$1');

// USER
$routes->get('user', 'PagesController::user');
$routes->post('user/register', 'UserController::register');
$routes->post('user/connection', 'ConnectionController::connection');
$routes->get('user/disconnect', 'ConnectionController::disconnect');


// API
$routes->get('/api',"ApiController::index");
$routes->get('/api/recipes',"ApiController::recipes");
$routes->get('/api/recipe/(:num)',"ApiController::recipe/$1");

$routes->get('/api/category/(:alpha)',"ApiController::category/$1");

$routes->get('/api/ingredients/(:num)',"ApiController::ingredients/$1");
$routes->get('/api/steps/(:num)',"ApiController::steps/$1");


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
