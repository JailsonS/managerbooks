<?php
namespace src\handlers;

use PDOException;
use \src\models\User;
use \src\Config;

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

    public static function addUser($name, $email, $password)
    {
        $user = new User();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(implode(',', range(0, 999)).date('D, d M Y H:i:s'));

        # 1 - client profile (default permission)
        # 2 - admin profile
        $perm = 1;

        $user->insert([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'token' => $token,
            'perm' => $perm,
            'created_at' => date('Y-m-d')
        ])->exec();

        return $token;
    }

    public static function createDefaultAdmin()
    {
        $user = new User();

        $count = $user->select()->where('perm','=', 2)->get();

        if(count($count) == 0) {
            $hash = password_hash(Config::ADMIN_USER_EMAIL, PASSWORD_DEFAULT);
            $token = md5( implode(',',range(0, 999)).date('D, d M Y H:i:s') );
    
            try {
                $user->insert([
                    'name' => 'ADMIN_DEFAULT',
                    'email' => Config::ADMIN_USER_EMAIL,
                    'password' => $hash,
                    'token' => $token,
                    'perm' => 2,
                    'created_at' => date('Y-m-d')
                ])->exec();
            } catch(PDOException $e) {
                echo 'ERROR: '.$e->getMessage();
            }
        }
    }
}