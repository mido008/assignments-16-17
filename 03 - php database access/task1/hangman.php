<?php
  include_once('prepareWords.php');
// TODO: start the session.
session_start();
$changeLanguage = false;
$maximumAttempts = 12; // the number of hangman images that we have...

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hangman</title>
    <meta name="author" content="Tobias Seitz">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="hangman.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript">
    function setLanguage(lang)
    {
      $.ajax({
        type: "POST",
        data:{'lang':lang},
        url: "hangman.php",
      })
      .done(function(res){
        location.reload();
      })
      .fail(function() {alert( "error" );}
      );
    }

    $(document).ready(function(){
      $('#l_de').click(function(){
        setLanguage('de');
      });

      $('#l_en').click(function(){
        setLanguage('en');
      });

      $('#l_fr').click(function(){
        setLanguage('fr');
      });

      $('#l_es').click(function(){
        setLanguage('es');
      });

    });
    </script>
</head>
<body>
<?php

  if (isset($_POST['lang']) && $_POST['lang'] != $_SESSION['lang']) {
    $_SESSION['lang'] = $_POST['lang'];
    $changeLanguage = true;
    //$_POST = array();
    include('body.php');
    //  header("Location: hangman.php");
  }
  if ($_SESSION['lang'] =='') {
    $changeLanguage = true;
    $_SESSION['lang'] = 'de';
    include('body.php');
  }
  else
  {
    $changeLanguage = false;
    include('body.php');
  }
// WorNet Ag

?>
</body>
</html>
