<?php
$autoload = require '../../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();
$id_horaire = $_POST['id_horaire'];
$delhoraire = $bdd->prepare("DELETE FROM horaires WHERE id_horaire = :id_horaire");
$delhoraire->execute(array(
	':id_horaire' => $id_horaire
	));
header("Location: ../index.php");
?>