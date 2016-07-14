<?php
namespace general\File;

interface FileInterface{

    /*
     * Read, read the entire file
     */
 public function getContent();

    /*
     * Overwrite File/(setting data(replacement) - set-method)
     */
 public function setContent($content);

    /*
     * File Cleaning
     */
 public function removeContent();
}
?>