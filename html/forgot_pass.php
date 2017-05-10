<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../js/jquery-3.1.1.min.js"/></script>
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
		<h2>Mot de passe oublié</h2>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-primary">
					<div class="panel-heading">Mot de passe oublié?</div>
					<div class="panel-body">
	<form action="../php/forgotpassword.php" role="form" method="post">
		<label for="email">E-mail du contact</label>
		<input class="form-control" type="email" id="email" name="email" required/>
		<label for="newpassword">Nouveau mot de passe</label>
		<input class="form-control" type="password"  id="newpassword" name="newpassword" required/>
		<label for="confirmpass">Confirmez votre nouveau mot de passe</label>
		<input class="form-control" type="password" id="confirmpass" name="confirmpass" required/>
		<input class="btn btn-primary m-t-10" type="submit" name="submit" value="Sauvegarder"/>
	</form>
</body>
</html>