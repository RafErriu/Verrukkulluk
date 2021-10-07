<?php

class ingredient{

    private $connectie;
    private $artikel;

    public function __construct($db) {

    $this->connectie = $db->getConnectie();
    $this->artikel = new artikel($db);
    }

    private function ophalenArtikel_Ing($artikel_id) {
        $artikel_ingredient = $this->artikel->ophalenArtikel($artikel_id);

        return($artikel_ingredient);
    }

    public function ophalenIngredient($recept_id) {

        $ingredient = [];
        $sql = "SELECT * FROM ingredient WHERE recept_id = $recept_id";
        $result = mysqli_query($this->connectie, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
           
            $artikel = $this->ophalenArtikel_Ing($row['artikel_id']);
            $ingredient[] = [
                "id" => $row["id"],
                "artikel_id" => $artikel["id"],
                "recept_id" => $row["recept_id"],
                "verpakking"=>$artikel["verpakking"],
                "afbeelding"=>$artikel["afbeelding"],
                
                "naam"=>$artikel["naam"],
                "omschrijving"=>$artikel["omschrijving"],
                "materiaal"=>$artikel["materiaal"],
                "prijs" =>$artikel["prijs"],
                "calorie" =>$artikel["calorie"],
                "hoeveelheid" => $row["hoeveelheid"],
                "eenheid" => $row['eenheid']
            ];  


        }
        return($ingredient);

    }
}
