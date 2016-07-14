<?php
namespace general\File\TextFile;

use general\File as F;

interface TextFileInterface extends F\FileInterface{

    /*
     * getAllLines() get file content
     */
	 public function getAllLines();

    /*
     * read file, getAllLines() get file content
     */
	 public function getCountLines();
} 
?>