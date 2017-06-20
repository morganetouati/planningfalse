<?php

session_start();
// var_dump(__FILE__, __LINE__,$_POST);
$autoload = require '../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();
$horaire = new Planning_Models_Horaire($connect);
$horaire2 = new Planning_Models_Horaire2($connect);
if (!isset($_SESSION['id_users'])) {
    header('Location: ../html/index.php');
    exit();
} else {
    $id_users = $_SESSION['id_users'];
}

$radiohoraire1 = $_POST['radiohoraire1'];
$radiohoraire2 = $_POST['radiohoraire2'];
$start = $_POST['start'];
$pause = $_POST['pause'];
$reprise = $_POST['reprise'];
$fin = $_POST['fin'];
$id_horaire = $_POST['id_horaire'];
$data['now'] = date("Y-m-d H:i:s");
$data['day'] = date("Y-m-d");
$_SESSION['day'] = $data['day'];
$data['pause'] = date("Y-m-d H:i:s");
$data['reprise'] = date("Y-m-d H:i:s");
$data['fin'] = date("Y-m-d H:i:s");
/*$selidhoraire = $bdd->prepare('SELECT id_horaire FROM horaires WHERE id_users = :id_users');
$selidhoraire->execute(array("id_users" => $id_users));
foreach ($selidhoraire as $row) {
   $row['id_horaire'];
}
$_SESSION['id_horaire'] = $row['id_horaire'];
$id_horaire = $_SESSION['id_horaire'];*/
if (isset($radiohoraire1)) {
    $type1 = Planning_Bdd_Constants::HORAIREINCONNUE;

    switch ($radiohoraire1) {
        case 'hnormale':
            $type1 = Planning_Bdd_Constants::HNORMALE;
            break;
        case 'hformation':
            $type1 = Planning_Bdd_Constants::HFORMATION;
            break;

        case 'hmajore1':
            $type1 = Planning_Bdd_Constants::HMAJORE1;
            break;

        case 'hmajore2':
            $type1 = Planning_Bdd_Constants::HMAJORE2;
            break;

        default:
            die("error ligne" . __LINE__);
            break;
    }
    $data['type1'] = $type1;
    $data['type2'] = Planning_Bdd_Constants::HORAIREINCONNUE;
    if (isset($start)) {
        $horaire->insert_horaire($data, $id_users);
        $horaire2->insert_semaine();
        $horaire2->insert_mois();
        $horaire2->insert_annee();
    }
}

if (isset($pause)) {
    $horaire->update_pause($data);
}

if (isset($radiohoraire2)) {
    $type2 = Planning_Bdd_Constants::HORAIREINCONNUE;

    switch ($radiohoraire2) {
        case 'hnormale':
            $type2 = Planning_Bdd_Constants::HNORMALE;
            break;
        case 'hformation':
            $type2 = Planning_Bdd_Constants::HFORMATION;
            break;

        case 'hmajore1':
            $type2 = Planning_Bdd_Constants::HMAJORE1;
            break;

        case 'hmajore2':
            $type2 = Planning_Bdd_Constants::HMAJORE2;
            break;

        default:
            die("$radiohoraire2 error ligne" . __LINE__);
            break;
    }
    $data['type2'] = $type2;

    if (isset($reprise)) {
        $horaire->update_reprise($data);
    }
}

if (isset($fin)) {
    $horaire->update_fin($data);
    //$horaire->total_by_choice(,$bdd,$id_users);
    //$horaire2->calcul_total_semaine();
    //$horaire2->calcul_total_mois();
    //$horaire2->calcul_total_annee();
}
header("Location: ../html/horaires.php");
