<?php
// test des cas particuliers dans DAO et TableObject :
//  - table composée d'un seul champ clé autoincrémentée

require_once "autoload.php";

echo "------- Avant insertion :\n";
$nouv = new OneAutoIncremented(array('num' => DAO::UNKNOWN_ID));
echo "$nouv\n";

echo "------- Après insertion :\n";
$oneDAO = new OneAutoIncrementedDAO(MaBD::getInstance());
$oneDAO->insert($nouv);
echo "$nouv\n";

echo "------- Après getOne($nouv->num) :\n";
$dernierInsere = $oneDAO->getOne($nouv->num);
echo "$dernierInsere\n";

echo "------- Toutes les valeurs :\n";
foreach ($oneDAO->getAll() as $one)
    echo "$one\n";

echo "------- Toutes les valeurs en ordre inverse :\n";
foreach ($oneDAO->getAll("ORDER BY num DESC") as $one)
    echo "$one\n";

echo "------- Toutes les valeurs après suppression du dernier inséré :\n";
$oneDAO->delete($dernierInsere);
foreach ($oneDAO->getAll() as $one)
    echo "$one\n";

exit(0);
?>
