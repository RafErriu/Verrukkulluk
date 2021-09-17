<?php

class recept {

    private $connectie;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
    }

    public function ophalenRecept($recept_id) {
        $sql = "SELECT * FROM recept WHERE id = $recept_id";
        $result = mysqli_query($this->connectie, $sql);

        $recept = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return($recept);

    }
}