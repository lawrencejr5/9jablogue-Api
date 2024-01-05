<?php

include "../modules/Data.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$myData = new Data;
$id = isset($_GET['id']) ? $_GET['id'] : die();
$a_post = $myData->get_a_post($id)->fetchAll(PDO::FETCH_ASSOC);
$post_arr = [];
$post_arr['post'] = [];
foreach ($a_post as $p) {
    $post = [
        'id' => $p['id'],
        'categories' => [$p['x'], $p['y'], $p['z']],
        'title' => $p['title'],
        'description' => $p['description'],
        'thumb' => $p['thumb'],
        'post' => html_entity_decode($p['post']),
        'datetime' => $p['datetime'],
    ];
}
array_push($post_arr['post'], $post);
print_r(json_encode($post_arr));
