<?php
$autoload = require '../../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();

$horaires = $bdd->prepare("SELECT * FROM horaires WHERE id_users = :id");
$horaires->execute(array(
	':id' => $_GET['user']
	));
$horaire_array = $horaires->fetchAll();

?>