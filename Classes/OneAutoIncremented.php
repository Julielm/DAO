<?php
class OneAutoIncremented extends TableObject {
    static public $keyFieldsNames = array('num'); 
    public $hasAutoIncrementedKey = true;

    public function __tostring() { return "num = $this->num"; }
}
?>
