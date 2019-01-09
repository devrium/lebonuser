<?php 
	session_start();
	if (isset($_SESSION['utilisateur'])){ 
		include '../../header-admin.php';
		$listeLeads = $instance->getListe("leads", "lead_user", $global_iduser);
	}else{ header('Location: ../../index.php'); }
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.add-contact').click(function(event) {
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
			$("#adresse-form").submit();
		});
	});
</script>
<h2 class="page-focused"><i class="fas fa-file-alt fa-1x"></i> Ajouter une adresse</h2>
<div class="col-md-12">
	<form name="create_adresse" id="adresse-form" action="<?php echo $absolute_ssl_url; ?>/controller/create/create_adresse.php" method="post" class="form-inline" role="form">
		<input type="hidden" name="addr_user" id="user" value="<?php echo $_SESSION['id_utilisateur']; ?>" />
		<input type="hidden" name="addr_lead" id="addr_lead" value="" />
		<input type="hidden" name="addr_created" id="addr_created" value="<?php echo date("Y-m-d H:i:s"); ?>" />
		<div class="fp_label col-md-12"><span class="fp_label_txt">RENSEIGNEMENTS</span></div>							
		<div class="col-md-12 spec2"><div class="input-group"><span class="input-group-addon">Rue : </span><input name="addr_rue" class="form-control" /></div></div>
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Code postal : </span><input name="addr_cp" class="form-control" /></div></div>
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Ville : </span><input name="addr_ville" class="form-control" /></div></div>
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Pays : </span><input name="addr_pays" class="form-control" /></div></div>
		<div class="col-md-12 boxed">
			<div class="box-title">
				<span class="bt-txt">Contact</span>
				<a class="btn btn-default pull-right" href="#" data-toggle="modal" data-target="#lead-modal" role="button"><i class="fa fa-plus"></i> S&eacute;lectionnez le contact</a>
			</div>
			<div class="box-content mod_contact"><div class="sel-query"></div></div>
		</div>
		<div class="col-md-12"><input type="submit" value="Ajouter" id="adresse-creator" class="btn btn-primary"/></div>
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