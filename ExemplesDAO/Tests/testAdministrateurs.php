<?php
// Autochargement des classes
function __autoload($class) { require_once "../Classes/$class.php"; }

function afficheTout($lesAdmins) {
    foreach ($lesAdmins as $c)
        echo $c, "\n";
    echo "---------------------------\n";
}

$moi = new Administrateur(array('id' => DAO::UNKNOWN_ID, 'login' => "Genthial", 'mdp' => "Genthial"));
echo $moi, "\n";
$admins = new AdministrateursDAO(MaBD::getInstance());
echo $admins->getOne(1), "\n";

echo "------- Tous les administrateurs :\n";
afficheTout($admins->getAll());

echo "Enregistrement de ";
$admins->insert($moi);
echo $moi, "\n";

echo "------- Tous les administrateurs triés par login :\n";
afficheTout($admins->getAll("ORDER BY login"));

echo "Modification de $moi\n";
$moi->mdp = "Damien";
$admins->update($moi);
echo "\t==> $moi\n";

echo "------- Tous les contacts triés par id décroissant :\n";
afficheTout($admins->getAll("ORDER BY id DESC"));

echo "Effacement de $moi\n";
$admins->delete($moi);

echo "------- Tous les administrateurs :\n";
afficheTout($admins->getAll());

?>
