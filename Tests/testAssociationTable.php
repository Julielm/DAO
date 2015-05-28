<?php
// test des cas particuliers dans DAO et TableObject :
//  - table composée seulement de deux clés étrangères, constituant la clé primaire

// Autochargement des classes
function __autoload($class) { require_once "../Classes/$class.php"; }

$assoADAO = new AssociationTableDAO(MaBD::getInstance());

echo "------- Valeurs avant insertion :\n";
foreach ($assoADAO->getAll() as $one)
    echo "$one\n";

echo "------- getOne(array(1, 2)) :\n";
$one = $assoADAO->getOne(array(1, 2));
echo "$one\n";

echo "------- Insertion de array('num' => 4, 'id' => 4) :\n";
$nouv = new AssociationTable(array('num' => 4, 'id' => 4));
$assoADAO->insert($nouv);

echo "------- getOne(array(4, 4)) :\n";
$dernierInsere = $assoADAO->getOne(array(4, 4));
echo "$dernierInsere\n";

echo "------- Toutes les valeurs :\n";
foreach ($assoADAO->getAll() as $one)
    echo "$one\n";

echo "------- Toutes les valeurs pour num = 1:\n";
foreach ($assoADAO->getAll("WHERE num='1'") as $one)
    echo "$one\n";

echo "------- Toutes les valeurs après suppression du dernier inséré :\n";
$assoADAO->delete($dernierInsere);
foreach ($assoADAO->getAll() as $one)
    echo "$one\n";

exit(0);
?>
