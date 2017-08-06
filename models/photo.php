<?php
/**
 * User: PETCZU
 * Date: 04.08.17
 * Time: 15:17
 */
require __DIR__ . '/../functions/sql.php';

function Photo_getAll()
{
    $sqlquery = 'SELECT * FROM images';
    return sqlResult($sqlquery);
}

function Photo_getInfo($imgId) {
    $sqlquery = 'SELECT * FROM images WHERE id='."$imgId".'';
    return sqlResult($sqlquery);
}
function Photo_addCount($imgId){
    $sqlquery = 'UPDATE images SET views=views+1 WHERE id='."$imgId".'';
    sqlExec($sqlquery);
}
function Photo_Upload($name, $title){
    $sqlquery = 'INSERT INTO images (name, title) VALUES ('."[$name]".','."[$title]".')';
      //  $sqlquery = 'INSERT INTO images (name, title) VALUES ('."$name".')';
//    sqlExec($sqlquery);
    echo $sqlquery;
}