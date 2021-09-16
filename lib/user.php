<?php 

class user {

    private $connectie;

    public function __construct($db) {
        $this->connectie = $db->getConnectie();
    }

    public function ophalenUser($user_id) {
        $sql = "SELECT * FROM user WHERE id =$user_id";
        $result = mysqli_query($this->connectie, $sql);

        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return($user);
    }
}