<?php
class Lead extends Si {		
	var $obj;
	var $tab = array();
	public function get_lead($oParam){
		$this->obj = new stdClass();
		$count=0;
		$query = "SELECT * FROM leads WHERE lead_id=".$oParam->lead_id." AND lead_user=".$oParam->user_id;
		$recordset = mysqli_query($this->connection, $query) or die (mysqli_error($this->connection));
		while ($results = mysqli_fetch_object($recordset)) {			
			$results = $this->utf8_granted($results);
			$this->tab[$count] = $results;
			$count++;
		}
		$this->obj->total = $count;
		$this->obj->rows = $this->tab;
		return $this->obj;
	}

	public function get_dt_leads($oLead){
		$oData = $oLead->formData;
		$lookfor = $oData['search']['value'];
		$orderedBY = intval($oData['order'][0]['column']);
		$order = $oData['order'][0]['dir'];
		$tri = $oData['columns'][$orderedBY]['data'];
		$this->obj = new stdClass();		
		$count=0;
		$crit="";
		if($lookfor!=""){ 
			$crit.=" AND leads.lead_user='".$oLead->user."' AND ( leads.lead_created LIKE '".str_replace('/','-',date('Y-m-d', strtotime($lookfor)))."%' OR leads.lead_id LIKE '".$lookfor."%' OR leads.lead_prenom LIKE '%".$lookfor."%' OR leads.lead_nom LIKE '%".$lookfor."%')"; 
		}
		$query="SELECT * FROM leads WHERE lead_id IS NOT NULL ".$crit;
		$query.=" ORDER BY ".$tri." ".$order." LIMIT ".$oData["start"].", ".$oData["length"];
		$recordset = mysqli_query($this->connection, $query) or die (mysqli_error($this->connection));
		while ($results = mysqli_fetch_object($recordset)) {
			if(($results->lead_nom=="")||($results->lead_nom==NULL)){ $results->lead_nom="non renseign&eacute;"; }
			if(($results->lead_prenom=="")||($results->lead_prenom==NULL)){ $results->lead_prenom="non renseign&eacute;"; }
			$results->lead_created= $this->dateFR($results->lead_created, 2);
			$results = $this->utf8_granted($results);
			$this->tab[$count] = $results;
			$count++;
		}
		
		$query_total="SELECT COUNT(*) AS total FROM leads";
		$query_total.=" WHERE leads.lead_id IS NOT NULL ".$crit;
		$rec_total = mysqli_query($this->connection, $query_total) or die (mysqli_error($this->connection));
		$res_total = mysqli_fetch_object($rec_total);
		$this->obj->recordsTotal = $res_total->total;
		$this->obj->recordsFiltered = $res_total->total;
		$this->obj->total = $count;
		$this->obj->rows = $this->tab;		
		return $this->obj;
	}

	public function create_lead($oParam){
		$query = "SELECT * FROM leads WHERE lead_nom='".utf8_decode($oParam->formData['lead_nom'])."' AND lead_prenom='".utf8_decode($oParam->formData['lead_prenom'])."' AND lead_email='".$oParam->formData['lead_email']."' AND lead_user=".$oParam->formData['lead_user'];
		$recordset = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
		$the_count = mysqli_num_rows($recordset);
		$oCallBack = new stdClass();
		if($the_count>0){
			$oCallBack->si_success=false;
			$oCallBack->si_message="Ce contact est déjà présent dans votre base!";
			$oCallBack->si_title="La création a échouée!";
			return $oCallBack;
		}else{
			$idLine = $this->addInsertion($oParam, "leads");
			$oCallBack->si_success=true;
			$oCallBack->si_message="Votre contact a bien été crée en base!";
			$oCallBack->si_title="La création est terminée!";
			return $oCallBack;
		}
	}

	public function update_lead($oLead){
		$tab_param = $oLead->formData;
		$oMAJ = $this->updateScript($oLead, "leads");
		$custom_query= 'UPDATE '.$oMAJ->tname.' SET '.$oMAJ->tvalues.' WHERE lead_id='.$tab_param['lead_id'];
		$insertion = mysqli_query($this->connection, $custom_query) or die(mysqli_error($this->connection));	
		$oCallBack = new stdClass();
		if($insertion){
			$oCallBack->si_success=true;
			$oCallBack->si_message="Votre contact a bien été mis à jour !";
			$oCallBack->si_title="La mise à jour est terminée!";
			return $oCallBack;
		}else{
			$oCallBack->si_success=false;
			$oCallBack->si_message="Une erreur est survenue durant la mise à jour !";
			$oCallBack->si_title="La mise à jour a échouée!";
			return $oCallBack;
		}
	}
}
?>