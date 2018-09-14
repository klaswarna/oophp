<!doctype html>
<?php

include(__DIR__ . "/config.php");
//include(__DIR__ . "/src/Guess.php");
include(__DIR__ . "/autoload.php");

$number = $_GET["number"] ?? -1;
$tries = $_GET["tries"] ?? 6;
$guess = $_GET["guess"] ?? null;


//initiera en instans av objektet Guess
$game = new Guess(intval($number), intval($tries));

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
    $res2 = "Du valde att funska. Talet i fråga är :" . $game->number();
}




?>

<html>

<head>
    <meta charset="utf-8">
    <title>GET | Guess the Number</title>
</head>

<body>

<p> <?=$res2?> </p>

<p>Du har <?=$game->tries ?> gissningar kvar.</p>

<p><?=$res?></p>

<form method="GET">

Din nästa gissning:
<input type="number" name="guess" value="" autofocus="">

<input type="submit" name="doGuess" value="Gissa">

<input type="hidden" name="number" value="<?=$game->number() ?>">

<input type="hidden" name="tries" value="<?=$game->tries() ?>">

<input type="submit" name="doReset" value="Börja om spelet">

<input type="submit" name="doCheat" value="Fuska">



</form>





</body>



</html>
