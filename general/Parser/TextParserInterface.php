<?php
namespace general\Parser;

interface TextParserInterface{

    /*
     * Method parse($text) converts text to array, result = array of 12 elements (array lines) in which the 3 element.
     */
	public function parse($text);
}
?>