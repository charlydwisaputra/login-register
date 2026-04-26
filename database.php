<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "db_testing";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if (!$db) {
    die("koneksigagal : " . 
    mysqli_connect_error());
}
