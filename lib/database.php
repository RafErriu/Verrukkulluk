<?php

class database {

    private $connectie;
    private $naam;

    /// De Getter
    public function getConnectie() {
        return($this->connectie);
    }

    public function __construct() {

        $this->connectie = mysqli_connect('127.0.0.1', 'root', 'root', 'verrukkulluk');
    }
}
