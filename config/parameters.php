<?php
namespace Config;

/*
 * class Parameters containing config variables, array variables
 */
class Parameters
{

    public function getConfigParameters($key = 'uplPath')
    {
        if ('uplPath' == $key){
            /*my config variable path for folder upl*/
            $uplPath = $_SERVER['DOCUMENT_ROOT'].'/upl/';
            $result = $uplPath;
        }
        else {
            /*my config variables array 'fileUploadParameters' for uploading file*/
            $fileUploadParameters = [
                                     'uplTempNamePath' => $_FILES['uploadfile']['tmp_name'],
                                     'uplNamePath' => $_FILES['uploadfile']['name'],
                                    ];
            $result = $fileUploadParameters;
        }
        return $result;
    }
}