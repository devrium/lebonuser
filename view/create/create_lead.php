<?php 
	session_start();
	if (isset($_SESSION['utilisateur'])){ include '../../header-admin.php'; }else{ header('Location: http://localhost/lebonuser'); }
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.lead-submit').click(function(event) {
			event.preventDefault();
			$.ajax({
				type: "POST",
				url: "../../controller/create/create_lead.php",
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
<h2 class="page-focused"><i class="fas fa-user fa-1x"></i> Créer un contact</h2>
<div class="col-md-12">
	<form name="create_lead" id="lead-form" action="<?php echo $absolute_url; ?>/controller/create/create_lead.php" method="post" class="form-inline" role="form">
		<input type="hidden" name="lead_user" id="lead_user" value="<?php echo $_SESSION['id_utilisateur']; ?>" />
		<input type="hidden" name="lead_created" id="lead_created" value="<?php echo date("Y-m-d H:i:s"); ?>" />
		<div class="col-md-12"></div>							
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Prénom : </span><input name="lead_prenom" class="form-control" /></div></div>
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Nom : </span><input name="lead_nom" class="form-control" /></div></div>
		<div class="col-md-4 spec2"><div class="input-group"><span class="input-group-addon">Email : </span><input name="lead_email" class="form-control" /></div></div>
		<div class="col-md-12 div_bouton_terminer"><input type="submit" value="AJOUTER" class="btn btn-primary lead-submit"/></div>
	</form>
</div>
<?php include '../../footer-admin.php'; ?>