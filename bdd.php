<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=db_planning;charset=utf8', 'root', '');
	// $bdd = new PDO('mysql:host=vps346171.ovh.net:8443;dbname=db_planning;charset=utf8', 'dbown_planning', 'F0r_Planning');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>