<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */

namespace Olle\Guess;

include "GuessException.php";

class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number;
    private $tries;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        if ($number == -1) {
            $this->random();
        } else {
            $this->number = $number;
        }
        $this->tries = $tries;
    }



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    public function random()
    {
        $this->setNumber(rand(1, 100));
    }



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries()
    {
        return $this->tries;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number()
    {
        return $this->number;
    }

    /**
     * Set the secret number.
     *
     * @param int $number The number to set.
     *
     * @return void
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($number)
    {
        $returnString = "Fatal error in makeGuess, Guess.php";
        if ($this->tries() == -1) {
            throw new GuessException(
                "<br>You are out of guesses! " .
                "You may restart the game by pressing the 'Restart' button."
            );
        } elseif ($number < 1 || $number > 100 || !(is_int($number))) {
            throw new GuessException(
                "<br>You must guess on a number between (or including) 1 and 100."
            );
        } elseif ($number == $this->number && $this->tries() >= 1) {
            $returnString = "<br>You guessed right!";
            return $returnString;
        } elseif ($this->tries() <= 0) {
            $returnString = "<br>You do not have any guesses left!";
            return $returnString;
        } else {
            // Wrong guess
            if ($this->tries() >= 2) {
                //More than one guess left
                $this->tries -= 1;
                $returnString = "<br>Sorry, that was not the number i am thinking of. Try again!";
                return $returnString;
            }
            // } elseif (intval($this->tries()) <= 1) {
            //Last guess
            $this->tries = -1;
            $returnString = "<br>Sorry, that was not the number i am thinking of. " .
            "That also was your last guess, which means you lost!";
            return $returnString;
            // }
        }
    }
}
