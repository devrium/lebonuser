<?php
class Liste extends Si {	
	var $tab = array();
	var $obj;	
	public function get_liste($table, $column, $value){
		$query = "SELECT * FROM ".$table;
		if(is_string($column) && $column!=""){
			$clause=" WHERE ".$column."=";
			switch (gettype($value)){
			    case "string":
			        $clause.='"'.$value.'"';
			        break;
			    case "integer":
			        $clause.=$value;
			        break;
			}
			$query.=$clause;
		}
		$recordset = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
		$counter = 0;
		while ($row_recordset = mysqli_fetch_object($recordset)) {
			$this->tab[$counter] = $row_recordset;
			$counter++;
		}
		$this->obj = new stdClass();
		$this->obj->Count = $counter;
		$this->obj->Elements = $this->tab;		
		return $this->obj;
	}
}
?>