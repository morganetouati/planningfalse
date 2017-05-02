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
				<li><a href="inscription.php">Inscription</a></li>
				<li><a href="index.php">Connexion</a></li>
			</ul>
		</nav>
	</header>
	<h2>Mot de passe oublié</h2>
	<form action="../php/forgotpassword.php" method="post">
		<label for="email">E-mail du contact</label>
		<input type="email" id="email" name="email" required/>
		<label for="newpassword">Nouveau mot de passe</label>
		<input type="password"  id="newpassword" name="newpassword" required/>
		<label for="confirmpass">Confirmez votre nouveau mot de passe</label>
		<input type="password" id="confirmpass" name="confirmpass" required/>
		<input type="submit" name="submit" value="Sauvegarder"/>
	</form>
</body>
</html>