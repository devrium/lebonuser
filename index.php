<?php 
	session_start();
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
	if(isset($_REQUEST['param_login'])){$value_id = mysqli_real_escape_string($instance->connection, $_REQUEST['param_login']);}else{$value_id="";}
	if(isset($_REQUEST['param_password'])){$value_pwd = mysqli_real_escape_string($instance->connection, $_REQUEST['param_password']);}else{$value_pwd="";}
	if(!isset($_SESSION['utilisateur'])) {
		if ($value_id == "" || $value_pwd == "") { // Au moins un des deux champ Ã  renseigner est vide
			$wrong_message = "Tous les champs doivent &ecirc;tre renseign&eacute;s!";
		} else if($value_id != "" && $value_pwd != "") {
			$object_user = $instance_a->getConnect($value_id, $value_pwd);
			if ($object_user == null) {
				$wrong_message = '<i class="fa fa-exclamation-triangle"></i> Identifiant ou mot de passe incorrect';
			}else if ($object_user->user_statut == 0) {
				$wrong_message = '<i class="fa fa-exclamation-triangle"></i> Utilisateur d&eacute;sactiv&eacute;';
			}else{
				$_SESSION['utilisateur'] = utf8_encode($object_user->user_prenom).' '.utf8_encode($object_user->user_nom);
				$_SESSION['id_utilisateur'] = $object_user->user_id;
				header('Location: '.$absolute_ssl_url.'/view/list/list_adresses.php');
			}
		}
	}else{
		$global_user = $_SESSION['utilisateur'];
		$global_iduser = $_SESSION['id_utilisateur'];
		header('Location: '.$absolute_ssl_url.'/view/list/list_adresses.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
		<meta http-equiv="Expires" content="0" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=1024;" />
		<title>Lebonuser</title>
		<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/css/styles.css" />
		<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/css/suivi_immobilier.css" />	
		<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/font-awesome/css/font-awesome.min.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="<?php echo $absolute_url; ?>/assets/bootstrap/css/bootstrap.min.css" />
		<script src="<?php echo $absolute_url; ?>/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/bootstrap/js/bootstrap.min.js"></script>	
		<script type="text/javascript" src="<?php echo $absolute_url; ?>/assets/js/navigation.js"></script>			
	</head>
	<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<div class="container-fluid footer_color">
			<div class="container">
				<div class="logo_immobilier">
					<h1>LEBON<span style="color:#00ffff;">USER</span></h1>
				</div>
			</div>
		</div>
		<div class="container-fluid features-logon">
			<div class="row">
				<div class="container logon-spacer">
					<div class="row">		
						<?php
							if(isset($wrong_message)){
								echo '<div class="col-md-12 centralize"><div class="col-md-4 centered spec_paddin0"><p class="bg-primary spec_paddintb">'.$wrong_message.'</p></div></div>';
							}
						?>
						<div class="col-md-12 centralize">
							<div class="col-md-4 logon">
								<form id="connect_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
									<div class="col-md-12 spec3"><div class="input-group"><span class="input-group-addon fa fa-user fa-2x"></span><input id="param_login" class="form-control" type="text" size="30" name="param_login" placeholder="Identifiant"></input></div></div>
									<div class="col-md-12 spec3"><div class="input-group"><span class="input-group-addon fa fa-lock fa-2x"></span><input id="param_password" class="form-control" type="password" size="30" name="param_password" placeholder="Mot de passe"></input></div></div>
									<div class="col-md-12 spec3"><button type="submit" class="btn btn-primary">SE CONNECTER</button></div>
								</form>
							</div>				
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid footer_color">	
			<div class="row">
				<div class="container">	
					<div class="row footer_copy">
						<span class="copyright_ubinov">
							&copy; 2019 <a href="http://ubinov.fr" target="_blank" title="Agence UBINOV" class="copyright_link">UBINOV</a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>