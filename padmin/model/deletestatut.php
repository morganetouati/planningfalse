<?php
$autoload = require '../../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();
$id = $_GET['id'];

$delstatut = $bdd->prepare("DELETE FROM role WHERE id=:id");
$delstatut->bindParam(":id",$id,PDO::PARAM_INT);
$delstatut->execute();
header("Location: ../view/statut.php");
?>