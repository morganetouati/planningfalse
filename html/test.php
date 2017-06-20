<?php 
$radiohoraire1=$_POST['radiohoraire1'];
$radiohoraire2=$_POST['radiohoraire2'];

$type1 = "";

switch ($radiohoraire1) {
	case 'hnormale':
		$type1 = "norm";
		break;
	case 'hformation':
		$type1 = "form";
		break;
	
	case 'hmajore1':
		$type1 = "maj1";
		break;

	case 'hmajore2':
		$type1 = "maj2";
		break;

	default:
		die();
		break;
}

