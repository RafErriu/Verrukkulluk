<?php

require_once('lib/database.php');

require_once('lib/artikel.php');

require_once('lib/user.php');

require_once('lib/keukenType.php');

require_once('lib/gerechtinfo.php');

$db = new database();

$gerecht_info = new gerecht_info($db);

$data = $gerecht_info->verwijderenFavoriet();

echo "<pre>";
var_dump($data); 

?>