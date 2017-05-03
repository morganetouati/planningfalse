<?php
// if (isset($_POST['submit'])) {
	require("../../bdd.php");
	$id = $_POST['id'];
	$membre = $bdd->prepare("DELETE FROM users WHERE id_users = :id");
	$membre->execute(array(':id' => $id));
	echo "L'utilisateur à bien été supprimé";
	header("Location: ../index.php");
// }
?>