<?php
// Illustration de l'utilisation du DAO avec un objet impliquant deux tables, Administratif hérite de Personne
class AdministratifsDAO extends DAO {
    protected $table = "Administratifs";
    protected $class = "Administratif";

    private $requete = "SELECT personneId, nom, prénom, courriel, bureau, poste FROM Administratifs JOIN Personnes ON Personnes.id = personneId";

    // Construction de la requête permettant d'obtenir un objet de la base.
    protected function buildStmtGetOne() {
        $req = "$this->requete $this->keyWhereClause";
        return $this->pdo->prepare($req);
    }

    // Récupération de tous les objets dans une table (peut être vide)
    // $complementRequete contient une chaîne ajoutée à la requête, par exemple :
    //      ORDER BY champ;
    //      WHERE champ = 'valeur';
    public function getAll($complementRequete = "") {
        $stmt = $this->pdo->query("$this->requete $complementRequete");
        return $this->toObjectArray($stmt);
    }

    // Insertion de l'objet :
    public function insert($obj) {
        // insertion dans la table Personne
        $personne = new Personne(array('id' => DAO::UNKNOWN_ID, 'nom' => $obj->nom, 'prénom' => $obj->prénom, 'courriel' => $obj->courriel));
        $personnes = new PersonnesDAO($this->pdo);
        $personnes->insert($personne);
        // récupération du id
        $obj->personneId = $personne->id;
        //insertion dans la table Administratifs
        return $this->pdo->exec("INSERT INTO $this->table (personneId, bureau, poste) VALUES ('$obj->personneId', '$obj->bureau', '$obj->poste')");
    }

    // Mise à jour de l'objet, impossible s'il n'y a pas au moins un champ en plus de la clé
    public function update($obj) {
        // mise à jour dans la table Personne
        $personne = new Personne(array('id' => $obj->personneId, 'nom' => $obj->nom, 'prénom' => $obj->prénom, 'courriel' => $obj->courriel));
        $personnes = new PersonnesDAO($this->pdo);
        $personnes->update($personne);
        //mise à jour dans la table Administratifs
        return $this->pdo->exec("UPDATE $this->table SET bureau='$obj->bureau', poste='$obj->poste'");
    }

    // Effacement de l'objet $obj (DELETE)
    public function delete($obj) {
        // effacement dans la table Administratifs
        $this->pdo->exec("DELETE FROM $this->table WHERE id='$this->personneId'");
        // effacement dans la table Personne, le id suffit dans l'objet créé
        $personne = new Personne(array('id' => $obj->personneId));
        $personnes = new PersonnesDAO($this->pdo);
        $personnes->delete($personne);
    }

}
?>
