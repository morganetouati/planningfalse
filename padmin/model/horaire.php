<?php
require("../../bdd.php");
$horaires = $bdd->prepare("SELECT * FROM horaires WHERE id_users = :id");
$horaires->execute(array(
	':id' => $_GET['user']
	));
$horaire_array = $horaires->fetchAll();

?>