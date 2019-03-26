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
        $linesForParse = preg_split('/\n/',$text);
        $parsedData = [];

        foreach($linesForParse as $value){
            list($nodeId,$parentId,$nodeName) = explode("|", $value);			//node_id | parent_id | node_name

            $parsedData[] = [
                'nodeId' => trim($nodeId),
                'parentId' => trim($parentId),
                'nodeName' => trim($nodeName),
            ];
        }

        return $parsedData;
	}					
}

?>