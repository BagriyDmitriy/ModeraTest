<?php
namespace general\File;

/* 
 * класс File предназначен для работы с файлами.
 */
class File implements FileInterface{

	protected $pathToFile;  	
	
	/*
	 * конструктор -инициализация обьекта, передача названия файла
	 */
	public function __construct($path){
			$this ->pathToFile = $path;
	}
	
	/*
	 * геттер путь+назв файла
	 */
	public function getPathToFile(){					
		return $this -> pathToFile;
	}	
	
	/*
	 * read чтение всего файла
	 */
	public function getContent(){
		if(!file_exists($source = $this->getPathToFile())){
			return false;
		}
		return trim(file_get_contents($this->getPathToFile()));		 
	}	
	
	/*
	 * перезапись файла  /(установка данных(замена) - set-метод)
	 */
	public function setContent($content){ 
		$source = $this->getPathToFile();				//
		if(false === file_put_contents($source,$content)) {
			throw new Exception("Can't set content to file");
		}
	}
	
	/*
	 * дозапись в файл  /(добавление данных - аппенд-метод)
	 */
	public function addLine($content){ 
		$source = $this->getPathToFile();				//
		if(false === file_put_contents($source,$content,FILE_APPEND)){
			throw new Exception("Can't add line to file");				
		}
	}
	
	/*
	 * очистка файла
	 */
	public function removeContent(){							
		$source = fopen($this->getPathToFile(), "w");		
		fclose($source);
	}
	
}
?>