<?php
class WordsToGuess {
  private $wordList = array();

  function __construct($language)
  {
    switch ($language) {
      case "de":
        $fileName = "./Words/Words/de.txt";
        break;
      case "en":
        $fileName = "./Words/Words/en.txt";
        break;
      case "es":
        $fileName = "./Words/Words/es.txt";
        break;
      case "fr":
        $fileName = "./Words/Words/fr.txt";
        break;
    }
    $this->getRandomWordsList($fileName);
  }

  function getWords()
  {
      return $this->wordList;
  }

  function getSecretWord()
  {
      return count($this->wordList) > 0 ? $this->wordList[rand(0, count($this->wordList)-1)]: '';
  }

  function getRandomWordsList($fileName)
  {
    $countLines = $this->getCountFileLines($fileName);
    $file = fopen($fileName, "r");
    while (($line = fscanf($file, "%s\n")) && count($this->wordList) < 1000) {
      if (strlen((string)$line[0]) > 8 && strlen((string)$line[0]) < 100 ) {
        array_push($this->wordList, $line[0]);
        $this->wordList = array_unique($this->wordList);
        fseek($file, rand(0, $countLines-2));
      }
    }
    fclose($file);
  }

  function getCountFileLines($fileName)
  {
      $file = fopen($fileName, "r");
      $countLines = 0;
      while ($line = fscanf($file, "%s\n")) {
          $countLines++;
      }
      fclose($file);
      return $countLines;
  }

}
 ?>
