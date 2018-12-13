<?php

    /*date_default_timezone_set('Asia/Kolkata');
    $datetime1 = (string)date('Y-m-d');
    $datetime2 = date_create('2009-10-13');
    //$interval = date_diff($datetime1, $datetime2);

    $interval = intval($datetime1->format('z')) - intval($datetime2->format('z')) + 1;
    //echo $interval->format('%R%a days');
    echo $interval;*/
    date_default_timezone_set('Asia/Kolkata');
    $currentdate = date('Y-m-d H:i:s');
//$after1yrdate =  date("Y-m-d H:i:s", strtotime("+1 year", strtotime($data)));
    $after1yrdate = date("2018-4-7 13:24:60");
    $diff = (strtotime($after1yrdate) - strtotime($currentdate)) / (60 * 60 * 24);

    echo '           '. round($diff);
?>