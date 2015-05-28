<?php
// Test d'une classe dérivée : Administratif hérite de Administratif
// Autochargement des classes
function __autoload($plass) { require_once "../Classes/$plass.php"; }

$moi = new Administratif(array('personneId' => DAO::UNKNOWN_ID, 
    'nom' => "Genthial", 'prénom' => "Damien",
    'courriel' => "Damien.Genthial@gmail.com",
    'bureau' => "A999", 'poste' => "999"));
echo $moi, "\n";
$administratifs = new AdministratifsDAO(MaBD::getInstance());
echo $administratifs->getOne(1), "\n";
echo $administratifs->getOne(2), "\n";

echo "------- Tous les administratifs :\n";
foreach ($administratifs->getAll() as $p)
    echo $p, "\n";
echo "---------------------------\n";

echo "Enregistrement de ";
$administratifs->insert($moi);
echo $moi, "\n";

echo "------- Tous les administratifs triés par nom :\n";
foreach ($administratifs->getAll("ORDER BY nom") as $p)
    echo $p, "\n";
echo "---------------------------\n";

echo "Modification de $moi\n";
$moi->courriel = "Truc@machin.fr";
$moi->poste = "812";
$administratifs->update($moi);
echo "\t==> $moi\n";

echo "------- Tous les administratifs triés par prénom :\n";
foreach ($administratifs->getAll("ORDER BY prénom") as $p)
    echo $p, "\n";
echo "---------------------------\n";

echo "Effacement de $moi\n";
$administratifs->delete($moi);

echo "------- Tous les administratifs triés par courriel :\n";
foreach ($administratifs->getAll("ORDER BY courriel") as $p)
    echo $p, "\n";
echo "---------------------------\n";

?>
