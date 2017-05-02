<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
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
							<td width="20%"><?php echo $membre_array['role_id']; ?></td>
							<button class="btn btn-success" style="float:right;position:relative;top:78px;left:14%;" name="submit" type="submit" value="Supprimer" name="btn-delete"/>Supprimer</button>
						</form>
						<a href=javascript:history.go(-1)>Retour</a>
					</tbody>
				</table>
			</div>
		</body>
		</html>
