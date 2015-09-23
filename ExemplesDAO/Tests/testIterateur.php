<?php
// Autochargement des classes
function __autoload($class) { require_once "../Classes/$class.php"; }

$contacts = new ContactsDAO(MaBD::getInstance());
echo "------- Tous les contacts :\n";
$iter = $contacts->getIterator();
foreach ($iter as $index => $c)
    echo $index, " : ", $c, "\n";
echo "---------------------------\n";

echo "------- Tous les contacts triés par nom :\n";
$iter = $contacts->getIterator("ORDER BY nom DESC");
foreach ($iter as $index => $c)
    echo $index, " : ", $c, "\n";
echo "---------------------------\n";

echo "------- Tous les contacts triés par numéro de téléphone :\n";
$iter = $contacts->getIterator("ORDER BY tél");
foreach ($iter as  $index => $c)
    echo $index, " : ", $c, "\n";
echo "---------------------------\n";
$iter->rewind();
foreach ($iter as  $c)
    echo $c, "\n";
echo "---------------------------\n";

?>
