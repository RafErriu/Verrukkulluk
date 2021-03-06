<?php


class gerecht_info {

    private $connectie;
    private $user;
    private $cijfer;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
        $this->user = new user($db);
    }

    private function ophalenUser_Gerecht($user_id) {
        $userInfo = $this->user->ophalenUser($user_id);
        return($userInfo);
    }

    private function ophalenCijfer($cijfer) {
        $cijfer = [];
        return($cijfer);
    }

    public function ophalenInfoType($recept_id, $record_type) {

        $gerecht_info = [];
        $sql = "SELECT * FROM gerecht_info WHERE recept_id = $recept_id AND record_type = '$record_type'";
        $result = mysqli_query($this-> connectie, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){      
            if($record_type == 'O' || $record_type == 'F'){
               $user = $this->ophalenUser_Gerecht($row['user_id']);
               $gerecht_info[] = [
                   "id" => $row["id"],
                    
                   "user_id"=>$row["user_id"],
                   "gebruikersnaam"=>$user["gebruikersnaam"],
                   "email"=>$user["email"],
                   "afbeelding"=>$user["afbeelding"],
               
                   "recept_id"=>$row["recept_id"],
                   "record_type"=>$row["record_type"],
                   "cijfer"=>$row["cijfer"],
                   "opmerking"=>$row["opmerking"]
           ];
            } else {
            $gerecht_info[] = [
              
                "id" => $row ["id"],
                "user_id"=>$row["user_id"],
                "recept_id"=>$row["recept_id"],
                "record_type"=>$row["record_type"],
                "cijfer"=>$row["cijfer"],
                "opmerking"=>$row["opmerking"],           
                "bereiding"=>$row["bereiding"],
                "stap"=>$row["stap"],
            ];
            } 
        }
        return($gerecht_info);
    }

    public function toevoegenFavoriet($recept_id, $user_id, $record_type) {
        $this->verwijderenFavoriet($recept_id, $user_id, $record_type);
        $sql = "INSERT INTO gerecht_info (recept_id, user_id, record_type) VALUES ($recept_id, $user_id, 'F')";
        $result = mysqli_query($this-> connectie, $sql);
    }
    

    public function verwijderenFavoriet($recept_id, $user_id, $record_type) {
        $sql = "DELETE FROM gerecht_info WHERE recept_id = $recept_id AND user_id = $user_id AND record_type = '$record_type'";
        $result = mysqli_query($this-> connectie, $sql);
    }

    public function toevoegenWaardering($recept_id, $cijfer, $record_type) {
        $this->verwijderenWaardering($recept_id, $cijfer, $record_type);
        $sql = "INSERT INTO gerecht_info (recept_id, cijfer, record_type) VALUES ($recept_id, $cijfer, 'W')";
        $result = mysqli_query($this-> connectie, $sql);
    }

    public function verwijderenWaardering($recept_id, $cijfer, $record_type) {
        $sql = "DELETE FROM gerecht_info WHERE recept_id = $recept_id AND cijfer = $cijfer AND record_type = '$record_type'";
        $result = mysqli_query($this-> connectie, $sql);
    }


    }


