<?php
require_once "autoload.php";

// ------- fonctions utilitaires -------
function afficherBoutons($id, $validation) {
    echo '<td>';
    if ($validation) {
        echo '<img src="../img/ok.png" alt="Valider" onclick="soumettre(\'ok\',', $id, ')"/>';
    } else {
        echo '<img src="../img/modif.png" alt="Modifier" onclick="soumettre(\'modif\',', $id, ')"/>';
    }
    echo '<img src="../img/supp.png" alt="Supprimer" onclick="soumettre(\'supp\',', $id, ')"/>';
    echo '</td>';
}

function toHTMLRow($contact, $idAModifier) {
    echo '<tr>'; 
    if ($idAModifier == $contact->id) {
        echo '<td><input type="text" name="nom" value="', $contact->nom, '"/></td>';
        echo '<td><input type="text" name="prénom" value="', $contact->prénom, '"/></td>';
        echo '<td><input type="text" name="tél" value="', $contact->tél, '"/></td>';
        afficherBoutons($contact->id, true);
    } else {
        echo sprintf('<td>%s</td><td>%s</td><td>%s</td>',
                     $contact->nom, $contact->prénom, $contact->tél);
        afficherBoutons($contact->id, false);
    }
    echo "</tr>\n";
}

// ------- contrôleur -------
session_start();
// Vérification de l'authentification
if (! isset($_SESSION['login'])) {
    // On renvoie vers la page d'accueil
    header("Location: login.php");
    exit(0);
}
$user = $_SESSION['login'];

$contacts = new ContactsDAO(MaBD::getInstance());

$idAModifier = 0; // Identifiant d'un éventuel contact à modifier
$message = "";    // Feedback ou erreur
$erreur = false;  // Change juste la couleur d'affichage du message

if (isset($_POST['quoi'])) { // le formulaire a été soumis
    // print_r($_POST);
    switch ($_POST['quoi']) {
    case 'modif': // Ouverture du formulaire de modification pour un contact
        $idAModifier = $_POST['id'];
        $message = "Pensez à enregistrer vos modifications en cliquant sur le bouton de validation.";
        break;
    case 'ok': // Validation du formulaire de modification
        $leContact = $contacts->getOne($_POST['id']);
        $leContact->nom = $_POST['nom'];
        $leContact->prénom = $_POST['prénom'];
        $leContact->tél = $_POST['tél'];
        $contacts->update($leContact);
        $message = "$leContact->prénom $leContact->nom a été mis à jour.";
        break;
    case 'supp': // Suppression d'un contact (sans confirmation, à la sauvage)
        $leContact = $contacts->getOne($_POST['id']);
        $contacts->delete($leContact);
        $message = "$leContact->prénom $leContact->nom a été effacé.";
        break;
    case 'plus':
        $tab = array('id' => DAO::UNKNOWN_ID, 'nom' => $_POST['nouvnom'], 'prénom' => $_POST['nouvprénom'], 'tél' => $_POST['nouvtél']);
        $leContact = new Contact($tab);
        $contacts->insert($leContact);
        $message = "$leContact->prénom $leContact->nom a été ajouté.";
        break;
    } 
}

// (Re)chargement de la liste des contacts à afficher
$lesContacts = $contacts->getAll("ORDER BY nom,prénom ASC");

// ------- vue -------
echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
   <link rel="stylesheet" type="text/css" href="Contacts.css"/>
    <script type="text/javascript">
    //<![CDATA[
function soumettre(action, id) {
    document.getElementById('quoi').value = action;
    document.getElementById('id').value = id;
    document.forms['form'].submit();
}
    //]]>
    </script>
   <title>Gestion des contacts</title>
</head>
<body>
<?php // débogage
    // echo '<pre>'; print_r($_POST);  print_r($leContact); echo '</pre><hr/>';
?>
<p class="entete">Vous êtes connecté en <b><?php echo $user; ?></b></p> 
<h1>Gestion des contacts</h1>
<form id="form" name="form" action="" method="post">
<input id="quoi" type="hidden" name="quoi" value="modif"/>
<input id="id" type="hidden" name="id" value="0"/>
<table class="form">
    <thead>
        <tr><th>Nom</th><th>Prénom</th><th>Téléphone</th><th></th></tr>
    </thead>
    <tbody>
        <?php
        foreach ($lesContacts as $contact)
            toHTMLRow($contact, $idAModifier);
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td><input type="text" name="nouvnom"/></td>
            <td><input type="text" name="nouvprénom"/></td>
            <td><input type="text" name="nouvtél"/></td>
            <td><img src="../img/plus.png" alt="Ajouter" onclick="soumettre('plus', 0)"/></td>
        </tr>
    </tbody>
</table>
</form>
<?php 
if (! empty($message))
    echo '<p class="', $erreur?"erreur":"message", '">', $message, '</p>';
?>
</body> 
</html>
