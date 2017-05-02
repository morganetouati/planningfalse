<?php
session_start();
require("../bdd.php");

if(isset($_POST['submitconnexion']))
{
	$mailco = htmlspecialchars($_POST['email']);
	$passco = sha1($_POST['password']);
	if(!empty($mailco) && !empty($passco))
	$req = $bdd->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
	$req->execute(array($mailco,$passco));
	$userexist = $req->rowCount();
	if ($userexist == 1)
	{
		$userinfo = $req->fetch();
		$_SESSION['id_users'] = $userinfo['id_users'];
		$_SESSION['email'] = $userinfo['email'];
		header("Location: ../html/profil.php");
	}
	else{
		echo "Mauvais email ou mauvais mot de passe. Merci de recommencer !";
		echo "<a href='../html/index.php'>Retour a la page de connexion.</a>";
	}
}
else
{
	echo "Remplissez tous les champs pour vous connectez !";
}
?>