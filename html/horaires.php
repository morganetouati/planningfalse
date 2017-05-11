<?php
session_start();
require("../bdd.php");
require('../model/horaires_model.php');

if (!isset($_SESSION['id_users'])) {
	header ('Location: index.php');
	exit();
}

$req = $bdd->prepare("SELECT id_horaire,start,pause,reprise,fin,jour,total_journee,total_semaine,total_mois,total_annee, mois, semaine, annee, id_users FROM horaires WHERE id_users = :id_users ORDER BY start");

$req->execute([
	"id_users" => $_SESSION['id_users'],
	]);

$reqs = $req->fetchAll();

$lastDateInDb = $reqs[count($reqs) - 1];

function currentDayAlreadyInDb($date)
{
	global $reqs;
	$currentDate = new DateTime();
	foreach ($reqs as $value => $item)
	{
		if (date_format($currentDate, 'Y-m-d') == date_format(new DateTime($item["start"]), 'Y-m-d'))
		{
			return true;
			break;
		}
	}
	return false;
}

?>

<!Doctype html> 
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<title>Planning</title>
</head>
<body>
	<header>
		<h1>Bienvenue sur la plateforme de gestion de présence des employés</h1>
		<nav>
			<ul>
				<li><a href="profil.php">Mon profil</a></li>
				<li><a href="calendrier.php">Calendrier</a></li>
				<li><a href="deconnexion.php">Déconnexion</a></li>
			</ul>
		</nav>
	</header>
	<div class="container">
		<h2>Pointeuse horaire</h2>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Un petit clic pour vous signaler? ;)</div>
					<div class="panel-body">
						<form id="horaire" role="form" action="../php/time.php" method="post">
							<label for="start">Début</label>
							<button class="btn btn-primary m-t-10" type="submit" name="start" value="start" <?php if (currentDayAlreadyInDb($lastDateInDb)){echo "disabled=disabled";}?>>Début arrivée normale</button>
							<label for="hformation">Horaire formation</label>
							<button class="btn btn-primary m-t-10" type="submit" name="hformation" value="heure formation">Horaire formation</button>
							<label for="hmajoré">Horaire majoré</label>
							<button class="btn btn-primary m-t-10" type="submit" name="hmajore" value="heure majore">Horaire majorée</button>
							<label  for="hsupp">Horaire Supplementaire</label>
							<button class="btn btn-primary m-t-10" type="submit" name="hsupplementaire" value="heure supplementaire">Horaire supplementaire</button>
							<label for="pause">Horaire de pause</label>
							<button class="btn btn-primary m-t-10" type="submit" name="pause" value="pause">Pause</button>
							<label for="reprise">Horaire de reprise</label>
							<button class="btn btn-primary m-t-10" type="submit" name="reprise" value="reprise">Reprise</button>
							<label for="fin">Fin de journée</label>
							<button class="btn btn-primary m-t-10" type="submit" name="fin" value="fin">Fin</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="" class="col-6 col-md-6">
		<table id="heure" class="table table-hover">
			<tr>
				<th>total heure normal</th>
				<th>total heure semaine</th>
				<th>total heure majoré</th>
				<th>total formation</th>
			</tr>
		</table>
	</div>

	<div class="col-6 col-md-6">
		<table id="heure2" class="table table-hover">
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
			<?php
			foreach ($reqs as $k => $v) {
				echo'<tr>';
				echo '<td>'.$v['start'].'</td>';
				echo '<td>'.date('H:i:s',strtotime($v['pause'])).'</td>';
				echo '<td>'.date('H:i:s',strtotime($v['reprise'])).'</td>';
				echo '<td>'.date('H:i:s',strtotime($v['fin'])).'</td>';
				echo '<td>'.date('H:i:s',strtotime($v['total_journee'])).'</td>';
				echo '<td>'.$v['total_semaine'].'</td>';
				echo '<td>'.$v['total_mois'].'</td>';
				echo '<td>'.$v['total_annee'].'</td>';
				echo '</tr>';
			}
			echo '<p style="display: block; margin-top: -53%;">Vos horaires ont bien été enregistrés pour le jour : '.$v['jour'].'</p>';
			?>
		</table>
	</div>

</body>
</html>