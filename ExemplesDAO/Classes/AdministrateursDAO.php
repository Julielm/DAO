<?php
class AdministrateursDAO extends DAO {
    protected $table = "Administrateurs";
    protected $class = "Administrateur";

    // Vérification qu'un couple (login, mdp) est bien dans la base
    // Retourne l'utilisateur trouvé ou null
    public function checkUser($login, $mdp) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE login=? AND mdp=?");
        $stmt->execute(array($login, $mdp));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($row);
        if ($row === false) 
            return null;
        return new $this->class($row);
    }
}
?>
