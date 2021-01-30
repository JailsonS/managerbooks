<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;


class BookController extends Controller
{

    private $loggedUser;

    public function __construct()
    {
        # middleware for checking login
        $this->loggedUser = LoginHandler::checkLogin();

        if($this->loggedUser === false){
            $this->redirect('/');
        }
    }

    public function add()
    {  
    }
}
