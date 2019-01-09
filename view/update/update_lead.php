<?php 
	session_start();
	if (isset($_SESSION['utilisateur'])){ 
		include '../../header-admin.php';
		$oParam = new stdClass();
		$oParam->lead_id = $_REQUEST["id_lead"];
		$oParam->user_id = $_SESSION['id_utilisateur'];
		$oLead=$instance->getLead($oParam);
		$oLead=$oLead->rows[0];
	}else{ header('Location: ../../index.php'); }
?>
<h2 class="page-focused">
	<i class="fas fa-user fa-1x"></i>  Modifier un contact
	<a href="<?php echo $absolute_ssl_url; ?>/view/list/list_leads.php" class="btn btn-primary pull-right" target="_blank" title="Retour à la liste"><i class="fa fa-list fa-1x"></i> Liste des contacts</a>
</h2>
<script type="text/javascript">
	$(document).ready(function(){
		$('.lead-submit').click(function(event) {
			event.preventDefault();
			$.ajax({
				type: "POST",
				url: "../../controller/update/update_lead.php",
				data: $('#lead-form').serialize(),
				success: function(msg){
					var xjs = JSON.parse(msg);
					if(xjs.si_success==true){
						toastr.success(xjs.si_message, xjs.si_title);
					}else{
						toastr.error(xjs.si_message, xjs.si_title);
					}
					toastr.options = {
					  "closeButton": false,
					  "debug": false,
					  "newestOnTop": false,
					  "progressBar": false,
					  "positionClass": "toast-top-center",
					  "preventDuplicates": false,
					  "onclick": null,
					  "showDuration": "300",
					  "hideDuration": "1000",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
				}
			});
		});
	});
</script>
<div class="col-md-12">
	<form name="update_lead" id="lead-form" action="<?php echo $absolute_url; ?>/controller/update/update_lead.php" method="post" class="form-inline" role="form">
		<input type="hidden" name="lead_id" id="lead_id" value="<?php echo $_REQUEST["id_lead"]; ?>" />
		<div class="col-md-12"></div>							
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Prénom : </span><input name="lead_prenom" class="form-control" value="<?php echo $oLead->lead_prenom; ?>"/></div></div>
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Nom : </span><input name="lead_nom" class="form-control" value="<?php echo $oLead->lead_nom; ?>"/></div></div>
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Email : </span><input name="lead_email" class="form-control" value="<?php echo $oLead->lead_email; ?>"/></div></div>
		<div class="col-md-12 div_bouton_terminer"><input type="submit" value="Mettre à jour" class="btn btn-primary lead-submit"/></div>
	</form>
</div>
<?php include '../../footer-admin.php'; ?>

