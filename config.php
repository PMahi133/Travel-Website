<?php
ob_start();
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
// Database Connection with MySQL
// define constants for Database , Only for Localhost
define(constant_name: "DB_SERVER", value: "localhost");
define(constant_name: "DB_USERNAME",value: "root");
define(constant_name: "DB_PASSWORD",value: "");
define(constant_name: "DB_NAME",value: "passion1");
$link = mysqli_connect(hostname: DB_SERVER ,username: DB_USERNAME ,password: DB_PASSWORD, database: DB_NAME);
if(!$link){
    die("Error: in Database Connection : ".mysqli_connect_error());
}
?>