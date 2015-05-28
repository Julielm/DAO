<?php
// Autochargement des classes
function __autoload($class) { require_once "../Classes/$class.php"; }

$pdo = MaBD::getInstance();
var_dump($pdo);

$stmt = $pdo->query("SELECT * FROM Contacts");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

?>
