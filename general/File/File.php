<?php
namespace general\File;

/*
 * File class is designed to work with files.
 */
class File implements FileInterface{

	protected $pathToFile;

    /*
     * Constructor - object initialization, transfer the file name
     */
	public function __construct($path){
			$this ->pathToFile = $path;
	}

    /*
     * Getter, path + file name
     */
	public function getPathToFile(){					
		return $this -> pathToFile;
	}	
	
	/*
	 * Read, read the entire file
	 */
	public function getContent(){
		if(!file_exists($source = $this->getPathToFile())){
			return false;
		}
		return trim(file_get_contents($this->getPathToFile()));		 
	}

    /*
     * Overwrite File/(setting data(replacement) - set-method)
     */
	public function setContent($content){ 
		$source = $this->getPathToFile();				//
		if(false === file_put_contents($source,$content)) {
			throw new Exception("Can't set content to file");
		}
	}

    /*
     * Append to File/(adding data - APPEND-method)
     */
	public function addLine($content){ 
		$source = $this->getPathToFile();				//
		if(false === file_put_contents($source,$content,FILE_APPEND)){
			throw new Exception("Can't add line to file");				
		}
	}

    /*
     * File Cleaning
     */
	public function removeContent(){							
		$source = fopen($this->getPathToFile(), "w");		
		fclose($source);
	}
	
}
?>