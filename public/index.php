<?php
session_start();

require '../vendor/autoload.php';
require '../src/Routes.php'; // this file contains all routes of the system

# run routes by setting the routes
$router->run( $router->routes );