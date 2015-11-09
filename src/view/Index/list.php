<?php
/*list - отображение результата	
View/FileProcess/list.php*/
header('Content-Type: text/html; charset=utf-8'); 
use src\Factory as F;	
require_once "..\src\controller\IndexController.php";	
$params = $controllerParams;
echo "я вьюшка list.php",'<br /><h2>Parsed data: </h2>',"<pre>",print_r($params[0]),"</pre>","<hr>",		
	 "<h2>Tree structure:</h2>","<pre>",print_r($params[1]),"</pre>";		
?>