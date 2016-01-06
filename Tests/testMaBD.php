<?php
require_once "autoload.php";

$pdo = MaBD::getInstance();
var_dump($pdo);

$stmt = $pdo->query("SELECT * FROM AssociationTable");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

?>
