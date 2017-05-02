<?php
session_start();

require('../model/horaires_model.php');
require("../bdd.php");
if (!isset($_SESSION['id_users'])) {
	header ('Location: ../html/index.php');
	exit();
}

$start=$_POST['start'];
$pause=$_POST['pause'];
$reprise=$_POST['reprise'];
$fin=$_POST['fin'];
$data['id_users'] = $_SESSION['id_users'];
$data['now'] = date("Y-m-d H:i:s");
$data['day'] = date("Y-m-d");
$_SESSION['day'] = $data['day'];
$data['pause'] = date("Y-m-d H:i:s");
$data['reprise'] = date("Y-m-d H:i:s");
$data['fin'] = date("Y-m-d H:i:s");

if (isset($start)) {
	$id_horaire = insert_horaire($data);
	$_SESSION['id_horaire'] = $id_horaire;
	get_semaine();
	get_mois();
	get_annee();
}

if(isset($pause)) {
	$data['id_horaire'] = $_SESSION['id_horaire'];
	update_pause($data);
}
if(isset($reprise)) {
	$data['id_horaire'] = $_SESSION['id_horaire'];
	update_reprise($data);
}
if(isset($fin)) {
	$data['id_horaire'] = $_SESSION['id_horaire'];
	update_fin($data);
	calcul_total_journee();
	calcul_total_semaine();
	calcul_total_mois();
	calcul_total_annee();
}
header("Location: ../html/horaires.php");