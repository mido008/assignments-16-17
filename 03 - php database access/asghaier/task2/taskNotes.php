<?php

class TaskNotes extends DbConnection{
  private static $CONN;
  protected $object_name;

  function __construct($object)
  {
    parent::__construct();
    if(gettype($object) === 'object') {
      $self->CON = $object;
    } else {
      $this->objectName = $object;
    }

  }
/*
  function save()
  {
    switch($this->object_name){
      case 'person':
        if($this->user_id == '') {
          parent::insert();
        } else {
          $this->update();
        }
        break;
      case 'note':
        if($this->note_id == '') {
          $this->insert();
        } else {
          $this->update();
        }
        break;
    }
  }
*/

}
?>
