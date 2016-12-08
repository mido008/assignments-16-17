<?php

class User extends TaskNotes{
  protected $object_name = "usr_account";
  protected $user_id;
  var $user_name;
  var $first_name;
  var $second_name;
  var $date_of_birth;
  var $salutation;
  var $tel_nr;
  var $email;
  var $address;
  private $user_pswd;
  private $notes;

  function __construct($user_name)
  {
    parent::__construct($this->object_name);
    $this->user_name = $user_name;

    //$this = (object) $res;

    //$this->createNew(true);
/*
    $this->userId = $person['userId'];
    $this->userName = $person['userName'];
    $this->name = $person['name'];
    $this->dateOfBirth = $person['dateOfBirth'];
    $this->sex = $person['sex'];
    $this->telNr = $person['telNr'];
    $this->email = $person['email'];
    $this->address = $person['address'];
    $this->notes = $person['notes'];
*/
  }

  function createNew($params)
  {
    foreach ($params as $key=> $val){
      $this->$key = $val;
    }
    if($this->insertNewUser() == true) {
      if($this->insertLogin() == true) {
        return true;
      }
    }
      return false;
  }

  function initUser()
  {
    $user_query = "SELECT * FROM usr_account WHERE user_name = ? LIMIT 1;";
    $res = parent::select($user_query,array('s',&$this->user_name));
    foreach ($res as $key=> $val){
      $this->$key = $val;
    }
  }

  function login($login_psw)
  {
    $login_query = "SELECT user_name FROM usr_login WHERE user_name = ? AND (user_pswd = ? OR user_pswd_altern = ?) LIMIT 1;";
    $res = parent::select($login_query,array('sss',&$this->user_name, &$login_psw, &$login_psw));

    if(count($res) > 0 ){
      return $res;
    } else {
      return false;
    }
  }

  function insertNewUser()
  {
    $add_query = "INSERT INTO usr_account (user_name, first_name, second_name, salutation, date_of_birth, email, tel_nr, address)"
                  ." VALUES (?, ?, ? , ?, ?, ?, ?, ?)";

    $refs = array(
      'ssssssss',
      &$this->user_name,
      &$this->first_name,
      &$this->second_name,
      &$this->salutation,
      &$this->date_of_birth,
      &$this->email,
      &$this->tel_nr,
      &$this->address
    );

    if(parent::save($add_query, $refs) == true) {
      return true;
    } else {
      return false;
    }
  }

  function insertLogin()
  {
    $add_query = "INSERT INTO usr_login (user_name, user_pswd)"
                  ." VALUES (?, ?)";

    if(parent::save($add_query, array('ss', &$this->user_name, &$this->user_pswd)) == true) {
      return true;
    } else {
      return false;
    }
  }

  function __getId()
  {
      return $this->userId;
  }

  function getNotes()
  {
    return $this->notes;
  }


}

?>
