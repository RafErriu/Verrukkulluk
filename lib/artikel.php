<?php

class artikel {

    private $connectie;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
    }

    public function ophalenArtikel($artikel_id) {
        $sql = "SELECT * FROM artikel WHERE id = $artikel_id";
        $result = mysqli_query($this->connectie, $sql);

        $artikel = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return($artikel);

    }
}