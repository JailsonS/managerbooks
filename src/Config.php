<?php
namespace src;


class Config 
{
    const BASE_DIR = '/managerbooks/public';
    
    const ERROR_CONTROLLER = '404';
    const DEFAULT_ACTION = '';

    const DB_DRIVER = 'mysql';
    const DB_DATABASE = 'techlead';
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';

    const JWT_KEY = 'z6Ct_d2Wy0ZcZZVUYD3beI5ZCSsFrR6-f3ZDyn_MW00';

    const ADMIN_USER_EMAIL = 'admin@gmail.com'; // DEFAULT ADMIN USER, AT LEAST ONE
    const ADMIN_USER_PASSWORD = '123456';
}