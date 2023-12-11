<?php
declare(strict_types=1);

require('vendor/autoload.php');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

//use NoahBuscher\Macaw\Macaw;
//use Tracy\Debugger;
//
//Debugger::enable();

$container = require __DIR__ . '/app/bootstrap.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/datka', ['App\Db', 'select']);
    $r->addRoute('GET', '/admin', ['App\FrontEndController' , 'adminPage']);
    $r->addRoute('GET', '/', ['App\FrontEndController','articleList']);
    $r->addRoute('GET', '/article/{id:\d+}',[ 'App\FrontEndController','singleArticle']);
    $r->addRoute('GET', '/admin/articles', ['App\FrontEndController' ,'adminArticlesPage']);
    $r->addRoute('GET', '/admin/article/edit/{id:\d+}', ['App\FrontEndController ','adminChangePage']);
    //$r->addRoute('GET', '/save/{id:\d+}/{:\d+}/{:\d+}/{:\d+}/{:\d+}', App\Demo::class .'/page');
    //$r->addRoute('GET', '/admin/article/delite/{id:\d+}', App\Demo::class .'/delite');
});



$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $route[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];

        // We could do $container->get($controller) but $container->call()
        // does that automatically
        $container->call($controller, $parameters);
        break;
}
/*
echo '<pre>';
echo var_dump($_REQUEST);
echo '</pre>';
include('tables-data.php');
*/

//Macaw::get('/', 'App\FrontEndController@articleList');
//Macaw::get('article/(:num)', 'App\FrontEndController@singleArticle');
//Macaw::get('admin', 'App\FrontEndController@adminPage');
//Macaw::get('admin/articles', 'App\FrontEndController@adminArticlesPage');
//Macaw::get('admin/article/edit/(:num)', 'App\FrontEndController@adminChangePage');
//Macaw::get('save/(:num)/(:any)/(:any)/(:any)/(:any)', 'App\Demo@page');
//Macaw::get('admin/article/delite/(:num)', 'App\Demo@delite');
//Macaw::dispatch();
