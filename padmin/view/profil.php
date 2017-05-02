<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
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
						<td width="20%"><?php echo $membre_array['nom']; ?></td>
						<td width="20%"><?php echo $membre_array['prenom']; ?></td>
						<td width="20%"><?php echo $membre_array['start_contrat']; ?></td>
						<td width="20%"><?php echo $membre_array['end_contrat']; ?></td>
						<td width="20%"><?php echo $membre_array['heure_semaine']; ?></td>
						<td width="20%"><?php echo $membre_array['salaire_brut']; ?></td>
						<td width="20%"><?php echo $membre_array['salaire_net']; ?></td>
						<td width="20%"><?php echo $membre_array['societe']; ?></td>
						<td width="20%"><?php echo $membre_array['role_id']; ?></td>
						<!-- <a href=javascript:history.go(-1)>Retour</a> -->
					</tr>
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
					<?php
					include('../model/horaire.php');
					foreach ($horaire_array as $k => $v) {
						echo'<tr>';
						echo '<td>'.$v['start'].'</td>';
						echo '<td>'.date('H:i:s',strtotime($v['pause'])).'</td>';
						echo '<td>'.date('H:i:s',strtotime($v['reprise'])).'</td>';
						echo '<td>'.date('H:i:s',strtotime($v['fin'])).'</td>';
						echo '<td>'.date('H:i:s',strtotime($v['total_journee'])).'</td>';
						echo '<td>'.$v['total_semaine'].'</td>';
						echo '<td>'.$v['total_mois'].'</td>';
						echo '<td>'.$v['total_annee'].'</td>';
						echo '</tr>';
					}
					?>
					<a href=javascript:history.go(-1)>Retour</a>
				</tbody>
			</table>
		</div>
	</body>
</html>