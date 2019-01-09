<?php 
	session_start();
	require_once '../../services/Si.php'; 
	$instance 			= new Si();
	$oParam 				= new stdClass();
	$oParam->formData 	= $_POST;
	$oParam->user 		= $_SESSION['id_utilisateur'];
	$obj 				= $instance->getDTLeads($oParam);
	echo json_encode($obj);	
?>