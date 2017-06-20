<?php
error_reporting(E_ALL);
session_start();
$autoload = require '../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();
$horaire = new Planning_Models_Horaire($connect);
$horaire2 = new Planning_Models_Horaire2($connect);
if (!isset($_SESSION['id_users'])) {
    header('Location: index.php');
    exit();
}
$id_users = $_SESSION['id_users'];
$reqs = $horaire->select_horaire($id_users);
// $req = $bdd->prepare("SELECT id_horaire,start,pause,reprise,fin,jour,total_heure_normale,total_semaine,total_mois,total_annee, mois, semaine, annee, id_users FROM horaires WHERE id_users = :id_users ORDER BY start");
// $req->execute([
// 	"id_users" => $_SESSION['id_users'],
// 	]);
// $reqs = $req->fetchAll();
// $lastDateInDb = $reqs[count($reqs) - 1];
//resources css
$urlresource = "/planning/vendor/kalliste-sas/Planning/Resources/";

function currentDayAlreadyInDb($date) {
    global $reqs;
    $currentDate = new DateTime();
    foreach ($reqs as $item) {
        if (date_format($currentDate, 'Y-m-d') == date_format(new DateTime($item["start"]), 'Y-m-d')) {
            return true;
            break;
        }
    }
    return false;
}
?>

<!Doctype html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="<?php echo $urlresource; ?>css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo $urlresource; ?>css/style.css" type="text/css">
        <script src="<?php echo $urlresource; ?>js/jquery-3.1.1.min.js"></script>
        <script src="<?php echo $urlresource; ?>js/bootstrap.min.js"></script>
        <title>Planning</title>
    </head>
    <body>
        <header>
            <h1>Bienvenue sur la plateforme de gestion de présence des employés</h1>
            <nav>
                <ul>
                    <li><a href="profil.php">Mon profil</a></li>
                    <li><a href="calendrier.php">Calendrier</a></li>
                    <li><a href="../php/logout.php">Déconnexion</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <h2>Pointeuse horaire</h2>
            <div id="formhoraire">
                <div class="panel panel-primary">
                    <div class="panel-heading">Un petit clic pour vous signaler? ;)</div>
                    <div class="panel-body">
                        <form id="horaire" role="form" action="../php/time.php" method="post">
                            <label for="start">Début</label>
                            <label class="radio-inline"><input type="radio" name="radiohoraire1" id="hnormale" value="hnormale" />Heure normale</label>
                            <label class="radio-inline"><input type="radio" name="radiohoraire1" id="hformation" value="hformation" />Heure formation</label>
                            <label class="radio-inline"><input type="radio" name="radiohoraire1" id="hmajore1" value="hmajore1" />Heure majorée 50%</label>
                            <label class="radio-inline"><input type="radio" name="radiohoraire1" id="hmajore2" value="hmajore2" />Heure majorée 100%</label>
                            <!-- <label class="checkbox-inline">heure normale</label>
                                    <input type="checkbox" name="hnormale"/>
                            <label class="checkbox-inline">heure formation</label>
                                    <input type="checkbox" name="hformation"/>
                            <label class="checkbox-inline">heure majorée 50%</label>
                                    <input type="checkbox" name="hmajore1"/>
                            <label class="checkbox-inline">heure majorée 100%</label>
                            <input type="checkbox" name="hmajore2"/> -->
                            <button class="btn btn-primary m-t-10" type="submit" name="start" value="start" <?php
                            if (currentDayAlreadyInDb($lastDateInDb)) {
                                echo "disabled=disabled";
                            }
                            ?>>Début</button>

                            <label for="pause">Horaire de pause</label>
                            <button class="btn btn-primary m-t-10" type="submit" name="pause" value="pause">Pause</button>

                            <label for="reprise">Horaire de reprise</label>
                            <label class="radio-inline"><input type="radio" name="radiohoraire2" id="repheurenormal" value="hnormale" />Heure normale</label>
                            <label class="radio-inline"><input type="radio" name="radiohoraire2" id="repheureformation" value="hformation" />Heure formation</label>
                            <label class="radio-inline"><input type="radio" name="radiohoraire2" id="repheuremajore1" value="hmajore1" />Heure majorée 50%</label>
                            <label class="radio-inline"><input type="radio" name="radiohoraire2" id="repheuremajore2" value="hmajore2" />Heure majorée 100%</label>
                            <button class="btn btn-primary m-t-10" type="submit" name="reprise" value="reprise">Reprise</button>

                            <label for="fin">Fin de journée</label>
                            <button class="btn btn-primary m-t-10" type="submit" name="fin" value="fin">Fin</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="col-md-6">
                    <thead>
                    <table id="heure" class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>total heure normale</th>
                            <th>total heure formation</th>
                            <th>total heure majorée</th>
                            <th>total heure global</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Semaine</th>
                                <?php
//$total_semaine = 0;
//foreach ($reqs as $k => $v) {
//var_dump($v['total_semaine']).die();
//foreach ($v['total_semaine'] as $key => $value){
//var_dump($value).die();
//								$temp = $v['total_semaine'];
//								echo '<td>'.$key.' '.$value.'</td>';
//								$total_semaine .= '!'.$temp;//probleme affichage horaire
//}
//}
                                ?>
                                <!--<td>
                                
                                //echo $total_semaine;
                                
                                </td>-->
                            </tr>
                            <tr>
                                <th scope="row">Mois</th>
                                <?php
//foreach ($reqs as $k => $v) {
//	echo '<td>'.$v['total_mois'].'</td>';
//}
                                ?>
                            </tr>
                            <tr>
                                <th scope="row">Annee</th>
                                <?php
                                //foreach ($reqs as $k => $v) {
                                //echo '<td>'.$v['total_annee'].'</td>';
                                //}
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table id="heure2" class="table table-hover">
                        <tr>
                            <th>start</th>
                            <th>pause</th>
                            <th>reprise</th>
                            <th>fin</th>
                            <th>total heure normale</th>
                            <th>total heure formation</th>
                            <th>total heure majorée 50</th>
                            <th>total heure majorée 100</th>
                            <th>total heure global</th>
                        </tr>
                        <?php
                        foreach ($reqs as $k => $v) {
                            echo'<tr>';
                            echo '<td>' . $v['start'] . '</td>';
                            echo '<td>' . Planning_ModelHelper::fix_time($v['pause']) . '</td>';
                            echo '<td>' . Planning_ModelHelper::fix_time($v['reprise']) . '</td>';
                            echo '<td>' . Planning_ModelHelper::fix_time($v['fin']) . '</td>';
                            //echo '<td>' . Planning_ModelHelper::fix_time($v['total_heure_normale']) . '</td>';
                            //echo '<td>'.$v['total_heure_normale'].'</td>';
                            //echo '<td>'.$v['total_semaine'].'</td>';
                            //echo '<td>'.$v['total_mois'].'</td>';
                            //echo '<td>'.$v['total_annee'].'</td>';
                            echo '</tr>';
                        }
                        echo '<p id="journee">Vos horaires ont bien été enregistrés pour le jour : ' . $v['jour'] . '</p>';
                        ?>
                    </table>
                </div>
            </div>
    </body>
</html>