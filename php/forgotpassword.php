<?php
session_start();
require("../bdd.php");

$mailco = $_POST['email'];
$newpassword = sha1($_POST['newpassword']);
$confirmpass = sha1($_POST['confirmpass']);

if($_POST['submit'])
{
	if ($newpassword == $confirmpass)
	{
		$req = $bdd->prepare('UPDATE users SET password = :newpassword WHERE email = :mailco');
		$req->execute(array(':newpassword' => $newpassword, ':mailco' => $mailco));

	echo "Votre nouveau mot de passe a bien été enregistré, veuillez - vous connecter.<br>";
		echo"<a href='../html/index.php'>Connexion</a>";
	}
	if ($newpassword !== $confirmpass)
	{
		echo "Les deux mots de passe sont differents !";
		echo"<a href='../html/forgot_pass.php'>Retour au formulaire de mot de passe oublié</a>";
	}
}
?>