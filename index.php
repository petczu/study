<?php

require __DIR__ . '/models/photo.php';

if (!isset($_GET['id'])){
    $items = Photo_getAll();
} else {
    $imgId = $_GET['id'];
    Photo_addCount($imgId);
    $items = Photo_getInfo($imgId);
}
include __DIR__ . '/views/index.php';
?>