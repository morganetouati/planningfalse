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
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js" ></script>
	<script src="../js/jquery-3.1.1.min.js"></script>
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
	<div id="global" style="width: 100%;">
		<form id="horaire" action="../php/time.php" method="post">
			<div class="form-group">
			<label for="start">Début</label>
			<button type="submit" name="start" value="start" <?php if (currentDayAlreadyInDb($lastDateInDb)){echo "disabled=disabled";}?>>Début arrivée normale</button>
			<label for="hformation">Horaire formation</label>
			<button type="submit" name="hformation" value="heure formation">Horaire formation</button>
			<label for="hmajoré">Horaire majoré</label>
			<button type="submit" name="hmajore" value="heure majore">Horaire majore</button>
			<label for="hsupp">Horaire Supplementaire</label>
			<button type="submit" name="hsupplementaire" value="heure supplementaire">Horaire supplementaire</button>
			<label for="pause">Horaire de pause</label>
			<button type="submit" name="pause" value="pause">Pause</button>
			<label for="reprise">Horaire de reprise</label>
			<button type="submit" name="reprise" value="reprise">Reprise</button>
			<label for="fin">Fin de journée</label>
			<button type="submit" name="fin" value="fin">Fin</button>
		</div>
		</form>
		<div class="col-12 col-md-auto">
			<table id="heure" class="table table-hover">
				<tr>
					<th>total heure normal</th>
					<th>total heure semaine</th>
					<th>total heure majoré</th>
					<th>total formation</th>
				</tr>
			</table>
		</div>

		<div class="col-12 col-md-auto">
			<table id="heure" class="table table-hover">
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
				echo '<p style="margin-top: 32px;">Vos horaires ont bien été enregistrés pour le jour : '.$v['jour'].'</p>';
				?>
			</table>
		</div>
	</div>
</body>
</html>