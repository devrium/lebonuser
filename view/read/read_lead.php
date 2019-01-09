<?php 
	session_start();
	if (isset($_SESSION['utilisateur'])){ 
		include '../../header-admin.php';
		$oParam = new stdClass();
		$oParam->lead_id = $_REQUEST["id_lead"];
		$oParam->user_id = $_SESSION['id_utilisateur'];
		$oLead=$instance->getLead($oParam);
		$oLead=$oLead->rows[0];
	}else{ header('Location: '.$absolute_url); }
?>
<script type="text/javascript">
	$(document).ready(function() {	
		var idLEAD=<?php echo $_REQUEST['id_lead']; ?>;
		$('#table-adresses').dataTable({
			"pagingType": "simple",
			"processing": true,
	        "serverSide": true,
	        "ajax": {
	            "url": "../../controller/list/list_adresses.php?id_lead="+idLEAD,
	            "dataSrc": "rows",
	            "type": "POST"
	        },
	        "columnDefs": [
	            {"render": function ( data, type, row ) { return data; }, "targets": 0},
	            {"render": function ( data, type, row ) { return data; }, "targets": 1},
	            {"render": function ( data, type, row ) { return data; }, "targets": 2},
	            {"render": function ( data, type, row ) { return data; }, "targets": 3},
	            {"render": function ( data, type, row ) { 
		            var	urx = '<a href="../update/update_adresse.php?id_adresse='+row.addr_id+'" target="_self" title="Modifier">Modifier</a>';
	            	return urx;
	            }, "targets": 4}
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
<div class="col-md-12">
	<h3>Identité : <?php echo $oLead->lead_prenom." ".strtoupper($oLead->lead_nom); ?><br/>Adresse email : <?php echo $oLead->lead_email; ?></h3>
</div>
<div class="col-md-12">
	<div class="col-md-12 property-line"><span class="subtop-txt">Listes des adresses de ce contact</span></div>
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
<?php include '../../footer-admin.php'; ?>