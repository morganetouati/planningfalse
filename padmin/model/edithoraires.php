<?php
$autoload = require '../../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();

class times_counter {

	private $hou = 0;
	private $min = 0;
	private $sec = 0;
	private $totaltime = '00:00:00';

	public function __construct($times){
		
		if(is_array($times)){

			$length = sizeof($times);

			for($x=0; $x <= $length; $x++){
				$split = explode(":", @$times[$x]); 
				$this->hou += @$split[0];
				$this->min += @$split[1];
				$this->sec += @$split[2];
			}

			$seconds = $this->sec % 60;
			$minutes = $this->sec / 60;
			$minutes = (integer)$minutes;
			$minutes += $this->min;
			$hours = $minutes / 60;
			$minutes = $minutes % 60;
			$hours = (integer)$hours;
			$hours += $this->hou;
			$this->totaltime = $hours.":".$minutes.":".$seconds;
		}
	}

	public function get_total_time(){
		return $this->totaltime;
	}

}

// function calcul_total_heure_normale($start, $pause, $reprise, $fin){

// 	$time1=strtotime($start);
// 	$time2=strtotime($pause);
// 	$result=$time2-$time1;

// 	$time3=strtotime($reprise);
// 	$time4=strtotime($fin);
// 	$rest=$time4-$time3;

// 	$tab['result']= $result;
// 	$tab['rest']= $rest;
// 	$theend= new Datetime($reprise);
// 	$cal = $result + $rest;
// 	$tab['cal'] = date('H:i:s',$cal-3600);
// 	$_SESSION[$tab['cal']];
// 	$tab_val=$tab['cal'];

// 	return $tab_val;
// }

function get_semaine(){
	$autoload = require '../vendor/autoload.php';
	$connect = new Planning_Bdd_Connect();
	$bdd = $connect->getPdo();
	$id_horaire = $_SESSION['id_horaire'];
	$semaine = date("W");
	$req = $bdd->prepare('INSERT INTO horaires(semaine) VALUES :semaine');
	$req->execute(array(
		'semaine' => $semaine
		));
}

function get_mois(){
	$autoload = require '../vendor/autoload.php';
	$connect = new Planning_Bdd_Connect();
	$bdd = $connect->getPdo();
	$id_horaire = $_SESSION['id_horaire'];
	$mois = date("m");
	$req = $bdd->prepare("INSERT INTO horaires(mois) VALUES :mois");
	$req->execute(array(
		'mois' => $mois
		));
}

function get_annee(){
	$autoload = require '../vendor/autoload.php';
	$connect = new Planning_Bdd_Connect();
	$bdd = $connect->getPdo();
	$id_horaire = $_SESSION['id_horaire'];
	$annee = date("Y");
	$req = $bdd->prepare("INSERT INTO horaires(annee) VALUES :annee");
	$req->execute(array(
		'annee' => $annee
		));
}

function calcul_total_semaine($annee, $semaine, $id_horaire, $cjournee){
	$autoload = require '../vendor/autoload.php';
	$connect = new Planning_Bdd_Connect();
	$bdd = $connect->getPdo();
    // On recupere les horaire
	$tab_val = $bdd->prepare('SELECT * FROM horaires WHERE semaine = :semaine AND annee = :annee');
	$tab_val->execute(array(
		':semaine'=> $semaine,
		':annee' => $annee
		)
	);
	$values = [];
	while($row=$tab_val->fetch(PDO::FETCH_OBJ)) {
        // On recupere les totaux journaliers de la semaine sauf celui qu'on a modifié
		if ($row->id_horaire != $id_horaire)
		{
			$values[] = $row->total_heure_normale;
		}
	}
    // On rajoute celui qu'on a calculé précédemment
	$values[] = $cjournee;
    // On additionne les totaux journaliers
	$counter = new times_counter($values);
	return $counter->get_total_time();
}

function calcul_total_mois($mois, $annee, $id_horaire, $cjournee){
	$autoload = require '../vendor/autoload.php';
	$connect = new Planning_Bdd_Connect();
	$bdd = $connect->getPdo();
	// recup des horaires sur le mois et annee
	$reqselect = $bdd->prepare('SELECT * FROM horaires WHERE mois = :mois AND annee = :annee');
	$reqselect->execute(array(
		':mois' => $mois,
		':annee' => $annee
		)
	);
	$tabrecup = [];
	while ($row=$reqselect->fetch(PDO::FETCH_OBJ)) {
		if ($row->id_horaire != $id_horaire) 
		{
			$tabrecup[] = $row->total_heure_journee;
		}
	}
	$tabrecup[] = $cjournee;
	$counter = new times_counter($tabrecup);
	return $counter->get_total_time();
}

function calcul_total_annee($annee,$id_horaire,$cjournee){
	$autoload = require '../vendor/autoload.php';
	$connect = new Planning_Bdd_Connect();
	$bdd = $connect->getPdo();
	$selectannee = $bdd->prepare('SELECT * FROM horaires WHERE annee = :annee');
	$selectannee->execute(array(
		':annee' => $annee
		)
	);
	$recupdonnees = [];
	while ($row=$selectannee->fetch(PDO::FETCH_OBJ)) {
		if ($row->id_horaire != $id_horaire) {
			$recupdonnees[] = $row->total_heure_normale;
		}
	}
	$recupdonnees[] = $cjournee;
	$counter = new times_counter($recupdonnees);
	return $counter->get_total_time();
	
}

$id = $_POST['id_users'];
$id_horaire = $_POST['id_horaire'];
$start = $_POST['start'];
$pause = $_POST['pause'];
$reprise = $_POST['reprise'];
$fin = $_POST['fin'];
$total_heure_normal = $_POST['total_heure_normale'];
$total_semaine = $_POST['total_semaine'];
$total_mois = $_POST['total_mois'];
$total_annee = $_POST['total_annee'];
$annee = $_POST['annee'];
$semaine = $_POST['semaine'];
$mois = $_POST['mois'];

$cjournee = Planning_ModelHelper::calcul_temps_general($start, $pause, $reprise, $fin);
$csemaine = calcul_total_semaine($annee, $semaine, $id_horaire, $cjournee);
$cmois = calcul_total_mois($mois, $annee, $id_horaire, $cjournee);
$cannee = calcul_total_annee($annee, $id_horaire, $cjournee);

$updatehoraire = $bdd->prepare("UPDATE horaires SET start = :start, pause = :pause, reprise = :reprise,
	fin = :fin, total_heure_normale = :total_heure_normale, total_semaine = :total_semaine, total_mois = :total_mois, total_annee = :total_annee
	WHERE id_horaire = :id_horaire AND id_users = :id");

$updatehoraire->execute(array(
	':id' => $id,
	':id_horaire' => $id_horaire,
	':start' => $start,
	':pause' =>$pause,
	':reprise' => $reprise,
	':fin' => $fin,
	':total_heure_normale' => $total_heure_normal,
	':total_semaine' => $csemaine,
	':total_mois' => $cmois,
	':total_annee' => $cannee
	));
