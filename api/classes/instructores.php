<?php
//use files
require_once('connection.php');
require_once('exceptions.php');
class Instructor extends Connection{
  //attributes
  private $id;
  private $name;
  private $img;
  private $id_curso;

  //meethods
  public function get_id(){return $this->id;}
  public function get_name(){return $this->name;}
  public function get_img(){return $this->img;}
  public function get_id_curso(){return $this->id_curso;}
  //constructor
  function __construct()
  {
    //if no arguments received, create empty object
    if(func_num_args() == 0)
    {
      $this->id = '';
      $this->name = '';
      $this->img = '';
      $this->id_curso = '';
    }
    //if one argument received create object with data
    if(func_num_args() ==1 )
    {
      //receive arguments into an array
      $args = func_get_args();
      //id
      $id = $args[0];
      //open connection to MySql
      parent::open_connection();
      //query
      $query = "SELECT `id_instructor`, `nombre_instructor`, `img_instructor`, `id_curso_instructor` FROM `instructores` WHERE id_instructor= ?";
      //prepare command
      $command = parent::$connection->prepare($query);
      //link parameters
      $command->bind_param('i', $id);
      //execute command
      $command->execute();
      //link results to class attributes
      $command->bind_result($this->id,$this->name,$this->img,$this->id_curso);
      //fetch data
      $found = $command->fetch();
      //close command
      mysqli_stmt_close($command);
      //close connection
      parent::close_connection();
      //if not found throw exception
      if(!$found) throw(new RecordNotFoundException());
    }
  }
}





?>
