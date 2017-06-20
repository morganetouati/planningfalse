<?php

/**
 * 
 */
class Planning_ModelHelper {
    static function calcul_temps_general($start, $pause, $reprise, $fin) {

        $time1 = strtotime($start);
        $time2 = strtotime($pause);
        $result = $time2 - $time1;

        $time3 = strtotime($reprise);
        $time4 = strtotime($fin);
        $rest = $time4 - $time3;

        $tab['result'] = $result;
        $tab['rest'] = $rest;
        //$theend = new Datetime($reprise);
        $cal = $result + $rest;
        $tab['cal'] = date('H:i:s', $cal - 3600);
        $totalj = $tab['cal'];
        return $totalj;
    }

    static function start_pause($start, $pause) {
        $timestart = strtotime($start);
        $timepause = strtotime($pause);
        $calculstartpause = $timepause - $timestart;
        return $calculstartpause;
    }

    static function reprise_fin($reprise, $fin) {
        $timereprise = strtotime($reprise);
        $timefin = strtotime($fin);
        $calculreprisefin = $timefin - $timereprise;
        return $calculreprisefin;
    }

    static function fix_time($time) {
        if ($time != 0) {
            $fixed_time = date('H:i:s', strtotime($time));
            if ($fixed_time == '01:00:00') {
                return '-';
            }
            return $fixed_time;
        } else {
            return '-';
        }
    }
}
