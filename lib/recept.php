<?php

class recept {

    private $connectie;
    private $gerecht_info;
    private $ingredienten;
    private $keukenType;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
        $this->gerecht_info = new gerecht_info($db);
        $this->ingredienten = new ingredient($db);
        $this->keukenType = new keukenType($db);
    }

    public function zoeken($keyword) {

        $recepten = $this ->ophalenRecept();
        $resultaat = [];

        foreach($recepten as $recept) {

            $text = json_encode($recept);
                        
            if(strpos($text, $keyword, 0)) {
                $resultaat[] = $recept;
            }
        }
    return($resultaat);
    }
    
    public function ophalenRecept($recept_id = null) {
        $totaal_recept = [];
        $sql = "SELECT * FROM recept";

        if(isset($recept_id)) {
            $sql .= " WHERE id = $recept_id";          
        }

        
        $result = mysqli_query($this->connectie, $sql);

        
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $id = $row["id"];
            $waarderingen = $this ->ophalenWaarderingen($row['id']);
            $favorieten = $this ->ophalenFavorieten($row['id']);
            $opmerkingen =$this -> ophalenOpmerkingen($row['id']);
            
            $bereidingen = $this ->ophalenBereidingen($row['id']);
            $ingredienten = $this ->ophalenIngredienten($row['id']);
            $gemiddeldeW = $this -> gemiddeldeWaardering($row['id']);
            $prijs_totaal = $this -> berekenPrijs($row['id']);

            $calorie_totaal = $this -> berekenCalorie($row['id']);
            $keuken = $this -> ophalenKeuken($row['keuken_id']);
            $type = $this ->ophalenType($row['type_id']);


            $recept = [
                "id" => $row['id'],

                'titel' => $row['titel'],
                'foto' => $row['foto'],
                'omschrijving' => $row['omschrijving'],
                'uitleg' => $row['uitleg'],
                'keuken' => $keuken,
                'type' => $type,

                "bereidingen" => $bereidingen,
                "opmerkingen" => $opmerkingen,
                "waarderingen" => $waarderingen,
                "favorieten" => $favorieten,

                'gemiddelde_waardering' => $gemiddeldeW,
                'ingredienten' => $ingredienten,
                "prijs_totaal" => $prijs_totaal,
                "calorie_totaal" => $calorie_totaal,

            ];
            $totaal_recept[] = $recept;
        }
        return($totaal_recept);
     }
    
    private function ophalenKeuken($keuken_id) {
         $keuken = $this->keukenType->ophalenKeukenType($keuken_id);
         return($keuken);
     }

    private function ophalenType($type_id) {
        $type = $this->keukenType -> ophalenKeukenType($type_id);
        return($type);
    }

    private function ophalenWaarderingen($recept_id) {
        $waarderingen = $this->gerecht_info->ophalenInfoType($recept_id, 'W');
            return($waarderingen);
    }

    private function ophalenFavorieten($recept_id) {
        $favorieten = $this->gerecht_info->ophalenInfoType($recept_id, 'F');
            return($favorieten);
    }

    private function ophalenOpmerkingen($recept_id) {
        $opmerkingen = $this->gerecht_info->ophalenInfoType($recept_id, 'O');
            return($opmerkingen);
    }

    public function ophalenBereidingen($recept_id) {
        $bereidingen = $this->gerecht_info->ophalenInfoType($recept_id, 'B');
            return($bereidingen);
    }

    private function ophalenIngredienten($recept_id) {
        $ingredienten = $this->ingredienten->ophalenIngredient($recept_id);
             return($ingredienten);
    }

    private function gemiddeldeWaardering($recept_id) {
        $totaalWaarderingen = $this->ophalenWaarderingen($recept_id);
        $cijfers = array_column($totaalWaarderingen, 'cijfer');
        $som = array_sum($cijfers);

        if(count($cijfers) > 0) {
            $gemiddeldeW = $som/count($cijfers);
        } else {
            $gemiddeldeW = 0;
        }

        return($gemiddeldeW);
    }

    private function berekenPrijs($recept_id) {
        $ingredienten = $this ->ophalenIngredienten($recept_id);

        $prijs_totaal = 0;

        foreach($ingredienten as $ingredient) {
            $totaalVerpakkingen = ceil($ingredient['hoeveelheid'] / $ingredient['verpakking']);
            $prijsIngredient = $totaalVerpakkingen * $ingredient['prijs'];
            $prijs_totaal = $prijs_totaal + $prijsIngredient;               

        }
        return(substr($prijs_totaal, 0, -2));
    }

    private function berekenCalorie($recept_id) {
        $ingredienten = $this ->ophalenIngredienten($recept_id);

        $calorie_totaal = 0;        

        foreach($ingredienten as $ingredient) {
            $totaalVerpakkingen = ceil($ingredient['hoeveelheid'] / $ingredient['verpakking']);
            $calorieIngredient = $totaalVerpakkingen * $ingredient['calorie'];
            $calorie_totaal = $calorie_totaal + $calorieIngredient;
        }
        return($calorie_totaal);
    }
 }
?>