<?php
namespace src\handlers;

use \src\models\Book;

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