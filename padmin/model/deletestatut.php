<?php
include("../../bdd.php");
$id = $_POST['id'];
$libelle = $_POST['libelle'];
$delstatut = $bdd->prepare('DELETE FROM `role` WHERE id = ? ');
$delstatut->execute(array(':id' => $id));
header("Location: ../view/statut.php");
?>