<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=db_planning;charset=utf8', 'dbown_planning', 'F0r_Planning');
	// $bdd = new PDO('mysql:host=localhost;dbname=db_planning;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>