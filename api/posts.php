<?php

include "../modules/Data.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$myData = new Data;
$allPosts = $myData->get_posts()->fetchAll(PDO::FETCH_ASSOC);
$post_arr = [];
$post_arr['posts'] = [];
foreach ($allPosts as $p) {
    $posts = [
        'id' => $p['id'],
        'categories' => [$p['x'], $p['y'], $p['z']],
        'title' => $p['title'],
        'description' => $p['description'],
        'thumb' => $p['thumb'],
        'post' => html_entity_decode($p['post']),
        'datetime' => $p['datetime'],
    ];
    array_push($post_arr['posts'], $posts);
}
print_r(json_encode($post_arr));
