<?php

class gerecht_info {

    private $connectie;
    private $user;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
    }

    private function ophalenUser($user_id) {
    }

    public function ophalenInfoType($recept_id, $record_type) {

        $sql = "SELECT * FROM gerecht_info WHERE recept_id = $recept_id AND record_type = '$record_type'";

      
        $result = mysqli_query($this-> connectie, $sql);

        $gerecht_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return($gerecht_info);
    }
}