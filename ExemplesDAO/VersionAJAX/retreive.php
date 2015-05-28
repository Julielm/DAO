<?php
// Autochargement des classes
function __autoload($class) { require_once "../Classes/$class.php"; }

if (! isset($_GET['id'])) {
    echo json_encode(false);
} else {
    $contacts = new ContactsDAO(MaBD::getInstance());
    $c = $contacts->getOne($_GET['id']);
    if ($c == null)
        echo json_encode(false);
    else
        echo json_encode($c);
}
?>
