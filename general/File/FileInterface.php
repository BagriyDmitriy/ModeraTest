<?php
namespace general\File;

interface FileInterface{

    /*
     * read чтение всего файла
     */
 public function getContent();

    /*
     * перезапись файла  /(установка данных(замена) - set-метод)
     */
 public function setContent($content);

    /*
     * очистка файла
     */
 public function removeContent();
}
?>