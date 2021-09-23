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

            $row = $this->artikelOpLijst($ingredient['artikel_id'], $user_id);
            
            if($row) {
                $this->bijwerkenArtikel($ingredient, $user_id, $row);
                echo "Artikel is bijgewerkt";            
            } else {
                $this->toevoegenArtikel($ingredient, $user_id);
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


    private function bijwerkenArtikel($artikel_id, $user_id) {
        $sql = "SELECT * FROM boodschappen WHERE artikel_id = $artikel_id AND user_id = $user_id";
        $result = mysqli_query($this->connectie, $sql);
       
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $aantal = $row['aantal'];
        $aantal = $aantal + 1;

        $sql = "UPDATE boodschappen SET aantal = $aantal WHERE artikel_id = $artikel_id AND user_id = $user_id";
        $result = mysqli_query($this->connectie, $sql);

    }
    private function toevoegenArtikel($artikel_id, $user_id) {
        
        $aantal = +1;

        $sql = "INSERT INTO boodschappen(artikel_id, user_id, aantal) VALUES ($artikel_id, $user_id, $aantal)";
        $result = mysqli_query($this->connectie, $sql);

    }
    
    

    

    

}