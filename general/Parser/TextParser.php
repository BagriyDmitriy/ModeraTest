<?php

namespace general\Parser;	

/*
 * класс TextParser - преобразование данных(из текста в массив).
 */	
class TextParser implements TextParserInterface{
	
	/*
	 * метод parse($text) преобразует текст в массив, результат = массив из 12и эл-тов(массивов строк), в которых по 3 эл-та.  
	 */
	public function parse($text){	
		$lines4Parse = preg_split('/\n/',$text);
		
		foreach($lines4Parse as $v){	
			$parsedLine = '';			
			list($nodeId,$parentId,$nodeName) = explode("|", $v);			//node_id | parent_id | node_name

            $parsedLine["nodeId"] = trim($nodeId);
            $parsedLine["parentId"] = trim($parentId);
            $parsedLine["nodeName"] = trim($nodeName);

			$parsedData[] = $parsedLine;
		}
		return $parsedData;
	}					
}

?>