
// Ajoute une ligne d'un contact dans le tableau
function addLine(contact) {
    var nouv = aCloner.clone(true);
    var tds = nouv.children();
    tds.eq(0).text(contact.nom);
    tds.eq(1).text(contact.prénom);
    tds.eq(2).text(contact.tél);
    // Paramétrage des boutons
    var boutons = tds.eq(3).children();
    boutons.eq(0).click(function () {
        modifier(contact.id, tds.parent());
    });
    boutons.eq(1).click(function () {
        supprimer(contact.id, tds.parent());
    });
    nouv.appendTo(tbd);
}

// Chargement des contacts et affichage dans la table
function loadContacts() {
    tbd.empty(); // On le vide, dans le cas où on recharge
    $.getJSON("listeContacts.php",
            function (liste) {
                for (i in liste) {
                    addLine(liste[i]);
                }
            }
    );
}

// ------- Fonctions de gestion des boutons

// Suppression d'un contact :
//   - idContact pour la requête AJAX vers la BD
//   - jQtr pour l'effacer dans la table affichée
function supprimer(idContact, jQtr) {
    $.get("delete.php", {'id': idContact}, function (res) {
        if (res == true)
            jQtr.remove();
        else 
            alert("Échec de la suppression du contact !");
    },
    'json');
}

// Ajouter un contact : on utilise le formulaire
function ajouter(jQtr) {
    var param = $('#formAjout').serialize();
    $.post("create.php", param, function (res) {
        if (res == false)
            alert("Échec de l'insertion du contact !");
        else
            addLine(res);
    },
    'json');
}

// Modification d'un contact :
//   - idContact pour la requête AJAX vers la BD
//   - leTR pour gérer la table affichée
function modifier(idContact, jQtr) {
    // Récupérer les valeurs des TDs, dans un tableau pour les inputs
    var tds = jQtr.children();
    var cells = [tds.eq(0).text(), tds.eq(1).text(), tds.eq(2).text()];
    // On vide les cellules et on met un input dans chaque TD avec la valeur de la cellule
    for (i = 0; i < 3; i++) {
        tds.eq(i).empty();
        $('<input type="text"/>').val(cells[i]).appendTo(tds.eq(i));
    }
    // On change l'image et le click du bouton modifier
    var btnModif = tds.eq(3).children().eq(0);
    // On efface le click vers modifier (sinon click() ajoute la fonction en plus de celle qui est déjà attachée
    // au bouton....
    btnModif.unbind('click');
    btnModif.attr("src", "../img/ok.png").click(function () {
        // Récupération des données dans un objet pour la requête AJAX
        var inputs = jQtr.find('input');
        var contact = {'id': idContact, 'nom': inputs.eq(0).val(),
                       'prénom': inputs.eq(1).val(), 'tél': inputs.eq(2).val()};
        // alert(contact.prénom + " " + contact.nom);
        $.post("update.php", contact, function (res) {
            if (res == false) {
                alert("Échec de la suppression du contact !");
            }
            // Pour faire simple ici, on recharge tout...
            loadContacts();
        },
        'json');
    });
}

// La ligne à cloner pour afficher les contacts
var aCloner;
// Le tbody à remplir avec les contacts
var tbd;

$(document).ready(function () {
    aCloner = $('table > thead > tr:last-child');
    tbd = $('table > tbody');
    // Définition du click sur ajouter
    $('table > tfoot img').click(function () {
        ajouter($('table > tfoot > tr'));
    });
    loadContacts();
});
