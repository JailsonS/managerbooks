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