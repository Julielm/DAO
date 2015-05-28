<?php
function __autoload($class) { require_once "../Classes/$class.php"; }

// Vérifie qu'on a toutes les informations, mais ne vérifie pas le contenu
function checkData() {
    return isset($_POST['nom']) && isset($_POST['prénom']) && isset($_POST['tél']);
}

// Insertion d'un nouveau contact dans la base, renvoie le contact créé (en JSON) ou false en cas d'erreur
// On renvoie le nouveau contact pour avoir son id (autoincrémenté)
if (checkData()) {
    $contacts = new ContactsDAO(MaBD::getInstance());
    $nouveau = new Contact(array('id' => DAO::UNKNOWN_ID,
        'nom' => $_POST['nom'], 'prénom' => $_POST['prénom'], 'tél' => $_POST['tél'])); 
    $res = $contacts->insert($nouveau);
    if ($res === 0)
        echo json_encode(false);
    else
        echo json_encode($nouveau);
} else echo json_encode(false);
?>
