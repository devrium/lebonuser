<?php 
	session_start();
	if (isset($_SESSION['utilisateur'])){ 
		include '../../header-admin.php'; 
		$listeLeads = $instance->getListe("leads", "lead_user", $global_iduser);
		$oParam = new stdClass();
		$oParam->addr_id = $_REQUEST['id_adresse'];
		$oParam->addr_user = $_SESSION['id_utilisateur'];
		$obj = $instance->getadresse($oParam);
	}else{ 
		header('Location: '.$absolute_url); 
	}	
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.sel-item').click(function(event) { $(this).remove(); });
		$('.add-contact').click(function(event) {
			console.log("toto");
			var item_title = $(this).attr("data-libelle");
			var item_id = $(this).attr('id');
			var item = '<div class="sel-item" id="'+item_id+'"><i class="fa fa-user"></i> <span>'+item_title+'</span></div>';
			$(".mod_contact").find('.sel-query').html(item);
			$('.sel-item').click(function(event) { $(this).remove(); });
		});
		$('#adresse-creator').click(function(event) {
			event.preventDefault();
			var contacts="";
			$(".mod_contact").find('.sel-item').each(function() { contacts = $(this).attr("id"); });
			$("#addr_lead").val(contacts.toString());
			contacts=contacts.toString();
			$("#adresse-form").submit();
		});
	});
</script>
<h2 class="page-focused">
	<i class="fas fa-file-alt fa-1x"></i> Modifier une adresse
	<a href="<?php echo $absolute_ssl_url; ?>/view/list/list_adresses.php" class="btn btn-primary pull-right" target="_blank" title="Retour à la liste"><i class="fa fa-list fa-1x"></i> Liste des adresses</a>
</h2>
<div class="col-md-12">
	<form name="update_adresse" id="adresse-form" action="<?php echo $absolute_url; ?>/controller/update/update_adresse.php" method="post" class="form-inline" role="form">
		<input type="hidden" name="addr_id" id="addr_id" value="<?php echo $_REQUEST['id_adresse']; ?>" />
		<input type="hidden" name="addr_lead" id="addr_lead" value="<?php echo $obj->addr_lead; ?>" />
		<div class="fp_label col-md-12"><span class="fp_label_txt">RENSEIGNEMENTS</span></div>										
		<div class="col-md-12 spec2"><div class="input-group"><span class="input-group-addon">Adresse : </span><input name="addr_rue" value="<?php echo $obj->addr_rue; ?>" class="form-control"></input></div></div>
		<div class="col-md-6 spec2"><div class="input-group"><span class="input-group-addon">Ville : </span><input name="addr_ville" value="<?php echo $obj->addr_ville; ?>" class="form-control"></input></div></div>
		<div class="col-md-6 spec2"><div class="input-group"><span class="input-group-addon">Code postal : </span><input name="addr_cp" value="<?php echo $obj->addr_cp; ?>" class="form-control"></input></div></div>
		<div class="col-md-6 spec2"><div class="input-group"><span class="input-group-addon">Pays : </span><input name="addr_pays" value="<?php echo $obj->addr_pays; ?>" class="form-control"></input></div></div>
		<div class="col-md-12 boxed">
			<div class="box-title">
				<span class="bt-txt">Contact</span>
				<a class="btn btn-default pull-right" href="#" data-toggle="modal" data-target="#lead-modal" role="button"><i class="fa fa-plus"></i> S&eacute;lectionnez le contact</a>
			</div>
			<div class="box-content mod_contact">
				<div class="sel-query">
					<?php
						if ($obj->lead_id!=null) {
							echo '<div class="sel-item" id="'.$obj->lead_id.'"><i class="fa fa-user"></i> <span>'.utf8_encode($obj->lead_prenom).' '.utf8_encode($obj->lead_nom).'</span> | <i class="fas fa-trash fa-1x"></i></div>';
						}
					?>
				</div>
			</div>
		</div>
		<div class="col-md-12"><input type="submit" value="Mettre à jour" class="btn btn-primary" id="adresse-creator"/></div>
	</form>
</div>
<div class="modal fade" id="lead-modal" tabindex="-1" role="dialog" aria-labelledby="leadLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="leadLabel">Sélectionnez un contact</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="row">
	      		<div class="col-md-12 boxed" id="lead-popup">
					<div class="box-content">
						<div class="col-md-12 global-table">
							<table class="table table-striped" id="table-lead">
							    <thead>
							        <tr>
							          <th>Identité du contact</th>
							          <th>Action</th>
							        </tr>
							    </thead>
							    <tbody class="res-table">
							      	<?php
							      		for ($i=0; $i < count($listeLeads->Elements); $i++) { 
							      		 	echo '<tr class="tab-res">';
							      		 	echo '<td class="tab-libelle"><span>'.utf8_encode($listeLeads->Elements[$i]->lead_prenom).' '.utf8_encode($listeLeads->Elements[$i]->lead_nom).'</span></td>';
							      		 	echo '<td class="tab-action"><span data-libelle="'.utf8_encode($listeLeads->Elements[$i]->lead_prenom).' '.utf8_encode($listeLeads->Elements[$i]->lead_nom).'" class="btn btn-primary btn-action add-contact" id="'.$listeLeads->Elements[$i]->lead_id.'"><i class="fa fa-plus"></i> Ajouter</span></td>';
							      		 	echo '</tr>';
							      		} 
							      	?>
							    </tbody>
						    </table>
						</div>
					</div>
				</div>
			</div>	  
	    </div>
	    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button></div>
    </div>
  </div>
</div>
<?php include '../../footer-admin.php'; ?>