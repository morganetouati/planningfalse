<?php
session_start();
require("../bdd.php");

if(isset($_POST['submitconnexion']))
{
	$mailco = $_POST['email'];
	$passco = sha1($_POST['password']);
	if(!empty($mailco) && !empty($passco))
		$req = $bdd->prepare("SELECT users.*, role.libelle as role FROM users INNER JOIN role ON role.id = users.role_id WHERE email = ? AND password = ?");
	$req->execute(array($mailco,$passco));
	$userexist = $req->rowCount();
	if ($userexist == 1)
	{
		$userinfo = $req->fetch();
		$_SESSION['id_users'] = $userinfo['id_users'];
		$_SESSION['role'] = $userinfo['role'];
		$_SESSION['email'] = $userinfo['email'];
		$_SESSION['password'] = $userinfo['password'];
		if ($userinfo['role'] != 'admin') {
			header("Location: ../html/profil.php");
		}
		elseif ($userinfo['role'] == 'admin') {
			header("Location: ../padmin/index.php");
		}
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