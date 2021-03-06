<?php
namespace src\controllers;

use \core\Controller;
use \core\Request;
use PDOException;
use \src\handlers\LoginHandler;
use \src\handlers\PermissionHandler;
use \src\models\Book;


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

    public function list()
    {
        # define a flash message to be displayed
        $flash = '';

        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

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
    }

    public function addBook()
    {
        # get data
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

        # check filled
        if(!$title || !$author || !$description){
            $_SESSION['flash'] = 'Preencha todos os campos!';
            $this->redirect('/home');
        }

        # insert data
        try {
            $book = new Book();
            $book->insert([
                'id_user' => $this->loggedUser->id,
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'created_at' => date('Y-m-d')
            ])->exec();

            $_SESSION['flash'] = 'Dados cadastrados com sucesso!';
            $this->redirect('/home');

        } catch(PDOException $e) {
            $_SESSION['flash'] = 'Falha no cadastro: '.$e;
            $this->redirect('/home');
        }      
    }

    public function editBook($request)
    {
        # get data
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

        # check filled
        if(!$title || !$author || !$description){
            $_SESSION['flash'] = 'Preencha todos os campos!';
            $this->redirect('/home');
        }

        # check permissions and update data
        switch($this->loggedUser->perm){
            case '1':
                $bookId = intval($request['id']);

                # check user permission
                if(PermissionHandler::permissionForBook($this->loggedUser->id, $bookId) == false) {
                    $_SESSION['flash'] = 'Você não tem permissão para esta operação!';
                    $this->redirect('/'.$request['url']);
                }

                # if so, update data
                try {
                    $book = new Book();
                    $book->update([
                        'title' => $title,
                        'author' => $author,
                        'description' => $description,
                        'created_at' => date('Y-m-d')
                    ])->where('id', '=', $request['id'])
                    ->exec();
        
                    $_SESSION['flash'] = 'Dados cadastrados com sucesso!';
                    $this->redirect('/'.$request['url']);
        
                } catch(PDOException $e) {
                    $_SESSION['flash'] = 'Falha no cadastro: '.$e;
                    $this->redirect($request['url']);
                }


                break;
            case '2':
                try {
                    $book = new Book();
                    $book->update([
                        'title' => $title,
                        'author' => $author,
                        'description' => $description,
                        'created_at' => date('Y-m-d')
                    ])->where('id', '=', $request['id'])
                    ->exec();
        
                    $_SESSION['flash'] = 'Dados cadastrados com sucesso!';
                    $this->redirect('/'.$request['url']); # need to be dynamic
        
                } catch(PDOException $e) {
                    $_SESSION['flash'] = 'Falha no cadastro: '.$e;
                    $this->redirect('/'.$request['url']); # need to be dynamic
                }
                break;
        }

    }

    public function deleteBook($request)
    {
        $bookId = intval($request['id']);

        # check permissions
        match($this->loggedUser->perm) {
            '1' => $this->deleteBookClient($this->loggedUser->id, $bookId, $request['url']),
            '2' => $this->deleteBookAdmin($bookId, $request['url'])
        };

    }

    private function deleteBookAdmin($bookId, $url)
    {
        $bookInstance = new Book();
        $bookInstance->delete('books.id', '=', $bookId)->exec();

        $_SESSION['flash'] = 'Operação realizada com sucesso!';
        $this->redirect('/'.$url); # need to be dynamic
    }

    private function deleteBookClient($userId, $bookId, $url)
    {
        if(PermissionHandler::permissionForBook($userId, $bookId, $url) == false) {
            $_SESSION['flash'] = 'Você não tem permissão para esta operação!';
            $this->redirect('/'.$url); # need to be dynamic
        } else {
            $bookInstance = new Book();
            $bookInstance->delete('books.id', '=', $bookId)->exec();
            
            $_SESSION['flash'] = 'Operação realizada com sucesso!';
            $this->redirect('/'.$url); # need to be dynamic
        }        
    }
}
