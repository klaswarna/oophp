<!doctype html>
<?php

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

session_name("klaa17");
session_start();




if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess(-1);
}

$game = $_SESSION["game"];


$guess = $_POST["guess"] ?? null;



if (isset($_POST["doReset"])) {
    $game->random();
}

$res = null;
if (isset($_POST["doGuess"])) {
    $res = $game->makeGuess($guess);
}

$res2 = null;
if (isset($_POST["doCheat"])) {
    $res2 = "Du valde att fuska. Talet i fråga är: " . $game->number();
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

<form method="POST">

Din nästa gissning:
<input type="number" name="guess" value="" autofocus="">

<input type="submit" name="doGuess" value="Gissa">

<input type="submit" name="doReset" value="Börja om spelet">

<input type="submit" name="doCheat" value="Fuska">



</form>





</body>



</html>
