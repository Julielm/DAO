<?php
class Administratif extends Personne {
    static public $keyFieldsNames = array('personneId'); // par défaut un seul champ
    public $hasAutoIncrementedKey = false;
}
?>
