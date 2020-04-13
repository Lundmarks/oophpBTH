<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Starts the game
 */
$app->router->get("guess/init", function () use ($app) {
    //Starts the game, route: /init

    // Start game
    $guessingGame = new Olle\Guess\Guess();
    // $curNumber = $guessingGame->number();
    // $curTriesLeft = $guessingGame->tries();
    $_SESSION["curNumber"] = $guessingGame->number();
    $_SESSION["curTriesLeft"] = $guessingGame->tries();

    return $app->response->redirect("guess/play");
});



/**
 * Play the game, show game status
 */
$app->router->get("guess/play", function () use ($app) {
    //Play the game!
    $title = "Gissa mitt nummer";

    // Fetching all variables
    $curTriesLeft = $_SESSION["curTriesLeft"] ?? null;
    $curGuess = $_SESSION["curGuess"] ?? null;
    $result = $_SESSION["result"] ?? null;

    $_SESSION["curGuess"] = null;
    $_SESSION["result"] = null;

    $data = [
        "curGuess" => $curGuess ?? null,
        "doGuess" => $doGuess ?? null,
        "curNumber" => $curNumber ?? null,
        "curTriesLeft" => $curTriesLeft,
        "result" => $result,
    ];

    // $app->page->add("anax/v2/article/default", $data);
    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});





/**
 * Play the game, make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    //Play the game!
    $title = "Gissa mitt nummer";

    // Fetching all variables
    $curNumber = $_SESSION["curNumber"] ?? null;
    $curGuess = $_POST["curGuess"] ?? null;
    $curTriesLeft = $_SESSION["curTriesLeft"] ?? null;
    $triggerRestart = $_POST["triggerRestart"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;

    $guessingGame = new Olle\Guess\Guess($curNumber, $curTriesLeft);

    if ($doGuess && $curTriesLeft != 0) {
        // Do a guess
        $guessingGame = new Olle\Guess\Guess($curNumber, $curTriesLeft);
        // Set res var for printing game response
        try {
            $result = $guessingGame->makeGuess(intval($curGuess));
        } catch (Olle\Guess\GuessException $e) {
            //Text is decided when throwing
            $result = $e->getMessage();
        }
        $curTriesLeft = $guessingGame->tries();

        $_SESSION["curTriesLeft"] = $curTriesLeft;
        $_SESSION["result"] = $result;
        $_SESSION["curGuess"] = $curGuess;
    }

    return $app->response->redirect("guess/play");
});
