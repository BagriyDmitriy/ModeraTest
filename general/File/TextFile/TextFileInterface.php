<?php
namespace general\File\TextFile;

use general\File as F;

interface TextFileInterface extends F\FileInterface{
	 public function getAllLines();
	 public function getCountLines();
} 
?>