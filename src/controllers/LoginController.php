<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller 
{
    public function signin()
    {
        # define a flash message to be displayed
        $flash = '';
        
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('signin', [
            'flash' => $flash
        ]);
    }

    public function signinAction()
    {
        # get email and pass
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');      
        
        # check
        if(!$email || !$password){
            $_SESSION['flash'] = 'E-mail e/ou senha incorretos!';
            $this->redirect('/login');
        }

        # if credentials ok, create token
        $token = LoginHandler::verifyLogin($email, $password);

        # check token
        if(!$token){
            $_SESSION['flash'] = 'E-mail e/ou senha incorretos!';
            $this->redirect('/login');
        }

        # save token in section
        $_SESSION['token'] = $token;

        # redirect
        $this->redirect('/home');        
    }

    public function signup()
    {
        $flash = '';
        
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('signup', [
            'flash' => $flash
        ]);
    }

    public function signupAction()
    {
        # get input data
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        
        # check filled
        if(!$name || !$email || !$password || !$birthdate){
            $_SESSION['flash'] = 'Preencha todos os campos!';
            $this->redirect('/register');
        }

        $birthdate = explode('/', $birthdate);

        # check date
        if(count($birthdate) != 3){
            $_SESSION['flash'] = 'Data de nascimento inválida !';
            $this->redirect('/register');
        }

        $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];

        # check valid date
        if(strtotime($birthdate) === false) {
            $_SESSION['flash'] = 'Data de nascimento inválida!';
            $this->redirect('/register');
        }

        # check email
        if(LoginHandler::emailExists($email)){
            $_SESSION['flash'] = 'Este e-mail já está cadastrado!';
            $this->redirect('/register');
        }

        # create user and token
        $token = LoginHandler::addUser($name, $email, $password, $birthdate);

        $_SESSION['token'] = $token;

        $this->redirect('/home');
    }

    public function logout()
    {   
        $_SESSION["token"] = '';
        $this->redirect('/');
    }
}