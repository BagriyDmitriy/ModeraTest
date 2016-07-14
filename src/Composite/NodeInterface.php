<?php
namespace src\Composite;

interface NodeInterface{

    /*
     * возвращает id узла(ветки)
     */
    public function getId();

    /*
     * возвращает имя узла(ветки)
     */
    public function getName();

    /*
     * добавляет ветку(узел), $node
     */
    public function addChild(NodeInterface $node);

    /*
     *	возвращает потомков $node
     */
    public function getChildren();

    /*
     * возвращает одномерный массив данных для вывода на экран.
     */
    public function getDataToPrint($hyphen);
}
?>