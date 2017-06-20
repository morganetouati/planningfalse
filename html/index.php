<?php
$autoload = require '../vendor/autoload.php';
//resources css
$urlresource = "/planning/vendor/kalliste-sas/Planning/Resources/";
?>
<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo $urlresource; ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $urlresource; ?>css/style.css">
	<script type="text/javascript" src="<?php echo $urlresource; ?>js/jquery-3.1.1.min.js"/></script>
	<script src="<?php echo $urlresource; ?>js/bootstrap.min.js"></script>
	<title>Planning</title>
</head>
<body>
	<header>
		<h1>Bienvenue sur la plateforme de gestion de présence des employés</h1>
		<nav>
			<ul>
				<li><a href="index.php">Connexion</a></li>
				<li><a href="inscription.php">Inscription</a></li>
			</ul>
		</nav>
	</header>
	<div class="container">
		<h2>Connexion</h2>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-primary">
					<div class="panel-heading">Merci de vous connecter!</div>
					<div class="panel-body">
						<form action="../php/login.php" role="form" method="post">
							<label for="email">Email :</label>
							<input class="form-control" type="email" id="email" placeholder="Email" name="email" required/>
							<label for="password">Mot de passe :</label>
							<input class="form-control" type="password" id="password" placeholder="Mot de passe" name="password" required/>
							<input class="btn btn-primary m-t-10" type="submit" name="submitconnexion" value="Connexion" />
							<a href='forgot_pass.php'>Mot de passe oublié</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>