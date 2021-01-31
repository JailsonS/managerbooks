<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
use \src\models\Book;
use \core\Request;


class HomeController extends Controller
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

    public function index()
    {
        # define a flash message to be displayed
        $flash = '';

        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        switch($this->loggedUser->perm){
            case '1':

                # it will be populated
                $data = [];

                $bookInstance = new Book();
                $books = $bookInstance->select()
                    ->where('id_user', '=', $this->loggedUser->id)
                ->get();

                # fill data
                $data['flash'] = $flash;
                $data['books'] = $books;
                $data['loggedUser'] = $this->loggedUser;
                $data['url'] = Request::getUrl();

                $this->render('home', $data);
                break;
            case '2':

                # it will be populated
                $data = [];

                $bookInstance = new Book();
                $books = $bookInstance->select()->get();

                # fill data
                $data['flash'] = $flash;
                $data['books'] = $books;
                $data['loggedUser'] = $this->loggedUser;
                $data['url'] = Request::getUrl();

                $this->render('library', $data);
                break;
        }
    }
}
