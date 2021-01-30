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
            $this->redirect('/');
        }

        # if credentials ok, create token
        $token = LoginHandler::verifyLogin($email, $password);

        # check token
        if(!$token){
            $_SESSION['flash'] = 'E-mail e/ou senha incorretos!';
            $this->redirect('/');
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
        $passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm');
        
        # check filled
        if(!$name || !$email || !$password || !$passwordConfirm){
            $_SESSION['flash'] = 'Preencha todos os campos!';
            $this->redirect('/signup');
        }

        if($password != $passwordConfirm){
            $_SESSION['flash'] = 'As senhas devem ser iguais!';
            $this->redirect('/signup');
        }

        # check email
        if(LoginHandler::emailExists($email)){
            $_SESSION['flash'] = 'Este e-mail já está cadastrado!';
            $this->redirect('/signup');
        }

        # create user and token
        $token = LoginHandler::addUser($name, $email, $password);

        $_SESSION['token'] = $token;

        $this->redirect('/home');
    }

    public function logout()
    {   
        $_SESSION["token"] = '';
        $this->redirect('/');
    }
}