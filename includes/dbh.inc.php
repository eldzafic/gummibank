<?php

$hostname = "localhost";
$username = "root";
$passwort = "";
$dbname = "gummibaerbank";

$conn = mysqli_connect($hostname, $username, $passwort, $dbname);

if(!$conn)
{
    die("Database connection not established. " .mysqli_connect_error());
}

