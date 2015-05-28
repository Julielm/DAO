<?php
// Autochargement des classes
function __autoload($class) { require_once "../Classes/$class.php"; }

$factory = new ContactsDAO(MaBD::getInstance());
$lesContacts = $factory->getAll("ORDER by nom"); 
//echo json_encode($lesContacts, JSON_PRETTY_PRINT);
echo json_encode($lesContacts);
?>
