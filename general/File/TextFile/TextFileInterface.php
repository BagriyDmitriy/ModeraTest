<?php
namespace general\File\TextFile;

use general\File as F;

interface TextFileInterface extends F\FileInterface{

    /*
     * readLine чтение файла построчно
     */
	 public function getAllLines();

    /*
     * кол-во строк файла
     */
	 public function getCountLines();
} 
?>