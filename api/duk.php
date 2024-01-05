<?php

include "../modules/Data.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$myData = new Data;
$allduk = $myData->get_duk()->fetchAll(PDO::FETCH_ASSOC);
$duk_arr = [];
$duk_arr['did_u_knw'] = [];

foreach ($allduk as $d) {
    $duk = [
        'id' => $d['id'],
        'img' => $d['img'],
        'duk' => $d['duk'],
        'datetime' => $d['datetime'],
    ];
    array_push($duk_arr['did_u_knw'], $duk);
}

print_r(json_encode($duk_arr));
