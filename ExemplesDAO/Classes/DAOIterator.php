<?php
/*
 * Classe pour itérer ligne par ligne sur les résultats d'un requête.
 */

use \PDO;

class DAOIterator Implements \Iterator {
    private $index; // Rang dans la liste itérée
    private $stmt;  // PreparedStatement à utiliser 
    private $className;  // Nom de la classe des objets à produire
    private $courant; // Élément courant de l'itération

    // Reçoit un PDOStatement, initialisé par prepare, et le nom de la classe des objets à produire
    public function __construct(PDOStatement $stmt, string $className) {
        $this->stmt = $stmt;
        $this->className = $className;
        $this->init();
    }

    private function init() {
        $this->stmt->execute();
        $this->index = -1;
        $this->next();
    }

    public function current() { return $this->courant; }

    public function key() { return $this->index; }

    public function next() {
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        if ($row === false) {
            $this->courant = null;
            $this->index = -1;
        } else {
            $this->courant = new $this->className($row);
            $this->index = $this->index + 1;
        }
    }

    public function rewind() {
        $this->stmt->closeCursor();
        $this->init();
    }

    public function valid() { return ($this->courant !== null); }
}

?>
