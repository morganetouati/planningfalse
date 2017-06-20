<?php

/**
 * 
 */
class Planning_Models_Horaire {

    protected $connect;

    function __construct($connect) {
        $this->connect = $connect;
    }

    public function insert_horaire($data, $id_users) {
        $bdd = $this->connect->getPdo();
        $mois = date("m");
        $annee = date("Y");
        $semaine = date("W");
        $id_horaire = $_POST['id_horaire'];
        $req = $bdd->prepare('INSERT INTO horaires(start, type1, pause, reprise, type2, fin, jour, annee, mois, semaine, id_users, id_horaire) VALUES (:start, :type1, :pause, :reprise, :type2, :fin, :jour, :annee, :mois,:semaine, :id_users, :id_horaire)');
        $ok = $req->execute(array(
            "start" => $data['now'],
            "type1" => $data['type1'],
            "pause" => '',
            "reprise" => '',
            "type2" => $data['type2'],
            "fin" => '',
            "jour" => $data['day'],
            "semaine" => $semaine,
            "mois" => $mois,
            "annee" => $annee,
            "id_users" => $id_users,
            //"id_horaire" => $row['id_horaire'])
            "id_horaire" => $id_horaire)
        );
        if (!$ok) {
            var_dump(__FILE__, __LINE__) . die();
        }
        //return $bdd->lastInsertId($id_horaire);
    }
        public function update_pause($data) {
        $bdd = $this->connect->getPdo();
        $req2 = $bdd->prepare('UPDATE horaires SET pause = :pause WHERE id_horaire = :id_horaire');
        $req2->execute(array(
            "id_horaire" => $data['id_horaire'],
            "pause" => $data['pause'])
        );
        }

    public function update_reprise($data) {
        $bdd = $this->connect->getPdo();
        $req2 = $bdd->prepare('UPDATE horaires SET reprise = :reprise, type2 = :type2 WHERE id_horaire = :id_horaire');
        $ok = $req2->execute(array(
            "id_horaire" => $data['id_horaire'],
            "type2" => $data['type2'],
            "reprise" => $data['reprise'])
        );
        if (!$ok) {
            var_dump(__FILE__, __LINE__, $req2) . die();
        }
    }

        public function update_fin($data) {
        $bdd = $this->connect->getPdo();
        $req2 = $bdd->prepare('UPDATE horaires SET fin = :fin WHERE id_horaire = :id_horaire');
        $req2->execute(array(
            //"id_horaire" => $data['id_horaire'],
            "fin" => $data['fin'])
        );
    }


    public function select_horaire($id_users) {
        $bdd = $this->connect->getPdo();
        
        //SELECT * FROM horaires WHERE `jour` BETWEEN '2017-05-04' AND '2017-06-07' AND `type1` = 'norm' AND `id_users` = 40
        //$req = $bdd->prepare("SELECT * FROM horaires WHERE `jour` BETWEEN '2017-05-04' AND '2017-06-07' AND `type1` = 'norm' AND `id_users` = 40");
        $req = $bdd->prepare("SELECT id_horaire, start, pause, reprise, fin, jour, mois, semaine, annee, id_users FROM horaires WHERE id_users = :id_users ORDER BY start");
        
        $req->execute(array(
            "id_users" => $id_users,
        ));

        $tempreqs = $req->fetchAll();
        $reqs = array();
        foreach ($tempreqs as $key => $value) {
            $value['total_heure_normale'] = $this->total_by_choice(Planning_Bdd_Constants::HNORMALE, $bdd, $id_users); //total normal
            $value['total_semaine'] = $this->total_by_choice(Planning_Bdd_Constants::HFORMATION, $bdd, $id_users); //total formation
            $value['total_mois'] = $this->total_by_choice(Planning_Bdd_Constants::HMAJORE1, $bdd, $id_users); //total majore1
            $value['total_annee'] = $this->total_by_choice(Planning_Bdd_Constants::HMAJORE2, $bdd, $id_users); //total majore2
            $reqs[$key] = $value;
        }

        //$lastDateInDb = $reqs[count($reqs) - 1];
        return $reqs;
    }

    /**
     * 
     * @param string $searchvalue : voir constante Planning_Bdd_Constants::HNORMALE et autres
     * @param pdo $bdd
     * @param int $id_users : voir table users
     * @return time : en secondes
     */
    protected function total_by_choice($searchvalue, $bdd, $id_users) {
        $query = $bdd->prepare('SELECT id_horaire FROM horaires WHERE id_users = :id_users');
        $query->execute(array(":id_users" => $id_users));
        $val = $query->fetch();
        $temp1 = $this->total_by_type_and_choice(Planning_Bdd_Constants::TYPE1, $searchvalue, $bdd, $id_users);
        $temp2 = $this->total_by_type_and_choice(Planning_Bdd_Constants::TYPE2, $searchvalue, $bdd, $id_users);
        $resulttemps = $temp1 + $temp2;
        if (1) {
            $req_update_bdd = $bdd->prepare('UPDATE horaires SET total_heure_normale = :Resulttemps WHERE id_horaire = :Id_horaire AND id_users = :Id_users');
            $req_update_bdd->execute(array(
                'Resulttemps' => $resulttemps,
                'Id_horaire' => $val['id_horaire'],
                'Id_users' => $id_users)
            );
            //$req_update_bdd->fetch();
            //var_dump($req_update_bdd).die();
        }
        return $resulttemps;
    }

    protected function total_by_type_and_choice($wheretype, $searchvalue, $bdd, $id_users) {
        switch ($wheretype) {
            case Planning_Bdd_Constants::TYPE1:
                $reqtotaltype1 = $bdd->prepare("SELECT id_horaire, start, pause, id_users FROM horaires WHERE $wheretype = '$searchvalue' AND id_users = :id_users");
                $reqtotaltype1->execute(array(":id_users" => $id_users));
                $recuptotal1 = $reqtotaltype1->fetchAll(PDO::FETCH_ASSOC);
                $total = 0;
                foreach ($recuptotal1 as $key => $value) {
                    $res = Planning_ModelHelper::start_pause($value['start'], $value['pause']);
                    $total = $res + $total;
                }
                return $total;
                break;
            case Planning_Bdd_Constants::TYPE2:
                $reqtotaltype2 = $bdd->prepare("SELECT id_horaire, reprise, fin, id_users FROM horaires WHERE $wheretype = '$searchvalue' AND  id_users = :id_users");
                $reqtotaltype2->execute(array(":id_users" => $id_users));
                $recuptotal2 = $reqtotaltype2->fetchAll(PDO::FETCH_ASSOC);
                $total2 = 0;
                foreach ($recuptotal2 as $key => $value) {
                    $res2 = Planning_ModelHelper::reprise_fin($value['reprise'], $value['fin']);
                    $total2 = $res2 + $total2;
                }
                return $total2;
                break;
            default:
                die(__FILE__);
                break;
        }
    }

    /* public function update_total_type_in_database($id_horaire,$bdd,$id_users) {
      $bdd = $this->connect->getPdo();
      $id_horaire = $_SESSION['id_horaire'];
      $varresult = $this->total_by_choice($searchvalue, $bdd, $id_users);
      $req_update_bdd = $bdd->prepare('UPDATE horaires SET :total_heure_normale = :resulttemps WHERE id_horaire = :id_horaire,id_users = :id_users');
      $req_update_bdd->execute(array(
      ':total_heure_normale' => $varresult,
      ':id_horaire' => $id_horaire)
      );
      $req_update_bdd->fetch();
      var_dump($req_update_bdd).die("haha");
      } */
}
