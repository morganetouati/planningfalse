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

						<form method="post" action="../model/edit.php">
							<td width="20%"><?php echo $membre_array['id_users']; ?></td>
							<input type="hidden" name="id" value="<?php echo $membre_array['id_users']; ?>" />
							<td width="20%"><input type="text" name="nom" value="<?php echo $membre_array['nom']; ?>" /></td>
							<td width="20%"><input type="text" name="prenom" value="<?php echo $membre_array['prenom']; ?>" /></td>
							<td width="20%"><input type="date" name="start_contrat" value="<?php echo $membre_array['start_contrat']; ?>" /></td>
							<td width="20%"><input type="date" name="end_contrat" value="<?php echo $membre_array['end_contrat']; ?>" /></td>
							<td width="20%"><input type="text" name="heure_semaine" value="<?php echo $membre_array['heure_semaine']; ?>" /></td>
							<td width="20%"><input type="text" name="salaire_brut" value="<?php echo $membre_array['salaire_brut']; ?>" /></td>
							<td width="20%"><input type="text" name="salaire_net" value="<?php echo $membre_array['salaire_net']; ?>" /></td>
							<td width="20%"><input type="text" name="societe" value="<?php echo $membre_array['societe']; ?>" /></td>
							<td width="20%"><input type="text" name="role" value="<?php echo $membre_array['role_id']; ?>" /></td>
							<td><button class="btn btn-success" style="float:right;position:relative;" name="submitprofil" type="submit" value="Modifier" />Modifier</button></td>
						</form>
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
					?>
					<tr>
                        <?php
                        foreach ($horaire_array as $v) {
                        	echo'<td style="display:none;"><input type="text" name="mois" value="'.$v['mois'].'" /></td>';
                            echo'<td style="display:none;"><input type="text" name="annee" value="'.$v['annee'].'" /></td>';
                            echo'<td style="display:none;"><input type="text" name="semaine" value="'.$v['semaine'].'" /></td>';
                            echo'<td style="display:none;"><input type="text" name="id_horaire" value="'.$v['id_horaire'].'" /></td>';
                            echo'<td style="display:none;"><input type="text" name="id_users" value="'.$v['id_users'].'" /></td>';
                            echo'<td width="20%"><input type="text" name="start" value="'.$v['start'].'" /></td>';
                            echo'<td width="20%"><input type="text" name="pause" value="'.$v['pause'].'" /></td>';
                            echo'<td width="20%"><input type="text" name="reprise" value="'.$v['reprise'].'" /></td>';
                            echo'<td width="20%"><input type="text" name="fin" value="'.$v['fin'].'" /></td>';
                            echo'<td width="20%"><input type="text" name="total_journee" value="'.$v['total_journee'].'" /></td>';
                            echo'<td width="20%"><input type="text" name="total_semaine" value="'.$v['total_semaine'].'" /></td>';
                            echo'<td width="20%"><input type="text" name="total_mois" value="'.$v['total_mois'].'" /></td>';
                            echo'<td width="20%"><input type="text" name="total_annee" value="'.$v['total_annee'].'" /></td>';
                            ?>
                            <td><button class="btn btn-success modify-row" style="float:right;position:relative;" value="Modifier" />Modifier</button></td>
							<td><button class="btn btn-danger delete-row" style="float:right;position:relative;" value="Supprimer" />Supprimer</button></td>
                        </tr>

                    <?php } ?>
						<a href=javascript:history.go(-1)>Retour</a>
					</tbody>
				</table>
			</div>
		</body>
        <script>
            $(".modify-row").on("click", function()
            {
                var $input = $(this).closest("tr").find(":input").serialize();
                $.ajax({
                    url: "../model/edithoraires.php",
                    type: "POST",
                    data: $input,
                    complete : function(resultat, statut){
                        window.location.reload();
                    }
                });
            });
            $(".delete-row").on("click", function()
            {
                var $input = $(this).closest("tr").find(":input").serialize();
                $.ajax({
                    url: "../model/deletehoraires.php",
                    type: "POST",
                    data: $input,
                    complete : function(resultat, statut){
                        window.location.reload();
                    }
                });
            })
        </script>
		</html>