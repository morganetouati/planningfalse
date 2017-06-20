<?php
$autoload = require '../../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();

$libelle = $_POST['libelle'];
if(isset($_POST['submit']))
{
	$req = $bdd->prepare('INSERT INTO role(libelle) VALUES (:libelle)');
	$req->execute(array(
		"libelle"=>$libelle
		)
	);
}
header("Location: ../view/statut.php");
?>