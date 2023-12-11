<?php
namespace App;
use Opis\Database\Database;
use Opis\Database\Connection;

class Db {

    public function select(){
        $connection = new Connection(
            'mysql:host=localhost;dbname=test1135',
            'admin',
            'admin'
        );
        $db = new Database($connection);

        return $db->from('articles')
            ->select()
            ->fetchAssoc()
            ->all();
        echo $db;
    }
}


