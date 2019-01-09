<?php 
	session_start();
	require_once '../../services/Si.php';
	$instance = new Si();
	$oParam = new stdClass();
	$oParam->formData = $_POST;
	$instance->addAdresse($oParam);
?>