<?php

require_once('lib/database.php');

require_once('lib/artikel.php');

require_once('lib/user.php');

require_once('lib/keukenType.php');

$db = new database();

$artikel = new artikel($db);

$user = new user($db);

$keukenType = new keukenType($db);

$data = $keukenType->ophalenkeukenType(8);

echo "<pre>";
var_dump($data['omschrijving']); 

?>