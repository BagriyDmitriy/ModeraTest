<?php
namespace general\File\TextFile;

 use general\File as F;

    /*
     * TextFile class is designed to work with text files.
     */
 class TextFile extends F\File implements TextFileInterface{

    /*
     * Description (at least) an abstract interface methods
     */
	public function getContent(){} 
	public function setContent($content){} 
	public function removeContent(){}

    /*
     * Constructor - object initialization, transfer the file name
     */
	public function __construct($path){
			$this ->pathToFile = $path;
	}

    /*
     * read file, getAllLines() get file content
     */
	public function getAllLines(){				
		$textLines[] = file($this->getPathToFile());
		return $textLines;			
	}

     /*
      * getCountLines() - count lines in file
      */
	public function getCountLines(){							
		$CountLines = count(file($this->getPathToFile()));						
		return $CountLines;			
	}
}
?>