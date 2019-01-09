<?php 
	session_start();
	if (isset($_SESSION['utilisateur'])){ include '../../header-admin.php'; }else{ header('Location: http://localhost/lebonuser'); }
?>
<h2 class="page-focused">
	<i class="fas fa-users fa-1x"></i> Mes contacts
	<a href="<?php echo $absolute_ssl_url; ?>/view/create/create_lead.php" class="btn btn-primary pull-right" target="_blank" title="Ajouter un contact"><i class="fa fa-plus fa-1x"></i> Ajouter un contact</a>
</h2>
<div class="col-md-12">
	<div class="col-md-12">
		<table class="table table-striped table-bordered table-si" id="table-leads">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot></tfoot>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {	
		$('#table-leads').dataTable({
			"pagingType": "simple",
			"processing": true,
	        "serverSide": true,
	        "ajax": {
	            "url": "../../controller/list/list_lead.php",
	            "dataSrc": "rows",
	            "type": "POST"
	        },
	        "columnDefs": [
      			{"render": function ( data, type, row ) { return data; }, "targets": 0},
	            {"render": function ( data, type, row ) { return data; }, "targets": 1},
	            {"render": function ( data, type, row ) { return data; }, "targets": 2},
	            {"render": function ( data, type, row ) { 
	            	var	urx = '<a href="../read/read_lead.php?id_lead='+row.lead_id+'" target="_self" title="Consulter">Consulter</a> / <a href="../update/update_lead.php?id_lead='+row.lead_id+'" target="_self" title="Modifier">Modifier</a>';
	            	return urx;;
	            }, "targets": 3}
	        ],
	        "columns": [
	            { "data" : "lead_nom" },
	            { "data" : "lead_prenom" },
	            { "data" : "lead_email" },
	            { "data" : "action" }
	        ],
	        "oLanguage": {
		      "oPaginate": { "sNext": " Suivant >>","sPrevious": " << Précédent" },
		      "sInfo": "_TOTAL_ résultats",
		      "info": "Page _PAGE_ sur _PAGES_",
		      "sLengthMenu": "Afficher _MENU_ résultats",
		      "sLoadingRecords": "Chargement...",
		      "sProcessing": "Merci de patienter pendant le chargement...",
		      "sInfoEmpty": "0 résultats",
		      "sZeroRecords": "Aucuns résultats correspondants en base!",
		      "sSearch": "Rechercher:"	      
		    }
		});
	});
</script>
<?php include '../../footer-admin.php'; ?>