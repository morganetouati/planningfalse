<?php
session_start();
$autoload = require '../vendor/autoload.php';
$connect = new Planning_Bdd_Connect();
$bdd = $connect->getPdo();
//resources css
$urlresource = "/planning/vendor/kalliste-sas/Planning/Resources/";

if (isset($_SESSION['id_users']) && $_SESSION['id_users'] > 0) {
    $getid = intval($_SESSION['id_users']);
    $req = $bdd->prepare('SELECT users.*, role.libelle as role FROM users INNER JOIN role ON role.id = role_id WHERE id_users = ?');
    $req->execute(array($getid));
    $userinfo = $req->fetch();
    ?>
    <!Doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="<?php echo $urlresource; ?>css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo $urlresource; ?>css/style.css">
            <script src="<?php echo $urlresource; ?>js/jquery-3.1.1.min.js"></script>
            <script src="<?php echo $urlresource; ?>js/bootstrap.min.js" ></script>
            <title>Planning</title>
        </head>
        <body>
            <header>
                <h1>Bienvenue sur la plateforme de gestion de présence des employés</h1>
                <nav>
                    <ul>
                        <li><a href="horaires.php">Mes horaires</a></li>
                        <li><a href="calendrier.php">Calendrier</a></li>
                        <li><a href="../php/logout.php">Déconnexion</a></li>
                    </ul>
                </nav>
            </header>
            <h2>Profil de <?php echo $userinfo['email']; ?></h2>
            <br /><br />
            <div class="col-md-10" style="display:inline-block;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Début du contrat</th>
                            <th>Fin du contrat</th>
                            <th>Nombre d'heures par semaine</th>
                            <th>Salaire brut</th>
                            <th>Salaire net</th>
                            <th>Societé</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>	
                        <tr>
                            <td width="20%"><?php echo $userinfo['nom']; ?></td>
                            <td width="20%"><?php echo $userinfo['prenom']; ?></td>
                            <td width="20%"><?php echo $userinfo['start_contrat']; ?></td>
                            <td width="20%"><?php echo $userinfo['end_contrat']; ?></td>
                            <td width="20%"><?php echo $userinfo['heure_semaine']; ?></td>
                            <td width="20%"><?php echo $userinfo['salaire_brut']; ?></td>
                            <td width="20%"><?php echo $userinfo['salaire_net']; ?></td>
                            <td width="20%"><?php echo $userinfo['societe']; ?></td>
                            <td width="20%"><?php echo $userinfo['role']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>
    </html>
    <?php
}
//