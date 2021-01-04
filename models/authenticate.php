<?php

if (isset($_POST['username']) AND $_POST['password'])
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username;
    echo $password;
}

?>

