<?php
function __autoload($class) { require_once "../Classes/$class.php"; }

// ------- fonctions utilitaires -------
function toHTMLRow($contact, $idAModifier) {
    echo '<tr>'; 
    echo sprintf('<td>%s</td><td>%s</td><td>%s</td>',
                 $contact->nom, $contact->prénom, $contact->tél);
    echo "</tr>\n";
}

// ------- contrôleur -------
$contacts = new ContactsDAO(MaBD::getInstance());
// Chargement de la liste des contacts à afficher
$lesContacts = $contacts->getAll("ORDER BY nom,prénom ASC");


// ------- vue -------
echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
   <link rel="stylesheet" type="text/css" href="Contacts.css"/>
   <title>Liste des contacts</title>
</head>
<body>
<p class="entete"><a href="gestion.php">Modifier</a></p> 
<h1>Liste des contacts</h1>
<table>
    <thead>
        <tr><th>Nom</th><th>Prénom</th><th>Téléphone</th></tr>
    </thead>
    <tbody>
        <?php
        foreach ($lesContacts as $contact)
            toHTMLRow($contact, $idAModifier);
        ?>
    </tbody>
</table>
</form>
</body> 
</html>
