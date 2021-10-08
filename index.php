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
$user = new User($db);
$artikel = new artikel($db);
//$gerecht = new gerecht($db);
//$data = $ingredient->ophalenIngredient(24);
//var_dump($data);

$recept_id = isset($_GET['recept_id']) ? $_GET["recept_id"]: "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";
$user_id = isset($_GET['user_id']) ? $_GET['user_id']: "6";
$artikel_id = isset($_GET['artikel_id']) ? $_GET['artikel_id']: "";

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

    case "boodschappen": {
        $data = $boodschappen->ophalenBoodschappen($user_id);
        $template = 'boodschappen.html.twig';
        $title = "boodschappen";
        break;
    }

    case "boodschappenToevoegen": {

        $data = $boodschappen->ophalenBoodschappen($user_id);
        $boodschappen ->boodschappenToevoegen($recept_id, $user_id);
        $template = 'boodschappen.html.twig';
        $title = "boodschappenToevoegen";
        break;
    }
    
    case "verwijderenArtikel": {

        $data = $boodschappen->ophalenBoodschappen($user_id);
        $boodschappen ->verwijderenArtikel($user_id, $artikel_id);
        $template = 'boodschappen.html.twig';
        $title = "verwijderenArtikel";
        break;
    }

    case "verwijderenLijst": {
        $data = $boodschappen->ophalenBoodschappen($user_id);
        $boodschappen ->verwijderenLijst($user_id);
        $template = 'boodschappen.html.twig';
        $title = "verwijderenLijst";
        break;
    }

}

$template = $twig->load($template);

echo $template->render(["title" => $title, "data" => $data]);

?>