<?php


namespace App\Models;

use Opis\Database\Connection;
use Opis\Database\Database;
class ArticleModel
{
    public Database $db;
    protected string $table;

     /**
     * AtricleModel constructor.
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->table = 'article';
    }
    public function getArticles(): array
    {
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
    }

    public function getArticlesById(int $id): array
    {
        $connection = new Connection(
            'mysql:host=localhost;dbname=test1135',
            'admin',
            'admin'
        );
        echo $id;
        $db = new Database($connection);
         return  $db->from('articles')
            ->where('id')->is($id) //Alternatively: ->where('age')->eq(18)
            ->select()
            ->fetchAssoc()
            ->all(); // idk why this no work :/
    }
    //
}