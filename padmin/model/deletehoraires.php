<?php
	require("../../bdd.php");
	// $id = $_POST['id_users'];
	$id_horaire = $_POST['id_horaire'];
	$delhoraire = $bdd->prepare("DELETE FROM horaires WHERE id_horaire = :id_horaire");
	$delhoraire->execute(array(
		// ':id' => $id,
		':id_horaire' => $id_horaire
		));
	header("Location: ../index.php");
?>