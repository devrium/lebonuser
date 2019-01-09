<?php 
	//session_start();
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	require_once 'services/Si.php';
	require_once 'services/Admin.php';
	$instance_a = new Admin();
	$instance = new Si();
	$absolute_url = "http://localhost/lebonuser";
	$absolute_ssl_url = "http://localhost/lebonuser";
	$global_user = $_SESSION['utilisateur'];
	$global_iduser = $_SESSION['id_utilisateur'];
	$obj = $instance_a->Dashboard($global_iduser);
	$prenom = $obj->user_prenom;
	$nom = $obj->user_nom;
	$email = $obj->user_email;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
	<meta http-equiv="Expires" content="0" />
	<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=1024;" />
	<title>Lebon user</title>
	<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/css/styles.css" />
	<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/css/suivi_immobilier.css" />	
	<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/css/bootstrap-datepicker3.css" />
	<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/font-awesome/css/font-awesome.min.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/css/toastr.css" type="text/css"/>
	<script src="<?php echo $absolute_url; ?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/bootstrap/js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/js/bootstrap-datepicker.js"></script>		
	<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/locales/bootstrap-datepicker.fr.min.js"></script>
	<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/js/navigation.js"></script>			
	<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/js/toastr.js"></script>
	<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/js/jquery.mousewheel.js"></script>
	<script defer src="<?php echo $absolute_url; ?>/assets/js/solid.min.js"></script>
	<script defer src="<?php echo $absolute_url; ?>/assets/js/fontawesome.min.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="body-admin">
	<nav class="navbar navbar-fixed-top footer_color">
	  	<div class="container-fluid">
			<div class="parameters-section">
				<span style="color:#00ffff;">Bienvenue <?php echo $prenom.' '.$nom; ?></span>
			</div>
	  	</div>
	</nav>
	<!-- HEADER -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2 footer_color">
				<div class="menu-items"><a href="<?php echo $absolute_ssl_url; ?>/view/list/list_adresses.php">Adresses</a></div>
				<div class="menu-items"><a href="<?php echo $absolute_ssl_url; ?>/view/list/list_leads.php">Contacts</a></div>
			</div>
			<div class="col-md-10">