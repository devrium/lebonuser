<?php 
	session_start();
	require_once '../../services/Si.php'; 
	$instance = new Si();
	$oBien = new stdClass();
	$oBien->formData = $_POST;
	$instance->updateBien($oBien);
	/*if (isset($_SESSION['utilisateur'])){ 
		include 'header-admin.php'; 
		include 'admin_sight.php'; 
	}else{ header('Location: index.php'); }
	if(isset($_POST["img_biens"])){
		$img_biens = $_POST["img_biens"];
		for($i=0; $i<count($img_biens); $i++){
			$query_counter = "SELECT COUNT(id) as nb_photos FROM photos_biens WHERE bien=".$id;
			$recordset = mysqli_query($instance->connection, $query_counter) or die(mysqli_error($instance->connection));
			$row_total = mysqli_fetch_object($recordset);
			$nbre_result = $row_total->nb_photos;
			if($nbre_result<=6){
				$fire = 'INSERT INTO photos_biens (bien, nom ) VALUES ('.$id.', "'.$img_biens[$i].'")';
				$launcher = mysqli_query($instance->connection, $fire) or die("ERROR ".mysqli_error($instance->connection));	
			}
		}
	}
	$id = $_REQUEST['param_bien'];
	$statut = $_REQUEST['param_statut'];
	$programme = $_REQUEST['param_programme'];
	$departement = $_REQUEST['param_departement'];
	$region = $_REQUEST['param_region'];
	$type = $_REQUEST['param_typeBien'];
	$titre = $_REQUEST['param_titre'];
	$adresse = $_REQUEST['param_adresse'];
	$ville = $_REQUEST['param_ville'];
	$cp = $_REQUEST['param_cp'];
	$pays = $_REQUEST['param_pays'];
	$performance_energetique = $_REQUEST['param_perf_energetique'];
	$description_generale = $_REQUEST['param_desc_generale'];
	$num = $_REQUEST['param_num'];
	$num_batiment = $_REQUEST['param_batiment'];
	$num_porte = $_REQUEST['param_porte'];
	$annee_construction = $_REQUEST['param_annee_construction'];
	$neuf_ancien = $_REQUEST['param_neuf'];
	$etage = $_REQUEST['param_etage'];
	$meuble = $_REQUEST['param_meuble'];
	$nb_niveaux = $_REQUEST['param_nbniveaux'];
	$nb_pieces = $_REQUEST['param_nbpieces'];
	$nb_chambres = $_REQUEST['param_nbchambres'];
	$prix_ht = $_REQUEST['param_pht'];
	$prix_ttc = $_REQUEST['param_pttc'];
	$prix_m2_ht = $_REQUEST['param_pmht'];
	$prix_m2_ttc = $_REQUEST['param_pmttc'];
	$surface_habitable = $_REQUEST['param_surface_habitable'];
	$surface = $_REQUEST['param_surface'];
	$type_chauffage = $_REQUEST['param_chauffage'];
	$type_eau_chaude = $_REQUEST['param_type_eauchaude'];
	$date = $_REQUEST['param_date'];
	$type_bail = $_REQUEST['param_type_bail'];
	$loyer_mensuel_hc = $_REQUEST['param_lmhc'];
	$loyer_mensuel_cc = $_REQUEST['param_lmcc'];
	$loyer_annuel_hc = $_REQUEST['param_lahc'];
	$loyer_annuel_cc = $_REQUEST['param_lacc'];
	$depot_garantie = $_REQUEST['param_depot_garantie'];
	$charges_mensuelles_ht = $_REQUEST['param_cmht'];
	$charges_mensuelles_ttc = $_REQUEST['param_cmttc'];
	$charges_annuelles_ht = $_REQUEST['param_caht'];
	$charges_annuelles_ttc = $_REQUEST['param_cattc'];
	$taxe_fonciere = $_REQUEST['param_taxe_fonciere'];
	$ascenceur = $_REQUEST['param_ascenceur'];
	$parking = $_REQUEST['param_parking'];
	$cave = $_REQUEST['param_cave'];
	$diagnostic_dpe = $_REQUEST['param_dpe'];
	$diagnostic_termites = $_REQUEST['param_dt'];
	$diagnostic_plomb = $_REQUEST['param_dp'];
	$diagnostic_amiante = $_REQUEST['param_da'];
	$diagnostic_gaz = $_REQUEST['param_gaz'];
	$diagnostic_electricite = $_REQUEST['param_de'];
	$type_fiscalite = $_REQUEST['param_fiscal'];  if($type_fiscalite=="empty"){$type_fiscalite=0;}
	$fai = $_REQUEST['param_fai'];  if($fai=="empty"){$fai=0;}
	$espace_vert = $_REQUEST['param_ev'];
	$terrasse = $_REQUEST['param_terrasse'];
	///////////////////////////////////////////////////////////////////////////////////////////////////////		
	$query = 'UPDATE biens SET ';
	$query .= 'statut='.$statut.', ';
	$query .= 'programme='.$programme.', ';
	$query .= 'departement='.$departement.', ';
	$query .= 'region='.$region.', ';
	$query .= 'type='.$type.', ';
	$query .= 'titre="'.$titre.'", ';
	$query .= 'adresse="'.$adresse.'", ';
	$query .= 'ville="'.$ville.'", ';
	$query .= 'cp="'.$cp.'", ';
	$query .= 'pays="'.$pays.'", ';
	$query .= 'terrasse='.$terrasse.', ';
	$query .= 'espace_vert='.$espace_vert.', ';
	$query .= 'meuble='.$meuble.', ';
	$query .= 'perf_energetique='.$performance_energetique.', ';
	$query .= 'description_generale="'.$description_generale.'", ';
	$query .= 'num="'.$num.'", ';
	$query .= 'num_batiment="'.$num_batiment.'", ';
	$query .= 'num_porte="'.$num_porte.'", ';
	$query .= 'annee_construction="'.$annee_construction.'", ';
	$query .= 'neuf_ancien='.$neuf_ancien.', ';
	$query .= 'etage="'.$etage.'", ';
	$query .= 'nb_niveaux='.$nb_niveaux.', ';
	$query .= 'nb_pieces='.$nb_pieces.', ';	
	$query .= 'nb_chambres='.$nb_chambres.', ';
	$query .= 'prix_ht='.$prix_ht.', ';
	$query .= 'prix_ttc='.$prix_ttc.', ';	
	$query .= 'prix_m2_ht='.$prix_m2_ht.', ';
	$query .= 'prix_m2_ttc='.$prix_m2_ttc.', ';
	$query .= 'surface_habitable='.$surface_habitable.', ';
	$query .= 'surface='.$surface.', ';
	$query .= 'type_chauffage='.$type_chauffage.', ';
	$query .= 'type_eau_chaude='.$type_eau_chaude.', ';
	$query .= 'date="'.$date.'", ';
	$query .= 'type_bail="'.$type_bail.'", ';
	$query .= 'loyer_mensuel_hc='.$loyer_mensuel_hc.', ';
	$query .= 'loyer_mensuel_cc='.$loyer_mensuel_cc.', ';
	$query .= 'loyer_annuel_hc='.$loyer_annuel_hc.', ';
	$query .= 'loyer_annuel_cc='.$loyer_annuel_cc.', ';
	$query .= 'depot_garantie='.$depot_garantie.', ';
	$query .= 'charges_mensuelles_ht='.$charges_mensuelles_ht.', ';
	$query .= 'charges_mensuelles_ttc='.$charges_mensuelles_ttc.', ';
	$query .= 'charges_annuelles_ht='.$charges_annuelles_ht.', ';
	$query .= 'charges_annuelles_ttc='.$charges_annuelles_ttc.', ';
	$query .= 'taxe_fonciere="'.$taxe_fonciere.'", ';
	$query .= 'ascenceur='.$ascenceur.', ';
	$query .= 'parking='.$parking.', ';
	$query .= 'cave='.$cave.', ';
	$query .= 'diagnostic_dpe="'.$diagnostic_dpe.'", ';
	$query .= 'diagnostic_termites='.$diagnostic_termites.', ';
	$query .= 'diagnostic_plomb='.$diagnostic_plomb.', ';
	$query .= 'diagnostic_amiante='.$diagnostic_amiante.', ';
	$query .= 'diagnostic_gaz='.$diagnostic_gaz.', ';
	$query .= 'diagnostic_electricite='.$diagnostic_electricite.', ';
	$query .= 'type_fiscalite='.$type_fiscalite.', ';
	$query .= 'fai='.$fai.' ';
	$query .= 'WHERE id='.$id;	
	var_dump($query);
	$launch_query = mysqli_query($instance->connection, $query) or die(mysqli_error($instance->connection));
	if($launch_query){
		echo '<div class="col-md-12"><span style="color:#000;">BIEN MODIFI&Eacute;E</span></div>';
	}else{ echo json_encode(array('msg'=>'Some errors occured.')); }	*/
?>