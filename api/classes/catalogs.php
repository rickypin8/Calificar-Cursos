<?php
  require_once('instructores.php');
  require_once('curso.php');
  class Catalogs extends Connection
  {
    public static function get_instructores()
		{
			//open connection to MySql
			parent::open_connection();
			//initialize arrays
			$ids = array(); //array for ids
			$list = array(); //array for objects
			//query
			$query = "SELECT id_instructor FROM instructores";
			//prepare command
			$command = parent::$connection->prepare($query);
			//execute command
			$command->execute();
			//link results
			$command->bind_result($id);
			//fill ids array
			while ($command->fetch()) array_push($ids, $id);
			//close command
			mysqli_stmt_close($command);
			//close connection
			parent::close_connection();
			//fill object array
			for ($i=0; $i < count($ids); $i++) array_push($list, new Instructor($ids[$i]));
			//return array
			return $list;
		}
  }


?>
