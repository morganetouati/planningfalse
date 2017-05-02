<?php 

if (isset($_POST['submitprofil'])) {

	require("../../bdd.php");
	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$start_contrat = $_POST['start_contrat'];
	$end_contrat = $_POST['end_contrat'];
	$heure_semaine = $_POST['heure_semaine'];
	$salaire_brut = $_POST['salaire_brut'];
	$salaire_net = $_POST['salaire_net'];
	$societe = $_POST['societe'];
	$role_id = $_POST['role'];

	if (!empty($id) && !empty($nom) && !empty($prenom) && !empty($start_contrat) && !empty($end_contrat) && !empty($heure_semaine) && !empty($salaire_brut) && !empty($salaire_net) && !empty($societe) && !empty($role_id)) {
		$membre = $bdd->prepare("UPDATE users SET nom = :nom, prenom = :prenom, start_contrat = :start_contrat, end_contrat = :end_contrat, heure_semaine = :heure_semaine, salaire_brut = :salaire_brut, salaire_net = :salaire_net, :societe, :role_id WHERE id_users = :id");

		$membre->execute(array(
			':id' => $id,
			':nom' =>$nom,
			':prenom' => $prenom,
			':start_contrat' => $start_contrat,
			':end_contrat' => $end_contrat,
			':heure_semaine' => $heure_semaine,
			':salaire_brut' => $salaire_brut,
			':salaire_net' => $salaire_net,
			":societe" => $societe,
			":role_id" => $role_id
			)
		);
	}
	header("Location: ../view/modifier.php?user=$id");
}
?>