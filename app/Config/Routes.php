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

// HOME
$routes->get('', 'HomeController::home');
$routes->get('home', 'HomeController::home');

// SUGGESTIONS
$routes->get('suggestions', 'SuggestionsController::suggestions');
$routes->post('recipes/suggestions', 'SuggestionsController::recipes');

// BASKET
$routes->get('basket', 'PagesController::basket');
$routes->post('basket/payement', 'BasketController::command');

// ARTICLES
$routes->get('market', 'MarketController::market');
$routes->get('article/(:num)', 'MarketController::article/$1');

// RECIPES
$routes->get('recipes', 'RecipesController::recipes');
$routes->get('recipes/tag/(:num)', 'TagsController::tag/$1');
$routes->get('recipe/(:num)', 'RecipesController::recipe/$1');
$routes->post('/recipe/(:num)/comment', 'RecipesController::recipeComment/$1');
$routes->post('/recipe/(:num)/grade', 'RecipesController::recipeGrade/$1');

// ROUTES TAGS
$routes->get('/tags', 'TagsController::tags');
$routes->get('/tag/(:num)', 'TagsController::tag/$1');

// SEARCH
$routes->post('search', 'SearchController::search');

// USER
$routes->get('user', 'PagesController::user');
$routes->post('user/register', 'UserController::register');
$routes->post('user/connection', 'ConnectionController::connection');
$routes->get('user/disconnect', 'ConnectionController::disconnect');

// Routes for the API (mobile and documentation)
$routes->get('/api',"ApiController::index");
$routes->get('/(:any)/api/recipes',"ApiController::recipes/$1");
$routes->get('/(:any)/api/recipe/(:num)',"ApiController::recipe/$1/$2");
$routes->get('/(:any)/api/category/(:alpha)',"ApiController::category/$1/$2");
$routes->get('/(:any)/api/search/(:alpha)',"ApiController::search/$1/$2");

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
