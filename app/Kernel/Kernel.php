<?php
namespace app\Kernel;
use \Symfony\Component\Yaml\Yaml;
use \app\Route\Route;
use \src\controller;

/*
 * Kernel - Класс kernel синглтон, в котром загружается конфиг, передается в роутер, получает данные по контроллеру,
 * выполняется метод нужного контроллера, получает результат выполнения, это в init().
 * Вычитавает route.yml преобразовает его в массив и передает в конструктор роутера,
 * вычитка выполняется в кернеле - метод readRouteConfig($file).
 */
final class Kernel{
	
	/*
	 * статическая переменная, в которой мы будем хранить экземпляр класса
	 */
	static $_instance; 
	
	/*
	 * свойство, экземпляр класса Route
	 */	
	public $route;
	
	/*
	 * метод getInstance() - типичный синглтон.
	 */	
	public static function getInstance() { 
		if(!(self::$_instance instanceof self)) //типичный синглтон
			self::$_instance = new self();
		return self::$_instance;
	}
	
	/*
	 * приватный конструктор ограничивает реализацию getInstance()	
	 */
	private function __construct(){ //конструктор закрытый private		!!!и пустой!!!	
	}
	
	/*
	 * метод readRouteConfig($file) вычитавает route.yml преобразовывает его в масcив и передаёт в конструктор роутера						 			 
	 */
	protected function readRouteConfig($file){			// protected!!!		
		 $pathes = Yaml::parse(file_get_contents($file));
		 return $pathes;
	}
	    	
	/*
	 * метод init($file) - инициализирует, ничего не возвращает. Инициализирует объект Роут и передаёт распарсенный массив.
	 * после метода init($file) в Kernel - заполненный Route.
	 */		
	public function init($file) {//!!!НЕ нужен ретурн!!! 
		$routeConfig = $this->readRouteConfig($file); 		
		$this->route = new Route($routeConfig);	
    }
	
	/*
	 * метод getRoute(), возвращает объект Route.		
	 */
	public function getRoute(){	
		return $this->route;		
    } 
				
	/*
	 * метод process($param), в нём отрабатывает контроллер		
	 * отделяет класс (src\Controller\FileProcessController) и его метод (indexAction)
	 * и создаваёт $controller = new src\Controller\FileProcessController(),возвращает данные для render().
	 * Нужно выполнить метод контроллера и получить от него данные и вернуть.
     * $param = ['/', 'src\Controller\FileProcessController.indexAction'];
	 */
	public function process($param){			
		$controllerData = $param['controller'];  
		$controller = new $controllerData();

		$actionData = $param['action'];

		return $controller -> $actionData();
	}
		
	/*
	 * метод getViewPath(), формирование пути для render()		
	 */
	public function getViewPath() {
        return realpath( __DIR__ . '/../../src/view/');
	}	
	
	/*
     * метод render($routeParams, $controllerParams) выполняет отображение результата работы
	 */	
	public function render($routeParams, $controllerParams){ 					
		$splits = explode('\\', $routeParams['controller']);
		$path_controller = str_replace('Controller','',array_pop($splits));			
		$path_action = str_replace('Action','',$routeParams['action']).'.php';
		
		$path = $this->getViewPath().'\\'.$path_controller.'\\'.$path_action;
		if(!file_exists($path)){
			echo '<pre> Abnormal render path: ',var_dump($path); 
		}
		else{
			include($path);			
		}		
	}

}
?>
