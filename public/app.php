<?php
require __DIR__ . '/../vendor/autoload.php';
use \app\Kernel\Kernel;
use \src\controller;

spl_autoload_register(
    function($class){
        $path = realpath (__DIR__ . '/../'.str_replace("\\","/",$class.".php"));
		if(!file_exists($path)){
			echo  'Path abnormal: ',$path;
		}
		else{
			require_once $path;
		}		
    }
);

$kernel = Kernel::getInstance();
$file = __DIR__ . '/../config/route.yml';
$kernel->init($file);

$route = $kernel->getRoute();
$url = $_SERVER['REQUEST_URI'];
$routeParams = $route->match($url);
$controllerParams = $kernel->process($routeParams);
$kernel->render($routeParams, $controllerParams); 

?>

