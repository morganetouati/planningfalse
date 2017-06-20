<?php

/**
* 
*/
class Planning_Bdd_Connect
{
	protected $bddpdo;
	function __construct()
	{
		try
		{
	// $bdd = new PDO('mysql:host=localhost;dbname=db_planning;charset=utf8', 'dbown_planning', 'F0r_Planning');
			$this->bddpdo = new PDO('mysql:host=localhost;dbname=db_planning;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}
	public function getPdo()
	{
		return $this->bddpdo;
	}
}
