<?php
$autoload = require '../../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();

$libelle = $_POST['libelle'];
$selstatut = $bdd->prepare('SELECT id,libelle FROM `role`');
$selstatut->execute(array(
	"id" => $id,
	"libelle"=>$libelle
	)
);
$sel = $selstatut->fetchAll();
?>