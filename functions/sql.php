<?php
/**
 * User: PETCZU
 * Date: 04.08.17
 * Time: 15:55
 */
function sqlConnect(){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'gallery';
    return mysqli_connect($host, $user, $password, $database);
}
function sqlResult($sqlquery) {
    $sqlresult = sqlConnect()->query($sqlquery);
    while (!false == $row = $sqlresult->fetch_assoc()) {
        $sqlreturn[] = $row;
    }
    return $sqlreturn;
}
function sqlExec($sqlquery) {
    $sqlresult = sqlConnect()->query($sqlquery);
    return $sqlresult;
}