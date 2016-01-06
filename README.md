# DAO
Écriture d'un ORM (Object Repository Manager) très simple basé sur trois classes :
*   `Classes/DAO.php` : classe dérivable en classe CRUD pour une table donnée
*   `Classes/TableObject.php` : correspondance ligne de table <-> objet PHP
*   `Classes/MaBD.php` : singleton pour l'accès à la base

Voir le dossier `ExemplesDAO` contenant une petite base de contacts (`Contacts.sql`), des classes dérivées de DAO et
TableObject (répertoire `ExemplesDAO/Classes`) et des programmes de tests (répertoire `ExemplesDAO/Tests`).

