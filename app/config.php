<?php

use App\FrontEndController;
use App\Models\ArticleModel;
use App\View;
use Opis\Database\Connection;
use function DI\create;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\get;

return [
    'connection' =>create(Connection::class)->constructor(
        'mysql:host=localhost;dbname=test1135',
        'admin',
        'admin'
    ),'Db'=> create(\Opis\Database\Database::class)->constructor(get('connection')),
    ArticleModel::class => create(ArticleModel::class)
        ->constructor(get('Db')),
    'FrontLoader' => create(FilesystemLoader::class)
        ->constructor('template'),
    'FrontTwig' => create( Twig\Environment::class)
        ->constructor(get('FrontLoader',[])),
    'FrontView' => create(View::class)
        ->constructor(get('FrontTwig')),
    FrontEndController::class => create( FrontEndController::class)
        ->constructor(
            get(ArticleModel::class),
            get('FrontView')
        ),
    \App\Db::class => create(\App\Db::class),

];