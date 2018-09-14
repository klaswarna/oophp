<?php

namespace  Anax\View;

/**
* Template file to render a view
*/


?>


<!doctype html>

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
