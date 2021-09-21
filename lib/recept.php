<?php

class recept {

    private $connectie;
    private $waardering;
    private $favoriet;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
        $this->gerecht_info = new gerecht_info($db);
    }

    private function ophalenWaardering($recept_id) {
        $waardering = $this->gerecht_info->ophalenInfoType($recept_id, 'W');
            return($waardering);
    }

    private function ophalenFavoriet($recept_id) {
        $favoriet = $this->gerecht_info->ophalenInfoType($recept_id, 'F');
            return($favoriet);
    }

    private function gemiddeldeWaardering($recept_id) {
        $totaalWaardering = $this->gerecht_info->ophalenWaardering($recept_id);
    }

    public function ophalenRecept($recept_id = null) {
        
        $recept = [];
        $sql = "SELECT * FROM recept";
        $result = mysqli_query($this->connectie, $sql);

        if(isset($recept_id)) {
            $sql = " WHERE id = $recept_id";          
        }  
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $id = $row["id"];
            $waardering = $this ->ophalenWaardering($recept_id);
            $favoriet = $this ->ophalenFavoriet($recept_id);

            $recept[] = [
                "id" => $row['id'],
                "waardering" => $waardering,
                "favoriet" => $favoriet,
            ];
        }
        return($recept);
     }

    
 }
?>