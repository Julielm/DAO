<?php
class AssociationTable extends TableObject {
    static public $keyFieldsNames = array('num', 'id'); 
    public $hasAutoIncrementedKey = false;

    public function __tostring() { return "num = $this->num, id = $this->id"; }
}
?>
