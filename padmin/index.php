<?php
session_start(); 
require("../bdd.php");
$membre = $bdd->query("SELECT * FROM users");
?>

<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<title>Panel Admin</title>
</head>
<body>
	<h1>Panel Admin</h1>
<ul>
	<a href="view/ajouter.php">Ajouter</a>
	<a href="view/deconnexion.php">Se Déconnecter</a>
	<?php
		while ($m = $membre->fetch())  {?>
			<li><?= $m['id_users'] ?> : <?= $m['prenom'] ?> -
				<a href="view/profil.php?user=<?=$m['id_users'] ?>">View</a> -
				<a href="view/modifier.php?user=<?=$m['id_users'] ?>">Modifier</a> -
				<a href="view/supprimer.php?user=<?=$m['id_users'] ?>">Supprimer</a>
			</li>
		<?php } ?>
</ul>
</body>
</html>