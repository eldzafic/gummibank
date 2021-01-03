<?php
$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'gummibaerbank';

$dbconn = new mysqli($hostname, $username, $password, $dbname);
if($dbconn == false)
{
    die('Verbindung ist fehlgeschlagen!');
}
?>


