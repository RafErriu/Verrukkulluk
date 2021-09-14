<?php

require_once('lib/database.php');

require_once('lib/artikel.php');

require_once('lib/user.php');

$db = new database();

$artikel = new artikel($db);

$user = new user($db);

$data = $user->ophalenUser(5);

echo "<pre>";
var_dump($data['gebruikersnaam']); 

?>