<?php

if(isset($_POST["submit"]))
{
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $telephonenumber = $_POST["telephonenumber"];
    $email = $_POST["email"];
    $adress = $_POST["adress"];
    $password = $_POST["pwd"];
    $password2 = $_POST["pwd2"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($firstname, $lastname, $telephonenumber, $email, $adress, $password, $password2) !== false)
    {
        header("location: ../register.php?error=emptyinput");
        exit();
    }

    if(invalidFirstname($firstname) !== false)
    {
        header("location: ../register.php?error=invalidfirstname");
        exit();
    }

    if(invalidLastname($lastname) !== false)
    {
        header("location: ../register.php?error=invalidlastname");
        exit();
    }

    if(invalidTelephonenumber($telephonenumber) !== false)
    {
        header("location: ../register.php?error=invalidtelephonenumber");
        exit();
    }

    if(invalidEmail($email) !== false)
    {
        header("location: ../register.php?error=invalidemail");
        exit();
    }

    if(invalidAdress($adress) !== false)
    {
        header("location: ../register.php?error=invalidadress");
        exit();
    }

    if(pwdMatch($password, $password2) !== false)
{
        header("location: ../register.php?error=passwordsdontmatch");
        exit();
    }

    if(emailExists($conn, $email) !== false)
    {
        header("location: ../register.php?error=emailtaken");
        exit();
    }

    createKunde($conn, $firstname, $lastname, $telephonenumber, $email, $adress, $password);
}
else
{
    header("location: ../register.php");
    exit();
}