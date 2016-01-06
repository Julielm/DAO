<?php
require_once "autoload.php";

$factory = new ContactsDAO(MaBD::getInstance());
$lesContacts = $factory->getAll("ORDER by nom"); 
//echo json_encode($lesContacts, JSON_PRETTY_PRINT);
echo json_encode($lesContacts);
?>
