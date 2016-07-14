<?php
namespace src\Factory;

interface FactoryInterface{

    /*
     * метод create(array $params) создаёт композит. $params - это данные из файла, строки.
     */
    public function create(array $params);

    /*
     * метод createRoot(array $params) создаёт композит. $params - это данные для создания корня композиции.
     */
    public function createRoot(array $params);
}
?>