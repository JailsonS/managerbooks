<?php
namespace src\handlers;

use \src\models\User;
use \src\models\Book;
use \src\handlers\JwtHandler;

class PermissionHandler 
{
    public static function permissionForBook($userId, $bookId)
    {
        $book = new Book();
        $book = $book->select(['id_user'])
            ->where('id','=', $bookId)
        ->one();

        if($book->id_user === $userId) {
            return true;
        } else {
            return false;
        }

    }
}