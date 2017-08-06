<?php
/**
 * User: PETCZU
 * Date: 04.08.17
 * Time: 15:55
 */
require __DIR__ . '/../dbconfig.php';

function sqlResult($sqlquery) {
    global $dbhost;
    $sqlresult = $dbhost->query($sqlquery);
    while (!false == $row = $sqlresult->fetch_assoc()) {
        $sqlreturn[] = $row;
    }
    return $sqlreturn;
}

function sqlInsert(){

}

function sqlExec($sqlquery) {
    global $dbhost;
    $dbhost->query($sqlquery);
}