<?php
class Adresse extends Si{	
	var $obj;
	var $obj_adresse;
	var $tab = array();

	public function get_adresse($oParam) {
		$query = "SELECT * FROM adresses LEFT JOIN users ON users.user_id=".$oParam->addr_user." LEFT JOIN leads ON leads.lead_id=adresses.addr_lead WHERE adresses.addr_id=".$oParam->addr_id;
		$recordset = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));		
		while ($row_recordset = mysqli_fetch_object($recordset)) {
			$this->obj_adresse = $row_recordset;
		}
		return $this->obj_adresse;
	}
	public function get_dt_adresses($oParam){
		$oData = $oParam->formData;
		$lookfor = $oData['search']['value'];
		$this->obj = new stdClass();		
		$count=0;
		$crit="";
		if(isset($oData['id_lead'])){ $crit.=" AND adresses.addr_lead='".$oData['id_lead']."'"; }
		if($lookfor!=""){ 
			$crit.=" AND adresses.addr_user='".$oParam->user."' AND ( adresses.addr_rue LIKE '".$lookfor."%' OR adresses.addr_cp LIKE '".$lookfor."%' OR adresses.addr_ville LIKE '".$lookfor."%' OR adresses.addr_created LIKE  '".str_replace('/','-',date('Y-m-d', strtotime($lookfor)))."%' OR users.user_prenom LIKE '%".$lookfor."%' OR users.user_nom  LIKE '%".$lookfor."%')";
		}
		$query="SELECT * FROM adresses";
		$query.=" LEFT JOIN users ON users.user_id=adresses.addr_lead";
		$query.=" WHERE adresses.addr_id IS NOT NULL ".$crit;
		$query.=" ORDER BY adresses.addr_id DESC LIMIT ".$oData["start"].", ".$oData["length"];
		//var_dump($query);
		$recordset = mysqli_query($this->connection, $query) or die (mysqli_error($this->connection));
		while ($results = mysqli_fetch_object($recordset)) {
			$results = $this->utf8_granted($results);
			$this->tab[$count] = $results;
			$count++;
		}
		
		$query_total="SELECT COUNT(*) AS total FROM adresses";
		$query_total.=" LEFT JOIN users ON users.user_id=adresses.addr_lead";
		$query_total.=" WHERE adresses.addr_id IS NOT NULL ".$crit;
		$rec_total = mysqli_query($this->connection, $query_total) or die (mysqli_error($this->connection));
		$res_total = mysqli_fetch_object($rec_total);
		$this->obj->recordsTotal = $res_total->total;
		$this->obj->recordsFiltered = $res_total->total;
		$this->obj->total = $count;
		$this->obj->rows = $this->tab;		
		return $this->obj;
	}

	public function add_adresse($oParam){
		$last_id = $this->addInsertion($oParam, "adresses");
		if($last_id){ header('Location: ../../view/list/list_adresses.php'); }
	}

	public function update_adresse($oParam){
		$tab_param = $oParam->formData;
		$oMAJ = $this->updateScript($oParam, 'adresses');
		$custom_query= 'UPDATE '.$oMAJ->tname.' SET '.$oMAJ->tvalues.' WHERE addr_id='.$tab_param['addr_id'];
		$insertion = mysqli_query($this->connection, $custom_query) or die(mysqli_error($this->connection));
		if ($insertion){ header('Location: ../../view/list/list_adresses.php'); }
	}
}
?>