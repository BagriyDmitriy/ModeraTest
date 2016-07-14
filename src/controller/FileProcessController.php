<?php
namespace src\controller;

use general as G;		
use src\Factory as F;
use src\Composite as C;
use config as Config;
/*
 * класс FileProcessController, контроллер выполняет Action(-ы) в соответствии с адресной строкой.
 */
class FileProcessController {
	
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
        $configParams = new Config\Parameters();
        $uplPath = $configParams -> getConfigParameters();
        $parameters = $configParams -> getConfigParameters('fileUploadParameters');

        $uplTempNamePath = $parameters['uplTempNamePath'];
        $uplNamePath = $parameters['uplNamePath'];

        if (is_uploaded_file($uplTempNamePath)) {
            $uploadfile = $uplPath.basename($uplNamePath);
            copy($uplNamePath, $uploadfile);

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
        $configParams = new Config\Parameters();
        $uplPath = $configParams -> getConfigParameters();

        $path = $uplPath;
		if ($handle = opendir($path)) {		
			while (false !== ($file = readdir($handle))) { 
				if ($file != "." && $file != "..") {
                    $path = $uplPath.$file;
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