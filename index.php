<?php

require_once('lib/database.php');

require_once('lib/artikel.php');

require_once('lib/user.php');

require_once('lib/keukenType.php');

require_once('lib/gerechtinfo.php');

require_once('lib/ingredient.php');

require_once('lib/recept.php');

$db = new database();

$artikel = new artikel($db);

$gerecht_info = new gerecht_info($db);

$ingredient = new ingredient($db);

$recept = new recept($db);

$data = $recept->ophalenRecept(20);

echo "<pre>";
var_dump($data); 

?>