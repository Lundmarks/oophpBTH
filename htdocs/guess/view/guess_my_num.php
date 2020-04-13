<h1>Welcome to the guessing game!</h1><hr><br>

<p>You get 6 guesses in total. Good luck!</p>

<?php if ($result != "You do not have any guesses left!") : ?>
<form method="POST">
    <?php if ($curTriesLeft != -1 && !($curGuess == $curNumber)) : ?>
    <input type="text" autocomplete="off" name="curGuess">
    <?php endif; ?>
    <?php if ($curTriesLeft == -1 || $curGuess == $curNumber) : ?>
    <input type="text" autocomplete="off" name="curGuess" disabled>
    <?php endif; ?>
    <input type="hidden" name="curNumber" value="<?= $curNumber ?>">
    <input type="hidden" name="curTriesLeft" value="<?= $curTriesLeft ?>">
    <?php if ($curTriesLeft != -1 && !($curGuess == $curNumber)) : ?>
    <input type="submit" name="doGuess" value="Make a guess">
    <?php endif; ?>
    <?php if ($curTriesLeft == -1 || $curGuess == $curNumber) : ?>
    <input type="submit" name="doGuess" value="Make a guess" disabled>
    <?php endif; ?>
    <input type="submit" name="triggerRestart" value="Restart">
</form>
<?php endif; ?>

<br>

<?php if ($doGuess) : ?>
    <hr>
    <p>You guessed for the number <?= $curGuess ?>.</p>
<?php endif; ?>

<?php if ($doGuess) : ?>
    <p><hr> <?= $result ?></p>
<?php endif; ?>

<hr>
