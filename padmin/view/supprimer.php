<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../../js/jquery-3.1.1.min.js"/></script>
	<title>Panel Admin</title/>
	</head>
	<body>
		<header>
			<h1>Panel Admin</h1>
		</header>
		<div class="col-md-10" style="display:inline-block;">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>id</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Début du contrat</th>
						<th>Fin du contrat</th>
						<th>Nombre d'heures par semaine</th>
						<th>Salaire brut</th>
						<th>Salaire net</th>
						<th>Societe</th>
						<th>Statut</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
						include('../model/user.php');
						?>
						<form method="post" action="../model/delete.php">
							<td width="20%"><?php echo $membre_array['id_users'];?></td>
							<input type="hidden" name="id" value="<?php echo $membre_array['id_users']; ?>" />
							<td width="20%"><?php echo $membre_array['nom']; ?></td>
							<td width="20%"><?php echo $membre_array['prenom']; ?></td>
							<td width="20%"><?php echo $membre_array['start_contrat']; ?></td>
							<td width="20%"><?php echo $membre_array['end_contrat']; ?></td>
							<td width="20%"><?php echo $membre_array['heure_semaine']; ?></td>
							<td width="20%"><?php echo $membre_array['salaire_brut']; ?></td>
							<td width="20%"><?php echo $membre_array['salaire_net']; ?></td>
							<td width="20%"><?php echo $membre_array['societe']; ?></td>
							<td width="20%"><?php echo $membre_array['role']; ?></td>
							<td><button class="btn btn-danger delete-row-profil" style="float:right;position:relative;" value="Supprimer" />Supprimer</button></td>
						</form>
					</tr>
					<!-- <a href=javascript:history.go(-1)>Retour</a> -->
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>start</th>
						<th>pause</th>
						<th>reprise</th>
						<th>fin</th>
						<th>total journée</th>
						<th>total semaine</th>
						<th>total mois</th>
						<th>total année</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
						include('../model/horaire.php');
						?>
						<form method="post" action="../model/deletehoraires.php">
							<td style="display:none;"><input type="text" name="mois" value="<?php echo $v['mois']; ?>"/></td>
							<td style="display:none;"><input type="text" name="annee" value="<?php echo $v['annee']; ?>"/></td>
							<td style="display:none;"><input type="text" name="semaine" value="<?php echo $v['semaine'];?>"/></td>
							<td style="display:none;"><input type="text" name="id_horaire" value="<?php echo $v['id_horaire'];?>"/></td>
							<td style="display:none;"><input type="text" name="id_users" value="<?php echo $v['id_users'];?>" /></td>
							<td width="20%"><?php echo $v['start']; ?></td>
							<td width="20%"><?php echo $v['pause']; ?></td>
							<td width="20%"><?php echo $v['reprise']; ?></td>
							<td width="20%"><?php echo $v['fin']; ?></td>
							<td width="20%"><?php echo $v['total_journee']; ?></td>
							<td width="20%"><?php echo $v['total_semaine']; ?></td>
							<td width="20%"><?php echo $v['total_mois']; ?></td>
							<td width="20%"><?php echo $v['total_annee']; ?></td>
							<td><button class="btn btn-danger delete-row" style="float:right;position:relative;" value="Supprimer" />Supprimer</button></td>
						</form>
					</tr>
					<a href=javascript:history.go(-1)>Retour</a>
				</tbody>
			</table>
		</div>
	</body>
	<script>
	$(".delete-row-profil").on("click", function()
	{
		var input = $(this).closest("tr").find(":input").serialize();
		$.ajax({
			url: "../model/delete.php",
			type: "POST",
			data: $input,
			complete : function(resultat, statut){
				window.location.reload();
			}
		});
	});
	$(".delete-row").on("click", function()
	{
		var input = $(this).closest("tr").find(":input").serialize();
		$.ajax({
			url: "../model/deletehoraires.php",
			type: "POST",
			data: $input,
			complete : function(resultat, statut){
				window.location.reload();
			}
		});
	});
	</script>
	</html>
