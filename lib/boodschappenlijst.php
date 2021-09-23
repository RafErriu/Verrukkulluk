<?php

class boodschappen {

    private $connectie;
    private $ingredient;
    private $artikel;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
        $this->ingredient = new ingredient($db);
        $this->artikel = new artikel($db);
    }

    public function ophalenBoodschappen($user_id) {

        $boodschappen = [];
        $sql = "SELECT * FROM boodschappen WHERE user_id = $user_id";
        $result = mysqli_query($this-> connectie, $sql);

        while($row =mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $boodschappen[] = $row;
        }
        return($boodschappen);
    }

    public function boodschappenToevoegen($recept_id, $user_id) {
        
        $ingredienten = $this->ingredient->ophalenIngredient($recept_id);        
        foreach($ingredienten as $ingredient) {

            $boodschap = $this->artikelOpLijst($ingredient['artikel_id'], $user_id);
            
            if($boodschap) {
                $this->bijwerkenArtikel($ingredient, $user_id, $boodschap);
                echo "Artikel is bijgewerkt";            
            } else {
                $this->toevoegenArtikel($ingredient, $user_id,);
                echo "Artikel is toegevoegd";
            }
        }
    }

    public function artikelOpLijst($artikel_id, $user_id) {
        $boodschappen = $this -> ophalenBoodschappen($user_id);

        foreach($boodschappen as $boodschap){
            if($boodschap['artikel_id'] == $artikel_id) {
                return($boodschap);
            }
        }
        return(FALSE);
    }


    private function bijwerkenArtikel($artikel, $user_id, $boodschap) {
     
        $boodschap_id = $boodschap["id"];
        $aantal = $boodschap['aantal'];
        $verpakking = $artikel["verpakking"];
        $hoeveelheid = $artikel["hoeveelheid"];

        $totaalVerpakkingen = ceil($hoeveelheid / $verpakking);

        $sql = "UPDATE boodschappen SET aantal = $totaalVerpakkingen WHERE id= $boodschap_id";
        $result = mysqli_query($this->connectie, $sql);

    }
    private function toevoegenArtikel($artikel, $user_id) {
        
        $verpakking = $artikel['verpakking'];
        $hoeveelheid = $artikel['hoeveelheid'];
        $artikel_id = $artikel['artikel_id'];

        $totaalVerpakkingen = ceil($hoeveelheid / $verpakking);

        $sql = "INSERT INTO boodschappen(artikel_id, user_id, aantal) VALUES ($artikel_id, $user_id, $totaalVerpakkingen)";
        $result = mysqli_query($this->connectie, $sql);

    }

    public function verwijderenArtikel($user_id) {
        $sql = "DELETE FROM boodschappen WHERE user_id = $user_id";
        $result = mysqli_query($this->connectie, $sql);

    }
    
    

    

    

}