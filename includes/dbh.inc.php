<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "gummibaerbank";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if(!$conn)
{
    die("Database connection not established. " .mysqli_connect_error());
}

