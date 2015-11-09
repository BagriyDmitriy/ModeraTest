<?php
namespace general\File;

interface FileInterface{
 public function getContent(); 
 public function setContent($content); 
 public function removeContent();
}
?>