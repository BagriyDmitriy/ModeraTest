<?php
namespace src\controller;

use general as G;		
use src\Factory as F;
use src\Composite as C;

/*
 * класс IndexController, контроллер выполняет Action(-ы) в соответствии с адресной строкой.
 */
class IndexController implements IController {
	
	/*
     * метод(Action) контроллера indexAction(), выполняется по -умолчанию
	 * при указании в адресной строке http://modera_test.loc/, вьюшка index.php 
	 */
	public function indexAction() {
	}	
		
	/*
     * метод(Action) контроллера uploadAction(), загрузка файла на сервер,
	 * обработка контента, передача параметров в listAction(), 
	 * выполняется при указании в адресной строке http://modera_test.loc/upload, вьюшка upload.php
	 */
	public function uploadAction() {					

		if (is_uploaded_file($_FILES['uploadfile']['tmp_name'])) { 
			$uploadfile = $_SERVER['DOCUMENT_ROOT'].'/upl/'.basename($_FILES['uploadfile']['name']);
			copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
 
			if (!$handle = fopen($uploadfile, 'a')){
				echo "Can't open file($uploadfile)";
				exit;
			}
					
			$params['success'] = true;
			$params['filename'] = $uploadfile;				
										
			$file = new G\File\File($params['filename']);
			$params['size'] = filesize($params['filename']);
			$text = $file->getContent();	
			$params['text'] = $text;
						
			$file = new G\File\TextFile\TextFile($params['filename']);			
			$countlines = $file -> getCountLines();										
			$params['cnt'] = $countlines; 			
		}
		else{
			$params['success'] = false;
		}	
		return  $params;
	}
	
	/*
	 * метод(Action) контроллера listAction(), распарсивание контента в массив,
	 * выполняется при указании в адресной строке http://modera_test.loc/list, вывод результата - вьюшка list.php
	 */	
	public function listAction() { 
		$path = $_SERVER['DOCUMENT_ROOT'].'/upl/';			
		if ($handle = opendir($path)) {		
			while (false !== ($file = readdir($handle))) { 
				if ($file != "." && $file != "..") { 				
					$path = $_SERVER['DOCUMENT_ROOT'].'/upl/'.$file;		
				} 
			}
		}
		closedir($handle); 			
						
		$file = new G\File\File($path);
		$text = $file->getContent();		

		/*PARSE DATA*/		
		$parser = new G\Parser\TextParser();
		$dataArray = $parser->parse($text); 		
		/*PARSE DATA*/		

/***********Create a tree structure******************************/
		$factory = new F\GoodsFactory();
		//отсортировать массив с данными так, чтоб корневые ветви были первые.
	    usort($dataArray, create_function('$a,$b','if ((int)$a["parentId"]===(int)$b["parentId"]) return 0;
	     return (int)$a["parentId"]>(int)$b["parentId"] ? 1 : -1;'));
        //cоздать основной узел через фабрику.
		$root = $factory->createRoot(array('nodeId'=>0, 'nodeName'=>'root'));		
		//собрать дерево
		foreach($dataArray as $data) {
			$iterator = $root->getIterator();		
			$iterator->seek($data['parentId']);			
			$parent = $iterator->current();				
			$item = $factory->create($data);			
			$parent->addChild($item);		
		}	
/***********Create a tree structure******************************/		
		$params[0] = $dataArray;
		$params[1] = $root->getDataToPrint();		
		return $params;
	}
	
}