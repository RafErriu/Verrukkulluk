<?php

class gerecht_info {

    private $connectie;
    private $user;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
        $this->user = new user($db);
    }

    private function ophalenUser_Gerecht($user_id) {
        $us = $this->user->ophalenUser($user_id);
        return($us);
    }

    public function ophalenInfoType($recept_id, $record_type) {

        $gerecht_info = [];
        $sql = "SELECT * FROM gerecht_info WHERE recept_id = $recept_id AND record_type = '$record_type'";
        $result = mysqli_query($this-> connectie, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){      
            if($record_type == 'O' || $record_type == 'F'){
               $us = $this->ophalenUser_Gerecht($row['user_id']);
            }
            $gerecht_info[] = $row;
        }

        return($gerecht_info);
    }


    public function toevoegenFavoriet($recept_id, $user_id) {
         $sql = "INSERT INTO gerecht_info (recept_id, user_id, record_type) VALUES ($recept_id, $user_id, 'F')";
         $result = mysqli_query($this->connectie, $sql);
    }
}