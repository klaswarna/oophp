<?php


//namespace Anax\View;
/**
 * Guess Game specific routes.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Guess my number with GET
 */

$app->router->get("gissa/get", function () use ($app) {
    //include __DIR__ . "/../htdocs/guess/index_get-inside.php";

    //spellogiken
    $number = $_GET["number"] ?? -1;
    $tries = $_GET["tries"] ?? 6;
    $guess = $_GET["guess"] ?? null;



    //initiera en instans av objektet Guess
    $game = new \KW\Guess\Guess(intval($number), intval($tries));

    // Reset the game
    //med hjälp av huruvida sessionsvariabeln doReset skickades in via sin submitknapp
    if (isset($_GET["doReset"])) {
        $game->random();
    }

    $res = null;
    if (isset($_GET["doGuess"])) {
        $res = $game->makeGuess($guess);
    }

    $res2 = null;
    if (isset($_GET["doCheat"])) {
        $res2 = "Du valde att funska. Talet i fråga är: " . $game->number();
    }


    $data = [
        "title" => "Gissa Talet (GET-version)",
        "game" => $game,
        "res2" => $res2,
        "res" => $res,
        "guess" => $guess,
     ];


    $app->view->add("anax/v2/guess/get", $data); //template filen som laddas som en vy
    $app->page->render($data);
    return true; //Detta måste ABSOLUT vara med!!!!!!!!!!!!!!!!!!!!!
});


//post-versionen:

$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {
    $number = $_POST["number"] ?? -1;
    $tries = $_POST["tries"] ?? 6;
    $guess = $_POST["guess"] ?? null;



    //initiera en instans av objektet Guess
    $game = new \KW\Guess\Guess(intval($number), intval($tries));

    // Reset the game
    //med hjälp av huruvida sessionsvariabeln doReset skickades in via sin submitknapp
    if (isset($_POST["doReset"])) {
        $game->random();
    }

    $res = null;
    if (isset($_POST["doGuess"])) {
        $res = $game->makeGuess($guess);
    }

    $res2 = null;
    if (isset($_POST["doCheat"])) {
        $res2 = "Du valde att funska. Talet i fråga är: " . $game->number();
    }


    $data = [
        "title" => "Gissa Talet (POST-version)",
        "game" => $game,
        "res2" => $res2,
        "res" => $res,
        "guess" => $guess,
     ];


    $app->view->add("anax/v2/guess/post", $data); //template filen som laddas som en vy
    $app->page->render($data);
    return true; //Detta måste ABSOLUT vara med!!!!!!!!!!!!!!!!!!!!!
});


//sessionvarianten
$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {

//spellogiken


    if (!isset($_SESSION["game"])) {
        $_SESSION["game"] = new \KW\Guess\Guess(-1);
    }

    $game = $_SESSION["game"];
    $guess = $_POST["guess"] ?? null;



    // Reset the game
    //med hjälp av huruvida sessionsvariabeln doReset skickades in via sin submitknapp
    if (isset($_POST["doReset"])) {
        $game->random();
    }
    $res = null;
    if (isset($_POST["doGuess"])) {
        $res = $game->makeGuess($guess);
    }
    $res2 = null;
    if (isset($_POST["doCheat"])) {
        $res2 = "Du valde att funska. Talet i fråga är: " . $game->number();
    }
    $data = [
        "title" => "Gissa Talet (SESSION-version)",
        "game" => $game,
        "res2" => $res2,
        "res" => $res,
        "guess" => $guess,
     ];


    $app->view->add("anax/v2/guess/session", $data); //template filen som laddas som en vy
    $app->page->render($data);
    return true; //Detta måste ABSOLUT vara med!!!!!!!!!!!!!!!!!!!!!
});
