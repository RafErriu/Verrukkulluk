<?php

class recept {

    private $connectie;
    private $gerecht_info;
    private $ingredient;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
        $this->gerecht_info = new gerecht_info($db);
        $this->ingredient = new ingredient($db);
    }

    public function ophalenRecept($recept_id = null) {
        $totaal_recept = [];
        $sql = "SELECT * FROM recept";
        $result = mysqli_query($this->connectie, $sql);

        if(isset($recept_id)) {
            $sql = " WHERE id = $recept_id";          
        }  
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $id = $row["id"];
            $waarderingen = $this ->ophalenWaarderingen($row['id']);
            $favorieten = $this ->ophalenFavorieten($row['id']);
            $opmerkingen =$this -> ophalenOpmerkingen($row['id']);
            
            $bereidingen = $this ->ophalenBereidingen($row['id']);
            $ingredienten = $this ->ophalenIngredienten($row['id']);
            $gemiddeldeW = $this -> gemiddeldeWaardering($row['id']);
            $prijs_totaal = $this -> berekenPrijs($row['id']);

            $calorie_totaal =$this -> berekenCalorie($row['id']);


            $recept = [
                "id" => $row['id'],
                "waarderingen" => $waarderingen,
                "favorieten" => $favorieten,
                "opmerkingen" => $opmerkingen,

                "bereidingen" => $bereidingen,
                'gemiddelde_waardering' => $gemiddeldeW,
                'ingredienten' => $ingredienten,
                "Prijs_totaal" => $prijs_totaal,

                "Calorie_totaal" => $calorie_totaal,

            ];
            $totaal_recept[] = $recept;
        }
        return($totaal_recept);
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

    private function ophalenBereidingen($recept_id) {
        $bereiding = $this->gerecht_info->ophalenInfoType($recept_id, 'B');
            return($bereiding);
    }

    private function ophalenIngredienten($recept_id) {
        $ingredienten = $this->ingredient->ophalenIngredienten($recept_id);
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
        return($prijs_totaal);
    }

    private function berekenCalorie($recept_id) {
        $ingredienten = $this ->ophalenIngredienten($recept_id);

        $calorie_totaal = 0;        

        foreach($ingredienten as $ingredient) {
            $totaalVerpakkingen = $ingredient['hoeveelheid'] / $ingredient['verpakking'];
            $calorieIngredient = $totaalVerpakkingen * $ingredient['calorie'];
            $calorie_totaal = $calorie_totaal + $calorieIngredient;
        }
        return($calorie_totaal);
    }
 }
?>