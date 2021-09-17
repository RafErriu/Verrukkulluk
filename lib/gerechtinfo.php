<?php

class gerecht_info {

    private $connectie;
    private $user;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
    }

    private function ophalenUser_Gerecht($user_id) {
        return($user_id);
    }

    public function ophalenInfoType($recept_id, $record_type) {

        $gerecht_info = [];
        $sql = "SELECT * FROM gerecht_info WHERE recept_id = $recept_id AND record_type = '$record_type'";
        $result = mysqli_query($this-> connectie, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){      
            if($record_type == 'O' || $record_type == 'F'){
               $user = $this->ophalenUser_Gerecht($row['user_id']);
               echo $user;

            }
            $gerecht_info[] = $row;

        }
        return($gerecht_info);
    }

    public function toevoegenFavoriet($recept_id, $user_id) {
        $sql = "INSERT INTO gerecht_info (recept_id, user_id, record_type) VALUES ($recept_id, $user_id, 'F')";
        $result = mysqli_query($this-> connectie, $sql);
    }
    

    public function verwijderenFavoriet($recept_id, $user_id, $record_type) {
        $sql = "DELETE FROM gerecht_info WHERE recept_id = $recept_id AND user_id = $user_id AND record_type = '$record_type'";
        $result = mysqli_query($this-> connectie, $sql);
    }
}