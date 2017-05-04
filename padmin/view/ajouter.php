<?php
require("../../bdd.php");
$req = $bdd->prepare("SELECT id, libelle FROM role");
$req->execute();
$roles = $req->fetchAll();
?>

<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<script type="text/javascript" src="../../js/jquery-3.1.1.min.js"/></script>
	<title>Panel Admin</title/>
	</head>
	<body>
		<header>
			<h1>Panel Admin</h1>
			<h2>Ajouter un utilisateur</h2>
		</header>
		<div class="col-md-10" style="display:inline-block;">
			<h2>Ajouter un utilisateur</h2>
			<form action="../model/add_users.php" method="post">
				<label for="nom">Nom :</label>
				<input type="text" id="nom" name="nom" required/>
				<label for="prenom">Prénom :</label>
				<input type="text"  id="prenom" name="prenom" required/>
				<label for="email">Email :</label>
				<input type="email" id="email" name="email" required/>
				<label for="password">Mot de passe :</label>
				<input type="password" id="password" name="password" required/>
				<label for="start_contrat">Début du contrat :</label>
				<input type="date" id="start_contrat" name="start_contrat" required/>
				<label for="end_contrat">Fin du contrat :</label>
				<input type="date" id="end_contrat" name="end_contrat" required/>
				<label for="heure_semaine">Heure par semaine :</label>
				<input type="number" id="heure_semaine" name="heure_semaine" required/>
				<label for="salaire_brut">Salaire brut :</label>
				<input type="number" id="salaire_brut" name="salaire_brut" required/>
				<label for="salaire_net">Salaire net :</label>
				<input type="number" id="salaire_net" name="salaire_net" required/>
				<label for="societe">Societe</label>
				<select name="societe">
					<option value="MUNCI(Issy)">MUNCI (Issy)</option>
					<option value="MUNCI(Paris)">MUNCI (Paris)</option>
					<option value="DIGIFORM">DIGIFORM</option>
					<option value="SAS KALLISTE">SAS KALLISTE</option>
					<option value="SPECIS-UNSA">SPECIS-UNSA</option>
				</select>
				<label for="role">Statut</label>
				<select name="role">
					<?php
					foreach ($roles as $role)
					{
						echo '<option value="'.$role["id"] .'">'.$role['libelle'].'</option>';
					}
					?>
				</select>
				<input type="submit" name="submit" value="Inscription"/>
			</form>
			<a href=javascript:history.go(-1)>Retour</a>
		</div>
	</body>
	</html>