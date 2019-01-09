<?php
include_once 'Adresse.php';
include_once 'Lead.php';
include_once 'Liste.php';
include_once 'Admin.php';
include_once 'Action.php';

class Si {		
	var $param_url = "";
	var $urx = "";
	var $username = "";
	var $password = "";
	var $host = "";
	var $databasename = "";
	var $connection = "";

	function __construct() {
		$this->param_url = $_SERVER["HTTP_HOST"];
		$this->urx = "http://localhost/lebonuser";
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
	public function utf8_granted($param){
		foreach ($param as $key => $val) { if(is_string($val)){ $param->$key = utf8_encode($val); } }
		return $param;
	}
	function dateDB($the_date) {
		if(strlen($the_date)>0){
			$tab_update = substr($the_date, 0, 10);
			$tab_update = explode('/', $tab_update);
			$last_update = $tab_update[2].'-'.$tab_update[1].'-'.$tab_update[0];
			if($last_update=="--") { $last_update="0000-00-00";}
			$last_update=str_replace("--","",$last_update);
		}else{
			$last_update="0000-00-00";
		}
		return $last_update;
	}
	function dateFR($the_date, $param){		
		$tab_update = substr($the_date, 0, 10);
		$tab_update = explode('-', $tab_update);
		$last_update = $tab_update[2].'/'.$tab_update[1].'/'.$tab_update[0];
		
		if($param!=2) {
			$fin = strlen($the_date);
			$heure = substr($the_date, 10, $fin);
			$heure = explode(':', $heure);
			$_heure = $heure[0].'h'.$heure[1];
		}
		
		switch($tab_update[1]){
			case "01":
				$mois="Janvier";
				break;
			case "02":
				$mois="Février";
				break;
			case "03":
				$mois="Mars";
				break;
			case "04":
				$mois="Avril";
				break;
			case "05":
				$mois="Mai";
				break;
			case "06":
				$mois="Juin";
				break;
			case "07":
				$mois="Juillet";
				break;
			case "08":
				$mois="Aout";
				break;
			case "09":
				$mois="Septembre";
				break;
			case "10":
				$mois="Octobre";
				break;
			case "11":
				$mois="Novembre";
				break;
			case "12":
				$mois="Décembre";
				break;
		}		
		if($param==1){
			$date_correct = $tab_update[2]." ".$mois." ".$tab_update[0]." à ".$_heure;
		}else if($param==2){
			$date_correct = $tab_update[2]."/".$tab_update[1]."/".substr($tab_update[0], 0, 4);
		}else{
			$date_correct = $tab_update[2]."/".$tab_update[1]."/".substr($tab_update[0], 2, 2).' '.$_heure;
		}		
		return $date_correct;
	}
	public function getListe($table, $column, $value) {
		$this->set_connect();
		$connect = new Liste();
		$temp = $connect->get_liste($table, $column, $value);
		return $temp;
	}
	public function addInsertion($oData, $source) {
		$tab_param = $oData->formData;
		$counter=0;
		$array_fields = array();
		$sql_fields="";
		$sql_values="";
		foreach ($tab_param as $key=>$value) {
			$array_fields[$counter] = array();
			$array_fields[$counter][0] = $key;
			$array_fields[$counter][1] = $value;
			$query = 'SELECT DATA_TYPE AS type FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME="'.$source.'" AND COLUMN_NAME="'.$key.'"';
			$recordset = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			while($results = mysqli_fetch_object($recordset)) {
				$array_fields[$counter][2]=$results->type;
				$sql_fields.=$key.", ";
				switch ($array_fields[$counter][2]) {
				    case "varchar":
				    	if($key=="uti_password"){
				    		$sql_values.='PASSWORD("'.mysqli_real_escape_string($this->connection, utf8_decode($value)).'"), ';
				    	}else{ $sql_values.='"'.mysqli_real_escape_string($this->connection, utf8_decode($value)).'", '; }
				        break;
				    case "int":
				    	$sql_values.=($value=="")?"0, ":intval($value).", ";
				        break;
				    case "float":
				        $sql_values.=($value=="")?"0, ":$value.", ";
				        break;
				    case "decimal":
				        $sql_values.=($value=="")?"0, ":$value.", ";
				        break;
				    case "text":
				        $sql_values.='"'.mysqli_real_escape_string($this->connection, utf8_decode($value)).'", ';
				        break;
				    case "datetime":
				        $sql_values.='"'.$value.'", ';
				        break;
				    case "date":
				        $sql_values.='"'.$value.'", ';
				        break;
				}
			}
			$counter++;
		}
		$sql_fields = substr($sql_fields,0,-2);
		$sql_values = substr($sql_values,0,-2);
		$custom_query= 'INSERT INTO '.$source.' ('.$sql_fields.') VALUES ('.$sql_values.')';
		$insertion = mysqli_query($this->connection, $custom_query) or die(mysqli_error($this->connection));
		$last_id = mysqli_insert_id($this->connection);
		return $last_id;
	}
	public function updateScript($oData, $source) {
		$tab_param = $oData->formData;
		$counter=0;
		$array_fields = array();
		$sql_fields="";
		$sql_values="";
		foreach ($tab_param as $key=>$value) {
			$array_fields[$counter] = array();
			$array_fields[$counter][0] = $key;
			$array_fields[$counter][1] = $value;
			$query = 'SELECT DATA_TYPE AS type FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME="'.$source.'" AND COLUMN_NAME="'.$key.'"';
			$recordset = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			while($results = mysqli_fetch_object($recordset)) {
				$array_fields[$counter][2]=$results->type;
				switch ($array_fields[$counter][2]) {
				    case "varchar":
				    	if($key=="uti_password"){
				    		$sql_values='PASSWORD("'.mysqli_real_escape_string($this->connection, utf8_decode($value)).'"), ';
				    	}else{ $sql_values='"'.mysqli_real_escape_string($this->connection, utf8_decode($value)).'", '; }
				        break;
				    case "int":
				    	$sql_values=($value=="")?"0, ":intval($value).", ";
				        break;
				    case "float":
				        $sql_values=($value=="")?"0, ":$value.", ";
				        break;
				    case "decimal":
				        $sql_values=($value=="")?"0, ":$value.", ";
				        break;
				    case "text":
				        $sql_values='"'.mysqli_real_escape_string($this->connection, utf8_decode($value)).'", ';
				        break;
				    case "datetime":
				        $sql_values='"'.$value.'", ';
				        break;
				    case "date":
				        $sql_values='"'.$value.'", ';
				        break;
				}
				$sql_fields.= $key."=".$sql_values;
			}
			$counter++;
		}
		$oMAJ = new stdClass();
		$oMAJ->tname = $source;
		$oMAJ->tvalues = substr($sql_fields,0,-2);
		return $oMAJ;
	}
	public function getLead($oParam){
		$this->set_connect();
		$connect = new Lead();
		$temp = $connect->get_lead($oParam);
		return $temp;
	}
	public function getDTLeads($oLead) {
		$this->set_connect();
		$connect = new Lead();
		$temp = $connect->get_dt_leads($oLead);
		return $temp;
	}
	public function addLead($oParam) {
		$this->set_connect();
		$connect = new Lead();
		$temp = $connect->create_lead($oParam);
		return $temp;
	}
	public function updateLead($oParam) {
		$this->set_connect();
		$connect = new Lead();
		$temp = $connect->update_lead($oParam);
		return $temp;
	}
	public function getDTAdresses($oParam) {
		$this->set_connect();
		$connect = new Adresse();
		$temp = $connect->get_dt_adresses($oParam);
		return $temp;
	}
	public function addAdresse($oParam) {
		$this->set_connect();
		$connect = new Adresse();
		$temp = $connect->add_adresse($oParam);
		return $temp;
	}
	public function updateAdresse($oParam) {
		$this->set_connect();
		$connect = new Adresse();
		$temp = $connect->update_adresse($oParam);
		return $temp;
	}
	public function getAdresse($oParam) {		
		$connect = new Adresse();
		$temp = $connect->get_adresse($oParam);
		return $temp;
	}
}
?>