<?php
require __DIR__ . '/../vendor/autoload.php';
use \app\Kernel\Kernel;
use \src\controller;

/*
 * загружаются классы проекта
 */
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
/*
 * загружается конфиг, передается в роутер, получает данные по контроллеру,
 * выполняется метод нужного контроллера, получает результат выполнения, это в init().
 * Вычитавает route.yml преобразовает его в массив и передает в конструктор роутера,
 * вычитка выполняется в кернеле - метод readRouteConfig($file).
 */
$kernel = Kernel::getInstance();
$file = __DIR__ . '/../config/route.yml';
$kernel->init($file);

// метод getRoute(), возвращает объект Route.
$route = $kernel->getRoute();
$url = $_SERVER['REQUEST_URI'];
/*
 * метод match($url) (match - случать, подбирать под пару, соответствовать)
 * Перебирает $this->routeParams и находит нужный параметр.
 * Возвращает нужные параметры - возвращает array('controller' => 'контроллер', 'action' => 'метод').
 */
$routeParams = $route->match($url);
/*
 * метод process($param), в нём отрабатывает контроллер
 * отделяет класс (src\Controller\FileProcessController) и его метод (indexAction)
 * и создаваёт $controller = new src\Controller\FileProcessController(),возвращает данные для render().
 * Нужно выполнить метод контроллера и получить от него данные и вернуть.
 * $param = ['/', 'src\Controller\FileProcessController.indexAction'];
 */
$controllerParams = $kernel->process($routeParams);
/*
 * метод render($routeParams, $controllerParams) выполняет отображение результата работы
 */
$kernel->render($routeParams, $controllerParams); 

?>

