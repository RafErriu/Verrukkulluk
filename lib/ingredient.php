<?php

class ingredient{

    private $connectie;
    private $artikel;

    public function __construct($db) {
    $this->connectie = $db->getConnectie();
    }

    private function ophalenArtikel($artikel_id) {
        return($artikel_id);
    }

    public function ophalenIngredient($recept_id) {

        $ingredient = [];
        $sql = "SELECT * FROM ingredient WHERE recept_id = $recept_id";
        $result = mysqli_query($this->connectie, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $artikel = $this->ophalenArtikel($row['artikel_id']);
            $ingredient[] = $row;
            var_dump($artikel);


        }
        return($ingredient);

    }
}
