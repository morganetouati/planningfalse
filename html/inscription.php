<?php
require("../bdd.php");
$req = $bdd->prepare("SELECT id, libelle FROM role");
$req->execute();
$roles = $req->fetchAll();
?>

<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript" src="../js/jquery-3.1.1.min.js"/></script>
	<script src="../js/bootstrap.min.js"></script>
	<title>Planning</title>
</head>
<body>
	<header>
		<h1>Bienvenue sur la plateforme de gestion de présence des employés</h1>
		<nav>
			<ul>
				<li><a href="inscription.php">Inscription</a></li>
				<li><a href="index.php">Connexion</a></li>
			</ul>
		</nav>
	</header>
	<div class="container">
		<h2>Inscription</h2>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-primary">
					<div class="panel-heading">Merci de vous inscrire!</div>
					<div class="panel-body">
						<form action="../php/signup.php" role="form" method="post">
							<label for="nom">Nom :</label>
							<input class="form-control" type="text" id="nom" name="nom" placeholder="Example: Dupont" required/>
							<label for="prenom">Prénom :</label>
							<input class="form-control" type="text" id="prenom" placeholder="Example: James" name="prenom" required/>
							<label for="email">Email :</label>
							<input class="form-control" type="email" id="email" placeholder="Example: test@gmail.com" name="email" required/>
							<label for="password">Mot de passe :</label>
							<input class="form-control" type="password" id="password" placeholder="Example: motdepasse" name="password" required/>
							<label for="start_contrat">Début du contrat :</label>
							<input class="form-control" type="date" id="start_contrat" placeholder="Example: 00/00/0000" name="start_contrat" required/>
							<label for="end_contrat">Fin du contrat :</label>
							<input class="form-control" type="date" id="end_contrat" placeholder="Example: 00/00/0000" name="end_contrat" required/>
							<label for="heure_semaine">Heure par semaine :</label>
							<input class="form-control" type="number" id="heure_semaine" placeholder="Example: 00" name="heure_semaine" required/>
							<label for="salaire_brut">Salaire brut :</label>
							<input class="form-control" type="number" id="salaire_brut" placeholder="Example: 0000" name="salaire_brut" required/>
							<label for="salaire_net">Salaire net :</label>
							<input class="form-control" type="number" id="salaire_net" placeholder="Example: 0000" name="salaire_net" required/>
							<label class="m-t-10" for="societe">Societe</label>
							<select class="form-control" name="societe">
								<option value="MUNCI(Issy)">MUNCI (Issy)</option>
								<option value="MUNCI(Paris)">MUNCI (Paris)</option>
								<option value="DIGIFORM">DIGIFORM</option>
								<option value="SAS KALLISTE">SAS KALLISTE</option>
								<option value="SPECIS-UNSA">SPECIS-UNSA</option>
							</select>
							<label class="m-t-10" for="role">Statut</label>
							<select class="form-control" name="role">
								<?php
								foreach ($roles as $role)
								{
									echo '<option value="'.$role["id"] .'">'.$role['libelle'].'</option>';
								}
								?>
							</select>
							<input type="submit" class="btn btn-primary m-t-10" name="submit" value="Inscription"/>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>