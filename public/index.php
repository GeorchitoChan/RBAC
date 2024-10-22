<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once '../src/Config/Config.php';

    use App\Core\Router;

    $router = new Router();
    $router->run();

?>