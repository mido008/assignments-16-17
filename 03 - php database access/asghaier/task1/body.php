<?php
if($changeLanguage == true || $_SESSION['wordSecret'] == '') {
  $words = new WordsToGuess($_SESSION['lang']);
  $_SESSION['wordSecret'] = $words->getSecretWord();
}

$secretWord = $_SESSION['wordSecret'];
$wordLength = strlen($secretWord);
?>
<div id="container">
    <h2>Hangman - the game.</h2>
    <h1>
      <?php
        $langueMsg = 'Language : ';
        switch($_SESSION['lang']) {
          case 'de' :
            $langueMsg .=" Deutsch";
            break;
          case 'en' :
            $langueMsg .=" English";
            break;
          case 'es' :
            $langueMsg .=" Espagnol";
            break;
          case 'fr' :
            $langueMsg .=" Frensh";
            break;
        }
        echo $langueMsg;
      //  echo "<br>".$secretWord;
      ?>
    </h1>
    <section id="output">
      <div id ="languages">
        <ul>
          <li id="l_de" style="background-position: 82px 0px;"></li>
          <li id="l_en" style="background-position: -40px 0px;"></li>
          <li id="l_es" style="background-position: 82px 40px;"></li>
          <li id="l_fr" style="background-position: -78px 0px;"></li>
        </ul>
      </div>
        <?php

        /**
         * Use this function to lazily instantiate a session-variable if it's not there yet.
         *
         * @param $key {string} session-variable key, preferably a string
         * @param $value {*} the value to initialize the variable with, e.g. array(), 1, ''
         */
        function lazyInitSessionVariable($key, $value)
        {
            if (!isset($_SESSION[$key])) {
                $_SESSION[$key] = $value;
            }
        }

        // reset the guesses.
        if (isset($_POST['reset'])) {
            // TODO: reset the session
            $_SESSION['misses'] = array();
            $_SESSION['hits'] = array();
          //  session_unset();
        }

        // actually initialize the session variables
        // valid and invalid attempts.
        lazyInitSessionVariable('hits', array()); // creates $_SESSION['hits']
        lazyInitSessionVariable('misses', array()); // creates $_SESSION['misses']

        // handle a valid guess.
        if (isset($_POST['guess']) && isset($_POST['letter'])) { // TODO 1) make sure that 'guess' was submitted, as well as 'letter'
            $letter = $_POST['letter']; // TODO read the letter from the POST data.

            // determine if we should move the progress forward.
            if (stristr($secretWord, $letter)) { // true means: secretWord contains the letter.
                // save the letter in the 'hits' list;
                // TODO write the letter into the 'hits' list
                array_push($_SESSION['hits'], $letter);
            } else {
                // save the letter in the 'misses' list;
                // TODO write the letter into the 'misses' list
                array_push($_SESSION['misses'], $letter);
            }
        }

        // start the game progress at 1 (not 0).
        // but since the first miss should already advance the progress, we need to add +1;
        $progress = count($_SESSION['misses']) ? count($_SESSION['misses']) + 1 : 1;

        // if you want to make the game harder, you can start it at a later stage
        // by adding a handicap to the progress.
        $handicap = 0;
        $progress += $handicap;

        $imageFile = 'hangman';
        // determine which of the 12 hangman files we pick.
        // if the progress is below 10, we need to prefix a '0' to the number.
        $countMisses = count($_SESSION['misses']);
        $imageFile .= $countMisses < 10 ? '0'.$countMisses : $countMisses; // TODO
        $imageFile .= ".png";
        // show the image:
        echo "<img src='$imageFile' alt='Hangman - Step $progress' class='hangman'/>";

        // reveal the letters inside the 'result' div.
        echo '<div class="result">';
        // if the progress is smaller than a predefined number of attempts ==> we can play on.
        //echo $secretWord;
        if ($progress < $maximumAttempts) {

            // we go through each letter of the secret word and see if it's a hit or a miss.
            for ($i = 0; $i < $wordLength; $i++) {
                // make sure we use the uppercase version of the letters.
                $charAtI = $secretWord[$i]; // TODO determine the char at index $i in the $secretWord.

                // case 1: the letter of the word is in the guess array --> reveal the letter
                if (in_array(strtolower($charAtI), $_SESSION['hits']) != false) { // TODO insert the actual condition.
                    echo $charAtI;
                } // case 2: the letter was not guessed yet --> show an underscore
                else {
                    // print an underscore for each character in the word.
                    echo '_' . ($i != $wordLength - 1 ? ' ' : '');
                }
            }

            // now, to be a little more usable, show which letters were already guessed;
            // TODO: Optionally inform the user which letters were wrong, using $_SESSION['misses']
            $wrongMessg = "<br/><div style='width: 100%; position: relative; color: red;'> Wrong letters : ";
            foreach(array_unique($_SESSION['misses']) as $miss) {
                $wrongMessg .= $miss.", ";
            }
            $wrongMessg .= "<div>";
            echo $wrongMessg;

        } else { // oh no, the user lost!
            echo "<div class=\"youlose\"><h3>Oh No!</h3><p>You lost. The solution was \"$secretWord\". </p></div>";
            // TODO: reset the session.
            $_SESSION = array();
            session_unset();
        }

        echo '</div>'; # .result
        ?>
    </section>
    <section id="formContainer">
        <form method="post" action="hangman.php">
            <input type="text" maxlength="1" minlength="1" name="letter"/>
            <button type="submit" name="guess">Guess</button>
            <button type="submit" name="reset">Reset</button>
        </form>
    </section>
</div>
