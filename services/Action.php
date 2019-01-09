<?php
class Action extends Admin {		
	var $obj_user;	
	public function dashboard($id) {
		$query = "SELECT * from users WHERE user_id=".$id;		
		$recordset = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
		while ($row_recordset = mysqli_fetch_object($recordset)) { $this->obj_user = $row_recordset; }
		return $this->obj_user;
	}	
	public function get_connect($_username, $_pwd){
		//$query = "SELECT * FROM users WHERE user_login='".$_username."' AND user_password=PASSWORD('".$_pwd."')";
		$query = "SELECT * FROM users WHERE user_login='".$_username."' AND user_password='".$_pwd."'";
		$recordset = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
		while ($row_recordset = mysqli_fetch_object($recordset)) {
			$this->obj_user = $row_recordset;
		}
		return $this->obj_user;
	}	
}
?>