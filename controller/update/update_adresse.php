<?php 
	session_start();
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	require_once '../../services/Si.php'; 
	$instance = new Si();
	$oParam = new stdClass();
	$oParam->formData = $_POST;
	$instance->updateAdresse($oParam);
?>