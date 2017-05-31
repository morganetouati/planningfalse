<?php
include("../bdd.php");

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$start_contrat = $_POST['start_contrat'];
$end_contrat = $_POST['end_contrat'];
$heure_semaine = $_POST['heure_semaine'];
$salaire_brut = $_POST['salaire_brut'];
$salaire_net = $_POST['salaire_net'];
$societe = $_POST['societe'];
$role_id = $_POST['role'];

if(isset($_POST['submit']))
{
	if (!empty($nom) && !empty($prenom) && $email && !empty($password) 
		&& !empty($start_contrat) && !empty($end_contrat) && !empty($heure_semaine)
		&& !empty($salaire_brut) && !empty($salaire_net) && !empty($societe) && !empty($role_id) &&
		is_numeric($heure_semaine) && is_numeric($salaire_brut) && is_numeric($salaire_net))
	{
		$req = $bdd->prepare('INSERT INTO users(nom, prenom, email, password, start_contrat,
			end_contrat, heure_semaine, salaire_brut, salaire_net, societe, role_id)
		VALUES (:nom, :prenom, :email, :password, :start_contrat, :end_contrat, :heure_semaine,
			:salaire_brut, :salaire_net, :societe, :role_id)');
		$req->execute(array(
			"nom" => $nom,
			"prenom" => $prenom,
			"email" => $email,
			"password" => $password,
			"start_contrat" => $start_contrat,
			"end_contrat" => $end_contrat,
			"heure_semaine" => $heure_semaine,
			"salaire_brut" => $salaire_brut,
			"salaire_net" => $salaire_net,
			"societe" => $societe,
			"role_id" => $role_id
			));
		echo "Votre inscription a bien été prise en compte";
		header("Location: ../html/index.php");
	}
	else
	{
		echo "Veuillez remplir tous les champs ou corriger vos erreurs";
	}
}