<?php

class Admin extends Si {		
	var $param_url = "";
	var $username = "";
	var $password = "";
	var $host = "";
	var $databasename = "";
	
	function __construct() {
		$this->param_url = $_SERVER["HTTP_HOST"];
        $this->set_connect();
    }
	public function set_connect(){
		if ($this->param_url == "localhost") {
			$this->username = "root";
			$this->password = "";
			$this->host = "localhost";
			$this->databasename = "lebonuser";
		}
		$this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->databasename);
	}	
	public function Dashboard($id) {
		$this->set_connect();
		$connect = new Action();
		$temp = $connect->dashboard($id);
		return $temp;
	}
	public function getConnect($_username, $_pwd) {		
		$connect = new Action();
		$temp = $connect->get_connect($_username, $_pwd);
		return $temp;
	}	
}
?>