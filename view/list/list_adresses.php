<?php 
	session_start();
	if (isset($_SESSION['utilisateur'])){ include '../../header-admin.php'; }else{ header('Location: http://localhost/lebonuser'); }
?>	
<h2 class="page-focused">
	<i class="fas fa-file-alt fa-1x"></i> Carnet d'adresses
	<a href="<?php echo $absolute_ssl_url; ?>/view/create/create_adresse.php" class="btn btn-primary pull-right" target="_blank" title="Ajouter un bien"><i class="fa fa-plus fa-1x"></i> Ajouter une adresse</a>
</h2>
<div class="col-md-12">
	<div class="col-md-12">
		<table class="table table-striped table-bordered table-si" id="table-adresses">
			<thead>
				<tr>
					<th>Rue</th>
					<th>Code postal</th>
					<th>Ville</th>
					<th>Pays</th>
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
		$('#table-adresses').dataTable({
			"pagingType": "simple",
			"processing": true,
	        "serverSide": true,
	        "ajax": {
	            "url": "../../controller/list/list_adresses.php",
	            "dataSrc": "rows",
	            "type": "POST"
	        },
	        "columnDefs": [
	            {"render": function ( data, type, row ) { return data; }, "targets": 0},
	            {"render": function ( data, type, row ) { return data; }, "targets": 1},
	            {"render": function ( data, type, row ) { return data; }, "targets": 2},
      			{"render": function ( data, type, row ) { return data; }, "targets": 3},
	            {"render": function ( data, type, row ) { 
					var urx='<a href="../update/update_adresse.php?id_adresse='+row.addr_id+'" target="_self" title="Modifier">Modifier</a>';
	            	return urx; }, "targets": 4}
	        ],
	        "columns": [
	            { "data" : "addr_rue" },
	            { "data" : "addr_cp" },
	            { "data" : "addr_ville" },
	            { "data" : "addr_pays" },
	            { "data" : "action" }
	        ],
	        "oLanguage": {
		      "oPaginate": { "sNext": " Suivant >>", "sPrevious": " << Précédent" },
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