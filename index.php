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

$gerecht = new gerecht($db);

$data = $gerecht->selecteerGerecht();

$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";

switch($action) {

    case "homepage": {
        $data = $gerecht->selecteerGerecht();
        $template = 'homepage.html.twig';
        $title = "homepage";
        break;
    }

    case "detail": {
        $data = $recept->ophalenGerecht($gerecht_id);
        $template = 'detail.html.twig';
        $title = "detail pagina";
        break;
    }
}

$template = $twig->load($template);

echo $template->render(["title" => $title, "data" => $data]);



?>