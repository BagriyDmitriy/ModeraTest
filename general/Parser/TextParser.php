<?php

namespace general\Parser;

/*
 * TextParser class - data conversion (from the text of the array).
 */
class TextParser implements TextParserInterface{

    /*
     * Method parse($text) converts text to array, result = array of 12 elements (array lines) in which the 3 element.
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