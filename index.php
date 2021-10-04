<?php

require_once('vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader("./templates");

$twig = new Twig\Environment($loader, ["debug" => true]);
$twig -> addExtension (new \Twig\Extension\DebugExtension());

require_once('lib/database.php');
require_once('lib/artikel.php');
require_once('lib/user.php');
require_once('lib/keukenType.php');
require_once('lib/gerechtinfo.php');
require_once('lib/ingredient.php');
require_once('lib/recept.php');
require_once('lib/boodschappenlijst.php');
require_once('lib/gerecht.php');

$db = new database();
$recept = new recept($db);
$boodschappen = new boodschappen($db);
$ingredient = new ingredient($db);
$gerecht_info = new gerecht_info($db);
//$gerecht = new gerecht($db);

$recept_id = isset($_GET['recept_id']) ? $_GET["recept_id"]: "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";

switch($action) {

    case "homepage": {
        $data = $recept->ophalenRecept();
        $template = 'homepage.html.twig';
        $title = "homepage";
        break;
    }

    case "detailpagina": {

    
        $data = $recept->ophalenRecept($recept_id);
        $template = 'detailpagina.html.twig';
        $title = "detailpagina";
        break;
    }

    case "boodschapen": {
        $data = $recept->ophalenRecept($recept_id);
        $template = 'boodschappen.html.twig';
        $title = 'boodschappen';
        break;
    }
}

$template = $twig->load($template);

echo $template->render(["title" => $title, "data" => $data]);

?>