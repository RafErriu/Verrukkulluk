<?php

class keukenType {

        private $connectie;

        public function __construct($db) {
            $this -> connectie = $db->getConnectie();
        }

        public function ophalenKeukenType($keukenType_id) {
            $sql = "SELECT * FROM keuken_type WHERE id =$keukenType_id";
            $result = mysqli_query($this->connectie, $sql);

            $keukenType = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return($keukenType);
        }
}