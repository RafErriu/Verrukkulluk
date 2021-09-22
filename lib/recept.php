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
            $waardering = $this ->ophalenWaardering($row['id']);
            $favoriet = $this ->ophalenFavoriet($row['id']);
            $opmerkingen =$this -> ophalenOpmerkingen($row['id']);
            
            $bereiding = $this ->ophalenBereiding($row['id']);
            $ingredientR = $this ->ophalenIngredientR($row['id']);
            $gemiddeldeW = $this -> gemiddeldeWaardering($row['id']);
            $prijs_totaal = $this -> berekenPrijs($row['id']);

            $calorie_totaal =$this -> berekenCalorie($row['id']);


            $recept = [
                "id" => $row['id'],
                "waardering" => $waardering,
                "favoriet" => $favoriet,
                "opmerkingen" => $opmerkingen,

                "bereiding" => $bereiding,
                'gemiddelde_waardering' => $gemiddeldeW,
                'ingredient' => $ingredientR,
                "Prijs_totaal" => $prijs_totaal,

                "Calorie_totaal" => $calorie_totaal,

            ];
            $totaal_recept[] = $recept;
        }
        return($totaal_recept);
     }

    private function ophalenWaardering($recept_id) {
        $waardering = $this->gerecht_info->ophalenInfoType($recept_id, 'W');
            return($waardering);
    }

    private function ophalenFavoriet($recept_id) {
        $favoriet = $this->gerecht_info->ophalenInfoType($recept_id, 'F');
            return($favoriet);
    }

    private function ophalenOpmerkingen($recept_id) {
        $opmerkingen = $this->gerecht_info->ophalenInfoType($recept_id, 'O');
            return($opmerkingen);
    }

    private function ophalenBereiding($recept_id) {
        $bereiding = $this->gerecht_info->ophalenInfoType($recept_id, 'B');
            return($bereiding);
    }

    private function ophalenIngredientR($recept_id) {
        $ingredientR = $this->ingredient->ophalenIngredient($recept_id);
             return($ingredientR);
    }

    private function gemiddeldeWaardering($recept_id) {
        $totaalWaardering = $this->ophalenWaardering($recept_id);
        $cijfers = array_column($totaalWaardering, 'cijfer');
        $som = array_sum($cijfers);

        if(count($cijfers) > 0) {
            $gemiddeldeW = $som/count($cijfers);
        } else {
            $gemiddeldeW = 0;
        }

        return($gemiddeldeW);
    }

    private function berekenPrijs($recept_id) {
        $ingredientR = $this ->ophalenIngredientR($recept_id);

        $prijs_totaal = 0;

        foreach($ingredientR as $ingredient) {
            $totaalVerpakkingen = ceil($ingredient['hoeveelheid'] / $ingredient['verpakking']);
            $prijsIngredient = $totaalVerpakkingen * $ingredient['prijs'];
            $prijs_totaal = $prijs_totaal + $prijsIngredient;               

        }
        return($prijs_totaal);
    }

    private function berekenCalorie($recept_id) {
        $ingredientR = $this ->ophalenIngredientR($recept_id);

        $calorie_totaal = 0;        

        foreach($ingredientR as $ingredient) {
            $totaalVerpakkingen = $ingredient['hoeveelheid'] / $ingredient['verpakking'];
            $calorieIngredient = $totaalVerpakkingen * $ingredient['calorie'];
            $calorie_totaal = $calorie_totaal + $calorieIngredient;
        }
        return($calorie_totaal);
    }
 }
?>