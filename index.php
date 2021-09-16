<?php

require_once('lib/database.php');

require_once('lib/artikel.php');

require_once('lib/user.php');

require_once('lib/keukenType.php');

require_once('lib/gerechtinfo.php');

$db = new database();

$artikel = new artikel($db);

$user = new user($db);

$keukenType = new keukenType($db);

$gerecht_info = new gerecht_info($db);

$data = $gerecht_info->ophalenInfoType(20, "B");

echo "<pre>";
var_dump($data); 

?>