<?php
use \core\Router;

# create an instance
$router = new Router();

# implement routes
$router->get('/', 'LoginController@signin');