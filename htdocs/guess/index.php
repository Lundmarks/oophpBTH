<?php
/**
 * Index for the guessing game
 */
include(__DIR__ . "/src/config.php");
include(__DIR__ . "/src/autoload.php");
// include(__DIR__ . "/src/Guess.php");

// Fetching all variables
$curNumber = $_POST["curNumber"] ?? null;
$curGuess = $_POST["curGuess"] ?? null;
$curTriesLeft = $_POST["curTriesLeft"] ?? null;
$triggerRestart = $_POST["triggerRestart"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$result = null;
// $guessingGame = $_POST["guessingGame"] ?? null; //doesnt quite work

if ($triggerRestart || $curNumber === null || !(isset($_POST['curNumber']))) {
    // Start game
    $guessingGame = new Guess();
    // $_POST["guessingGame"] = $guessingGame;
    $curNumber = $guessingGame->number();
    $curTriesLeft = $guessingGame->tries();
} elseif ($doGuess && $curTriesLeft != 0) {
    // Do a guess
    $guessingGame = new Guess($curNumber, $curTriesLeft);
    // Set res var for printing game response
    try {
        $result = $guessingGame->makeGuess(intval($curGuess));
    } catch (GuessException $e) {
        //Text is decided when throwing
        $result = $e->getMessage();
    }
    $curTriesLeft = $guessingGame->tries();
}

//Rendering page
require __DIR__ . "/view/guess_my_num.php";
