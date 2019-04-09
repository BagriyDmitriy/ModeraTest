<?php
namespace src\Controller;

use general as G;		
use src\Factory as F;
use src\Composite as C;
use config\Parameters as Parameters;
/*
 * Class File Process Controller, the controller performs Actions according to the address bar.
 */
class FileProcessController {

    /*
     * Method (Action) indexAction() of controller is executed by default
     * when specifying the address bar http://modera_test.loc/, view index.php
     */
	public function indexAction() {

	}

    /*
     * Method (Action) uploadAction() of controller to the server to download a file,
     * processing content, the transmission parameters listAction(),
     * is performed by specifying the address bar http: //modera_test.loc/upload, view upload.php
     */
	public function uploadAction() {
        $configParams = new Parameters();
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
     * Method (Action) listAction() of controller, parsed into an array of content,
     * is performed by specifying the address bar http://modera_test.loc/list, result output - view list.php
     */
	public function listAction() {
        $configParams = new Parameters();
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
        // Sort the array with the data so that the branches was the first.
/***********replace create_function with anonymous function*************************************************************************************************/
        /*
         usort($dataArray, create_function('$a,$b','if ((int)$a["parentId"]===(int)$b["parentId"]) return (int)$a["nodeId"]>(int)$b["nodeId"] ? 1 : -1;
                    return (int)$a["parentId"]>(int)$b["parentId"] ? 1 : -1;'));
        */
        $func = function($a,$b) { if ((int)$a['parentId']===(int)$b['parentId']) return (int)$a['nodeId']>(int)$b['nodeId'] ? 1 : -1;
            return (int)$a['parentId']>(int)$b['parentId'] ? 1 : -1;};
        usort($dataArray, $func);

/***********replace create_function with anonymous function*************************************************************************************************/

        // To create the main node through the factory.
		$root = $factory->createRoot(array('nodeId'=>0, 'nodeName'=>'root'));
        // Gathering wood
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