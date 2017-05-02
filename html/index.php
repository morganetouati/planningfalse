<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/style.css">
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
	<h2>Connexion</h2>
	<form action="../php/login.php" method="post">
		<label for="email">Email :</label>
		<input type="email" id="email" placeholder="Email" name="email" required/>
		<label for="password">Mot de passe :</label>
		<input type="password" id="password" placeholder="Mot de passe" name="password" required/>
		<input type="submit" name="submitconnexion" value="Connexion" />
		<a href='forgot_pass.php'>Mot de passe oublié</a>
	</form>
</body>
</html>