<?php
require_once "autoload.php";

// Vérifie qu'on a toutes les informations, mais ne vérifie pas le contenu
function checkData() {
    return isset($_GET['id']);
}

// Insertion d'un nouveau contact dans la base
if (checkData()) {
    $contacts = new ContactsDAO(MaBD::getInstance());
    $supp = $contacts->getOne($_GET['id']);
    $res = $contacts->delete($supp);
    if ($res === 0)
        echo json_encode(false);
    else
        echo json_encode(true);
} else echo json_encode(false);
?>
