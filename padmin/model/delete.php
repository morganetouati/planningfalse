<?php
$autoload = require '../../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();

$id = $_POST['id'];
$membre = $bdd->prepare("DELETE FROM users WHERE id_users = :id");
$membre->execute(array(':id' => $id));
header("Location: ../index.php");
?>