<?php
// Autochargement des classes
function __autoload($class) { require_once "../Classes/$class.php"; }

// TableObject avec un champ NULL

$to = new TableObject(array('id' => NULL));

var_dump($to);
var_dump($to->id);

?>
