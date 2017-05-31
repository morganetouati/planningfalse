<?php
include("../../bdd.php");

$libelle = $_POST['libelle'];
$selstatut = $bdd->prepare('SELECT id,libelle FROM `role`');
$selstatut->execute(array(
	"id" => $id,
	"libelle"=>$libelle
	)
);
$sel = $selstatut->fetchAll();
?>