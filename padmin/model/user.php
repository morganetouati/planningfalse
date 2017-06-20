<?php
$autoload = require '../../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();

$membre = $bdd->prepare("SELECT users.*, role.libelle as role FROM users INNER JOIN role ON role.id = role_id WHERE id_users = :id");
$membre->execute(array(
	':id' => $_GET['user']
	));
$membre_array = $membre->fetch(PDO::FETCH_ASSOC);