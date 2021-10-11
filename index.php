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
$user = new user($db);
$artikel = new artikel($db);
$keukenType = new keukenType($db);

//$gerecht = new gerecht($db);
// $data = $recept->ophalenKeuken(4);
// var_dump($data);


$record_type = isset($_GET["record_type"]) ? $_GET["record_type"]: "";
$recept_id = isset($_GET['recept_id']) ? $_GET["recept_id"]: "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";
$user_id = isset($_GET['user_id']) ? $_GET['user_id']: "6";
$artikel_id = isset($_GET['artikel_id']) ? $_GET['artikel_id']: "";
$cijfer = isset($_GET["cijfer"]) ? $_GET["cijfer"]: "";

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

        $boodschappen ->boodschappenToevoegen($recept_id, $user_id);
        $data = $boodschappen->ophalenBoodschappen($user_id);

        $title = "boodschappenToevoegen";
        $template = 'boodschappen.html.twig';
        break;
    }
    
    case "verwijderenArtikel": {

        $boodschappen ->verwijderenArtikel($user_id, $artikel_id);
        $data = $boodschappen->ophalenBoodschappen($user_id);

        $template = 'boodschappen.html.twig';
        $title = "verwijderenArtikel";
        break;
    }

    case "verwijderenLijst": {
        $boodschappen ->verwijderenLijst($user_id);
        $data = $boodschappen->ophalenBoodschappen($user_id);

        $template = 'boodschappen.html.twig';
        $title = "verwijderenLijst";
        break;
    }

    case "favorietToevoegen": {

        $gerecht_info ->toevoegenFavoriet($recept_id, $user_id, $record_type);
        $data = $recept->ophalenRecept($recept_id);

        $template = 'detailpagina.html.twig';
        $title = "favorietToevoegen";
        break;
    }

    case "favorietVerwijderen": {
        
        $gerecht_info -> verwijderenFavoriet($recept_id, $user_id, $record_type);
        $data = $recept->ophalenRecept($recept_id);
        

        $template = 'detailpagina.html.twig';
        $title = "favorietVerwijderen";
    }

    
    case "waardering": {

        $gerecht_info ->toevoegenWaardering($recept_id, $cijfer, $record_type);
        $data = $recept->ophalenRecept($recept_id);

        $template = 'detailpagina.html.twig';
        $title = "waardering";

    }

}

$template = $twig->load($template);

echo $template->render(["title" => $title, "data" => $data]);

?>