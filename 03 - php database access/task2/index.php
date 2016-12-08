<?php
session_start();
include_once("dbConnection.php");
include_once("TaskNotes.php");
include_once("Note.php");
include_once("Person.php");

//$connection = new DbConnection();
//setcookie("db_connection", $connection);
?>
<html>
<head>
<meta charset="UTF-8">
<title>Notes</title>
<meta name="author" content="Ahmed Sghaier">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css"/>
<script src="https://use.fontawesome.com/b5ad55101b.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#logout').on('click', function(){
      $.domCache.remove();
      location.replace("index.php");
    });

    if($('#get_account').html() != null) {
      $('#logout').fadeIn();
      $('#home').fadeOut(); // Hide all content divs
      $('#account').fadeIn();
    }

    if($('#registred').html() != null) {
      $('.signIn').fadeOut(); // Hide all content divs
//A3-7BBK87-M7HFZB-GY33T-C32LF-YP22D-KMH6R
    }
  })
</script>
</head>
<body>
  <?php
  if(isset($_POST['log_out'])) {
    setcookie("user_name", "", time() - 3600);
    //opcache_reset();
    //header('Location: index.php');
  }
  ?>
  <div class="headerContent">
    <div id="title" >Notes</div>
    <?
      if(in_array("user_name",array_keys($_COOKIE))){
        echo $_COOKIE['user_name'];
      } else {
        echo '';
      }
    ?>
    <br>
    <form style="position: relative" name="logoutForm" action="index.php" method="POST">
      <button tyle="position: relative" name="log_out" id="logout"> Auslogen </button>
    </form>
  </div>
  <div class="content">
      <?php

      //if($connection == true) echo 'ääää<br>';
      $show_login_error = "none";
      if(isset($_POST['login_account'])) {
        if(isset($_POST['psw_login']) && isset($_POST['user_name_login'])) {
          $login_user = $_POST['user_name_login'];
          $login_psw = md5($_POST['psw_login']);

          if($login_user != '' && $login_psw != '') {
            $account = new USER($login_user);
            //$user_name = $connection->login($login_user, $login_psw);
//            $user_name = $connection->login($login_user, $login_psw);
            if( $account->login($login_psw) != false) {
              setcookie("user_name", $login_user);
                include("account.php");
                echo '<input type="hidden" id="get_account" value="'.$login_user.'">';

              //  header("Location: account.php");
            } else {
              $show_login_error = "inline";
            }
          }
        }
      }

      if(isset($_POST['new_account'])) {
          $user_name = $_POST['user_name'];
          $psw = md5($_POST['psw_login']);
        $new_account = array(
          'user_name' => $user_name,
          'login_psw' => $_POST['psw_login'],
          'first_name' => $_POST['first_name'],
          'second_name' => $_POST['second_name'],
          'date_of_birth' => $_POST['date_of_birth'],
          'salutation' => $_POST['salutation'],
          'tel_nr' => $_POST['user_tel'],
          'email' => $_POST['user_mail'],
          'address' => $_POST['user_address'],
          'user_pswd' => $psw,
        );

        $person = new User($user_name);
        if($person->createNew($new_account) == true) {
          echo '<input type="hidden" id="registred">';
        }

      }
?>

      <div id="home">
        <?php
          include("login.php");
          include("signIn.php");
        ?>
      </div>
    </div>
  </div>
</body>
</html>
