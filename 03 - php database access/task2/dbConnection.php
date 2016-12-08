<?php
include_once("dbConnectionInfo.php");
class DbConnection {
  private $connection;

  /**
   * @param $host String host to connect to.
   * @param $user String username to use with the connection.
   * @param $psw String password belonging to the username.
   * @param $db String name of the database.
   */
  function __construct()
  {
    // create new database connection
    $this->connection = new mysqli(HOST, USER, PSW, DB_NAME);
  }

  function login($login_user, $login_psw)
  {
    $login_query = "SELECT user_name FROM usr_login WHERE user_name = ? AND (user_pswd = ? OR user_pswd_altern = ?) LIMIT 1;";
    $statement = $this->connection->prepare($login_query);
    $statement->bind_param("sss", $login_user, $login_psw, $login_psw);
    $statement->execute();
    $statement->bind_result($result);

    if($statement->fetch()){
      $statement->close();
      return $result;
    } else {
      $statement->close();
      return false;
    }
  }

  function get_user($user_name)
  {
    echo $user_name;
    $user_query = "SELECT * FROM usr_account WHERE user_name = ? LIMIT 1;";
    $statement1 = $this->connection->prepare($user_query);
    $statement1->bind_param("s", $user_name);
    $statement1->execute();
    $statement1->bind_result($user_id, $user_name, $first_name, $second_name, $date_of_birth, $sex, $email, $tel_nr, $address);
    if($statement1->fetch()) {
      $statement1->close();
      return array(
        'user_id' => $user_id,
        'user_name' => $user_name,
        'first_name' => $first_name,
        'second_name' => $second_name,
        'date_of_birth' => $date_of_birth,
        'sex' => $sex,
        'email' => $email,
        'tel_nr' => $tel_nr,
        'address' => $address,
      );
    } else {
      $statement1->close();
      return false;
    }
  }

  function select($request, $params)
  {
    print_r('<pre>');
    $stmt = $this->connection->prepare($request);
    call_user_func_array(array($stmt,'bind_param'), $params);
    $stmt->execute();
    $rows = $stmt->get_result();
    $results = array();
    while($assoc = $rows->fetch_assoc()){
      array_push($results, $assoc);
    }
    return $results;
  }

  function save($request, $params)
  {
    $stmt = $this->connection->prepare($request);
    call_user_func_array(array($stmt,'bind_param'), $params);
    $stmt->execute();
    return $stmt->affected_rows;
  }

  function update($request, $params)
  {
    $stmt = $this->connection->prepare($request);
    call_user_func_array(array($stmt,'bind_param'), $params);
    $stmt->execute();
    if ($stmt->errno) {
      $stmt->close();
      return false;
    }
    $stmt->close();
    return true;
  }

}



?>
