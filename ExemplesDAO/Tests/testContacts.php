<?php
// Autochargement des classes
function __autoload($class) { require_once "../Classes/$class.php"; }

function afficheTout($contacts) {
    echo "------- Tous les contacts :\n";
    foreach ($contacts->getAll() as $c)
        echo $c, "\n";
    echo "---------------------------\n";
}

$moi = new Contact(array('id' => DAO::UNKNOWN_ID, 
    'nom' => "Genthial", 'prénom' => "Damien",
    'tél' => "04 75 99 99 99"));
echo $moi, "\n";
$contacts = new ContactsDAO(MaBD::getInstance());
echo $contacts->getOne(1), "\n";
echo $contacts->getOne(2), "\n";

echo "------- Tous les contacts :\n";
foreach ($contacts->getAll() as $c)
    echo $c, "\n";
echo "---------------------------\n";

echo "Enregistrement de ";
$contacts->insert($moi);
echo $moi, "\n";

echo "------- Tous les contacts triés par nom :\n";
foreach ($contacts->getAll("ORDER BY nom") as $c)
    echo $c, "\n";
echo "---------------------------\n";

echo "Modification de $moi\n";
$moi->tél = "04 75 41 88 12";
$contacts->update($moi);
echo "\t==> $moi\n";

echo "------- Tous les contacts triés par prénom :\n";
foreach ($contacts->getAll("ORDER BY prénom") as $c)
    echo $c, "\n";
echo "---------------------------\n";

afficheTout($contacts);

echo "Effacement de $moi\n";
$contacts->delete($moi);

echo "------- Tous les contacts triés par numéro de téléphone :\n";
foreach ($contacts->getAll("ORDER BY tél") as $c)
    echo $c, "\n";
echo "---------------------------\n";

?>
