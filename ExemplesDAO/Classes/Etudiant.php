<?php
class Etudiant extends Personne {
    static public $keyFieldsNames = array('personneId'); // par défaut un seul champ
    public $hasAutoIncrementedKey = false;
}
?>
