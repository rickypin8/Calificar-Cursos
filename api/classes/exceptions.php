<?php
	class RecordNotFoundException extends Exception
	{
		//attributes
		protected $message = 'Record not found';
		
		//propiedades
		public function get_message() { return $this->message; }
	}
?>

