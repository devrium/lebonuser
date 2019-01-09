<?php 
	session_start();
	require_once '../../services/Si.php'; 
	$instance 			= new Si();
	$oParam 			= new stdClass();
	$oParam->formData 	= $_REQUEST;
	$oParam->user		= $_SESSION['id_utilisateur'];
	$obj				= $instance->getDTAdresses($oParam);
	echo json_encode($obj);
?>