<?php
use \core\Router;

# create an instance
$router = new Router();

# implement routes
$router->get('/', 'LoginController@signin');
$router->post('/', 'LoginController@signinAction');

$router->get('/signup', 'LoginController@signup');
$router->post('/signup', 'LoginController@signupAction');

$router->get('/logout', 'LoginController@logout');

$router->get('/home', 'HomeController@index');

$router->post('/add-book', 'BookController@addBook');
$router->get('/library', 'BookController@list');
$router->post('/edit-book/{id}/{url}', 'BookController@editBook'); // additional param url to get back to the previus route with flash message
$router->get('/delete-book/{id}/{url}', 'BookController@deleteBook'); // additional param url to get back to the previus route with flash message