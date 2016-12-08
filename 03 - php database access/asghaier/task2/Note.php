<?php

class Note{
  protected  $object_name = "notes";
  private $note_id;
  var $note_title;
  var $note_content;
  var $note_design;
  var $creation_date;
  var $update_date;

  function __construct()
  {
    parent::__construct();
  }

  function __getId()
  {
    return $this->noteId;
  }
}
?>
