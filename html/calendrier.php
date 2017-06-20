<?php
session_start();
$autoload = require '../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();
//resources css
$urlresource = "/planning/vendor/kalliste-sas/Planning/Resources/";
if (!isset($_SESSION['id_users'])) {
	header ('Location: index.php');
	exit();
}
?>
<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo $urlresource; ?>css/style.css">
	<title>Planning</title>
</head>
<body>
	<header>
		<h1>Bienvenue sur la plateforme de gestion de présence des employés</h1>
		<nav>
			<ul>
				<li><a href="profil.php">Mon profil</a></li>
				<li><a href="../php/logout.php">Déconnexion</a></li>
			</ul>
		</nav>
	</header>
	<h2>Calendrier</h2>
	<?php

	$mois = date("m");
	$anne = date("Y");
	?>
	<div id="fleche">
		<img id="pre" src="<?php echo $urlresource; ?>css/flep.png">
		<img id="post" src="<?php echo $urlresource; ?>css/flep2.png">
	</div>

	<div id="cont" >

	</div>

	<script src="<?php echo $urlresource; ?>js/jquery-3.1.1.min.js"></script>
	<script>

	var mois = <?php echo $mois;?>;

	var anne = <?php echo $anne;?>;

	$(document).ready(function(){


		$("#cont").load("calendrier_vue.php?mois="+mois+"&anne="+anne,function(){});


		$("#pre").click(function(){

			mois--;

			if(mois < 1)
			{
				anne--;
				mois = 12;
			}
			$("#cont").load("calendrier_vue.php?mois="+mois+"&anne="+anne,function(){});

		});

		$("#post").click(function(){

			mois++;

			if(mois > 12)
			{
				anne++;
				mois = 1;
			}

			$("#cont").load("calendrier_vue.php?mois="+mois+"&anne="+anne,function(){});
		});
	});
	</script>
</body>
</html>