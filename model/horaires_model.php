<?php

function insert_horaire($data){
	require("../bdd.php");
	$mois = date("m");
	$annee = date("Y");
	$semaine = date("W");
	$req = $bdd->prepare('INSERT INTO horaires(start, pause, reprise, fin, jour, total_journee, total_semaine, total_mois, total_annee, annee, mois, semaine, id_users) VALUES (:start, :pause, :reprise, :fin, :jour, :total_journee, :total_semaine, :total_mois, :total_annee, :annee, :mois,:semaine, :id_users)');
	$req->execute(array(
		"start" => $data['now'],
		"pause" => '',
		"reprise" => '',
		"fin" => '',
		"jour" => $data['day'],
		"total_journee" => '',
		"total_semaine" => '',
		"total_mois" => '',
		"total_annee" => '',
		"semaine"=>$semaine,
		"mois" => $mois,
		"annee" => $annee,
		"id_users" => $data['id_users']
		));

	return $bdd->lastInsertId('id_horaire');
}

function update_pause($data){
	require("../bdd.php");
	$req2 = $bdd->prepare('UPDATE horaires SET pause = :pause WHERE id_horaire = :id_horaire');
	$req2->execute(array(
		"id_horaire" => $data['id_horaire'],
		"pause" => $data['pause']
		));
}

function update_reprise($data){
	require("../bdd.php");
	$req2 = $bdd->prepare('UPDATE horaires SET reprise = :reprise WHERE id_horaire = :id_horaire');
	$req2->execute(array(
		"id_horaire" => $data['id_horaire'],
		"reprise" => $data['reprise']
		));
}

function update_fin($data){
	require("../bdd.php");
	$req2 = $bdd->prepare('UPDATE horaires SET fin = :fin WHERE id_horaire = :id_horaire');
	$req2->execute(array(
		"id_horaire" => $data['id_horaire'],
		"fin" => $data['fin']
		));
}

function calcul_total_journee(){
	require("../bdd.php");
	$id_horaire = $_SESSION['id_horaire'];
	$req = $bdd->prepare("SELECT * FROM horaires WHERE id_horaire = :id_horaire");
	$req->execute(array(
		"id_horaire" => $id_horaire,
		));
	$res = $req->fetch();

	$time1=strtotime($res['start']);
	$time2=strtotime($res['pause']);
	$result=$time2-$time1;

	$time3=strtotime($res['reprise']);
	$time4=strtotime($res['fin']);
	$rest=$time4-$time3;

	$tab['result']= $result;
	$tab['rest']= $rest;
	$theend= new Datetime($res['reprise']);
	$cal = $result + $rest;
	$tab['cal'] = date('H:i:s',$cal-3600);
	$_SESSION[$tab['cal']];
	$tab_val=$tab['cal'];

	$req5 = $bdd->prepare('UPDATE horaires SET total_journee = :total_journee WHERE id_horaire = :id_horaire');
	$req5->execute(array(
		"id_horaire" => $id_horaire,
		"total_journee" => $tab_val
		));
}

function get_semaine(){
	require("../bdd.php");
	$id_horaire = $_SESSION['id_horaire'];
	$semaine = date("W");
	$req = $bdd->prepare('INSERT INTO horaires(semaine) VALUES :semaine');
	$req->execute(array(
		'semaine' => $semaine
	));
}

function get_mois(){
	require("../bdd.php");
	$id_horaire = $_SESSION['id_horaire'];
	$mois = date("m");
	$req = $bdd->prepare("INSERT INTO horaires(mois) VALUES :mois");
	$req->execute(array(
		'mois' => $mois
	));
}

function get_annee(){
	require("../bdd.php");
	$id_horaire = $_SESSION['id_horaire'];
	$annee = date("Y");
	$req = $bdd->prepare("INSERT INTO horaires(annee) VALUES :annee");
	$req->execute(array(
		'annee' => $annee
	));
}

function calcul_total_semaine(){
	require("../bdd.php");
	$id_horaire = $_SESSION['id_horaire'];
	$annee = date("Y");
	$semaine = date("W");

	$req = $bdd->prepare('SELECT SEC_TO_TIME( SUM( TIME_TO_SEC(`total_journee`) ) ) FROM horaires WHERE semaine = :semaine AND annee = :annee');
	$req->execute(array(
		'semaine' => $semaine,
		'annee' => $annee
		));
	$sumsemaine = $req->fetchColumn();
	$reqsemaine = $bdd->prepare('UPDATE horaires SET total_semaine = :total_semaine WHERE id_horaire = :id_horaire');
	$reqsemaine->execute(array(
		"id_horaire" => $id_horaire,
		"total_semaine" => $sumsemaine
	));
}
//page admin : modifier horaires / ajouter horaires pour les utilisateurs

function calcul_total_mois(){
	require("../bdd.php");
	$id_horaire = $_SESSION['id_horaire'];
	$mois = date("m");
	$annee = date("Y");

	$req2 = $bdd->prepare('SELECT SEC_TO_TIME( SUM( TIME_TO_SEC(`total_journee`) ) ) FROM horaires WHERE mois = :mois AND annee = :annee');
	$req2->execute(array(
		'mois' => $mois,
		'annee' => $annee
		));
	$summois = $req2->fetchColumn();
	$reqmois = $bdd->prepare('UPDATE horaires SET total_mois = :total_mois WHERE id_horaire = :id_horaire');
	$reqmois->execute(array(
		"id_horaire" => $id_horaire,
		"total_mois" => $summois
	));
}

function calcul_total_annee(){
	require("../bdd.php");
	$id_horaire = $_SESSION['id_horaire'];
	$mois = date("m");
	$annee = date("Y");

	$req3 = $bdd->prepare('SELECT SEC_TO_TIME( SUM( TIME_TO_SEC(`total_journee`) ) ) FROM `horaires` WHERE `annee` = :annee');
	$req3->execute(array(
		'annee'=>$annee
		));
	$sumannee = $req3->fetchColumn();

	$reqannee = $bdd->prepare('UPDATE horaires SET total_annee = :total_annee WHERE id_horaire = :id_horaire');
	$reqannee->execute(array(
		'id_horaire' => $id_horaire,
		'total_annee' => $sumannee
	));
}