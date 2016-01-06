<?php
require_once "autoload.php";

// TableObject avec un champ NULL

$to = new TableObject(array('id' => NULL));

var_dump($to);
var_dump($to->id);

?>
