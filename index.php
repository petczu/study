<?php
$start = microtime(true);
session_start();
require __DIR__ . '/models/photo.php';

if (!isset($_GET['id'])){
    $items = Photo_getAll();
//    $counter = Photo_Count();
} else {
    $imgId = $_GET['id'];
    Photo_addViews($imgId);
    $items = Photo_getInfo($imgId);
}
include __DIR__ . '/views/index.php';
echo 'Время выполнения скрипта: '.(microtime(true) - $start).' сек.';
?>