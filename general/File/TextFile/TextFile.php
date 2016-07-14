<?php
namespace general\File\TextFile;

 use general\File as F;
 
/* 
 * класс TextFile предназначен для работы с текстовыми файлами.
 */
 class TextFile extends F\File implements TextFileInterface{
	/*
	 * описание(как минимум) абстрактных методов интерфейса 
	 */
	public function getContent(){} 
	public function setContent($content){} 
	public function removeContent(){}
	
	/*
	 * конструктор -инициализация обьекта, передача названия файла
	 */
	public function __construct($path){
			$this ->pathToFile = $path;
	}

	/*
	 * readLine чтение файла построчно	
	 */
	public function getAllLines(){				
		$textLines[] = file($this->getPathToFile());
		return $textLines;			
	}
	
	/*
	 * кол-во строк файла
	 */
	public function getCountLines(){							
		$CountLines = count(file($this->getPathToFile()));						
		return $CountLines;			
	}
}
?>