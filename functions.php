<?php

//Show array
function debug ($arr){
    echo '<pre>' . print_r($arr, true) . '</pre>';
}


//Connection to Data Base
function connectDB() {
    $link = new mysqli(HOST, USER, PASS, DB);
    $link->query("SET NAMES 'UTF8'") or die('Cant set charset');
    if (!empty($link->connect_error)) {
        die('No connection to server, error: ' . $link->connect_error);
    }
    return $link;
}//ConnectionDB