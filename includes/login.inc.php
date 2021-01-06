<?php

if(isset($_POST["submit"]))
{
    $benutzer = $_POST['benutzername'];
    $kennwort = $_POST['kennwort'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($benutzer, $kennwort) !== false)
    {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $benutzer, $kennwort);
}
else
{
    header("location: ../login.php");
    exit();
}
