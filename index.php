<?php

require_once('lib/database.php');

require_once('lib/artikel.php');

require_once('lib/user.php');

$db = new database();

$artikel = new artikel($db);

$data = $artikel->ophalenArtikel(31);

echo "<pre>";
var_dump($data); 

?>