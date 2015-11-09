<?php

namespace app\Route;

/*
 * класс Route получает данные из файла -конфига, формирует пути.
 */
class Route{
    /*
     * свойство $routeParams, массив содержит параметры роутера
     */
    public $routeParams;

    /*
     * конструктор __construct(array $config) получает уже массив $config - данные из файла.
     */
    public function __construct(array $config){
        $this->routeParams = $config;
    }

    /*
     * метод match($url) (match - случать, подбирать под пару, соответствовать)
     * Перебирает $this->routeParams и находит нужный параметр.
     * Возвращает нужные параметры - возвращает array('controller' => 'контроллер', 'action' => 'метод').
     */
    public function match($url){
        foreach($this->routeParams as $param){
            if ( $param[0] == $url ){
                $controllerParams = explode('.', $param[1]);
                return array('controller' => $controllerParams[0], 'action' =>$controllerParams[1]);
            }
        }
    }

}
?>