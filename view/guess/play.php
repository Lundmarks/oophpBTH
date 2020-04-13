<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if ($curTriesLeft >= 1) {
    $guessLeft = $curTriesLeft;
} else {
    $guessLeft = 0;
}

?><h1>Gissa Mitt Nummer</h1>

<p>Du får totalt 6 stycken gissningar. Lycka till! (<?= $guessLeft ?> gissningar kvar.)</p>

<?php if ($result != "You do not have any guesses left!") : ?>
<form method="POST">
    <?php if ($curTriesLeft != -1 && $curGuess != $_SESSION["curNumber"]) : ?>
    <input type="text" autocomplete="off" name="curGuess">
    <?php endif; ?>
    <?php if ($curTriesLeft == -1 || $curGuess == $_SESSION["curNumber"]) : ?>
    <input type="text" autocomplete="off" name="curGuess" disabled>
    <?php endif; ?>
    <input type="hidden" name="curNumber" value="<?= $curNumber ?>">
    <input type="hidden" name="curTriesLeft" value="<?= $curTriesLeft ?>">
    <?php if ($curTriesLeft != -1 && $curGuess != $_SESSION["curNumber"]) : ?>
    <input type="submit" name="doGuess" value="Make a guess">
    <?php endif; ?>
    <?php if ($curTriesLeft == -1 || $curGuess == $_SESSION["curNumber"]) : ?>
    <input type="submit" name="doGuess" value="Make a guess" disabled>
    <?php endif; ?>
    <!-- <input type="submit" name="triggerRestart" value="Restart"> -->
    <input type="button" onclick="location.href = '../guess-game';" value="Starta om">

</form>
<?php endif; ?>

<br>

<?php if ($result) : ?>
    <br>
    <p>You guessed for the number <?= $curGuess ?>.</p>
<?php endif; ?>

<?php if ($result) : ?>
    <p><br> <?= $result ?></p>
<?php endif; ?>
