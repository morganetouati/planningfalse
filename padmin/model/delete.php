<?php
require("../../bdd.php");
$id = $_POST['id'];
$membre = $bdd->prepare("DELETE FROM users WHERE id_users = :id");
$membre->execute(array(':id' => $id));
header("Location: ../index.php");
?>