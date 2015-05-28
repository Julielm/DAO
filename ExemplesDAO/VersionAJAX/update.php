<?php
function __autoload($class) { require_once "../Classes/$class.php"; }

// Vérifie qu'on a toutes les informations, mais ne vérifie pas le contenu
function checkData() {
    return isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['prénom']) && isset($_POST['tél']);
}

// Insertion d'un nouveau contact dans la base
if (checkData()) {
    $contacts = new ContactsDAO(MaBD::getInstance());
    $maj = new Contact(array('id' => $_POST['id'],
        'nom' => $_POST['nom'], 'prénom' => $_POST['prénom'], 'tél' => $_POST['tél'])); 
    $res = $contacts->update($maj);
    if ($res === 0)
        echo json_encode(false);
    else
        echo json_encode(true);
} else echo json_encode(false);
?>
