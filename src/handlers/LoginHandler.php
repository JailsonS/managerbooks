<?php
namespace src\handlers;


use \src\models\User;
use \src\handlers\JwtHandler;

class LoginHandler 
{
    public static function checkLogin()
    {
        # necessary to avoid session hijacking

        # check session token
        if(!empty($_SESSION['token'])) {
            
            $token = $_SESSION['token'];

            $loggedUser = new User();
            $loggedUser = $loggedUser->select()->where('token', '=', $token)->get(); // problem is here!

            if(count($loggedUser) > 0) {
                $loggedUser = $loggedUser[0];
                return $loggedUser;
            } else {
                return false;
            }
        }
        return false;
    }

    public static function verifyLogin($email, $password)
    {
        $userInstance = new User();
        $user = $userInstance->select()->where('email', '=', $email)->one();

        if(!$user || !password_verify($password, $user->password)) {
            return false;
        }

        $token = JwtHandler::create(['id_user' => $user->id]);

        $userInstance->update(['token'=>$token])->where('email', '=', $email)->exec();

        return $token;
  
    }

    public static function emailExists($email)
    {
        $user = new User();
        $user = $user->select()->where('email', '=', $email)->one();

        return $user ? true : false;
    }

    public static function addUser($name, $email, $password, $birthdate)
    {
        $user = new User();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = JwtHandler::create(['id_user' => $user->id]);

        $user->insert([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'birthdate' => $birthdate,
            'token' => $token
        ])->exec();

        return $token;
    }
}