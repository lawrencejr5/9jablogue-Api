<?php

include "../modules/Data.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$myData = new Data;
$allCategories = $myData->get_categories()->fetchAll(PDO::FETCH_ASSOC);
$cat_arr = [];
$cat_arr['categories'] = [];

foreach ($allCategories as $c) {
    $cat = [
        'id' => $c['id'],
        'category' => $c['category'],
        'img' => $c['img'],
        'description' => $c['description'],
        'datetime' => $c['datetime'],
    ];
    array_push($cat_arr['categories'], $cat);
}

print_r(json_encode($cat_arr));
