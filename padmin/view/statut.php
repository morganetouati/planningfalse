<?php include("../model/selectstatut.php");?>
<?php include("../model/deletestatut.php");?>
<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="../../css/style.css" type="text/css">
	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<title>Planning</title>	
</head>
<body>
	<header>
		<h1>Panel admin</h1>
		<nav>
			<ul>
				<li><a href=javascript:history.go(-1)>Retour</a></li>
				<!-- <li><a href="view/deconnexion.php">Se déconnecter</a></li> -->
			</ul>
		</nav>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">Liste des statuts déjà existant</div>
						<div class="panel-body">
							<?php
							foreach ($sel as $k => $v) {
								echo '<p>'.$v['libelle'].'</p>';
								echo '<a href="../model/deletestatut.php?id='.$v['id'].'">X</a>';
							}
							?>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">Ajouter un statut</div>
						<div class="panel-body">
							<form action="../model/statutmodel.php" role="form" method="post">
								<input class="form-control" type="text" id="libelle" name="libelle" placeholder="Exemple: développeur" required/>
								<input class="btn btn-primary m-t-10" type="submit" name="submit" value="Ajouter"/>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>