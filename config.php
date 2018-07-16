<?php
defined ('TESTFORRGRANT') or die('Access Denied');


// Model
define('MODEL','model/model.php');

// Controller
define('CONTROLLER','controller/controller.php');

// View
define('VIEW','view/');


// DB Server
define('HOST','localhost');

// DB User
define('USER','root');

// DB Password
define('PASS','root');

// DB Name
define('DB','testforgrant');


//Test DB connection
$link = new mysqli(HOST, USER, PASS);
if (!empty($link->connect_error)) {   
    die('No connection to server, error: ' . $link->connect_error);    
}
$link->select_db(DB) or die('No connect to DB');
$link->query("SET NAMES 'UTF8'") or die('Cant set charset');
$link->close();


