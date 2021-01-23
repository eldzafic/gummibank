<?php

function emptyInputSignup($firstname, $lastname, $telephonenumber, $email, $adress, $password, $password2)
{
    $result = null;
    if(empty($firstname) || empty($lastname) || empty($telephonenumber) || empty($email) || empty($adress) || empty($password) || empty($password2))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidFirstname($firstname)
{
    $result = null;

        if(!preg_match("/^[a-zA-Z]*$/", $firstname))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
            return $result;
}

function invalidLastname($lastname)
{
    $result = null;

    if(!preg_match("/^[a-zA-Z]*$/", $lastname))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
            return $result;
}

function invalidTelephonenumber($telephonenumber)
{
    $result = null;

    if(!preg_match("/^[0-9]*$/", $telephonenumber))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result = null;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
            return $result;
}

function invalidAdress($adress)
{
    $result = null;

    if(!preg_match("/^[a-zA-Z0-9]*$/", $adress))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function pwdMatch($password, $password2)
{
    $result = null;

    if($password !== $password2)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email)
{
    $sql = "SELECT * FROM kunden WHERE kemail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createKunde($conn, $firstname, $lastname, $telephonenumber, $email, $adress, $password, $employee)
{

    //Hier wird ein Kunde erstellt

    $sql = "INSERT INTO kunden (kvorname, knachname, ktelefonnummer, kemail, kadresse, kpasswort, kmitarbeiter) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $telephonenumber, $email, $adress, $hashedPassword, $employee);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //Hier wird mithilfe der E-Mail Adresse ein die ID aus der Tabelle kunden entnommen

    $bic = "GUMMI99XXX";
    $kontostand = 0;
    $iban = createIban();
    $verfuegernummer = createVerfueger();

    $sql = "SELECT kid FROM kunden WHERE kemail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $kid);

    $kundeId = null;
    while(mysqli_stmt_fetch($stmt))
    {
        $kundeId = $kid;
    }
    mysqli_stmt_close($stmt);

    //Hier wird ein Konto für den Kunden angelegt

    $sql = "INSERT INTO konto (kokontostand, koiban, kobic, koverfueger, kid) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $kontostand, $iban, $bic, $verfuegernummer, $kundeId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../register.php?error=none");
    exit();
}


//Funktionen für Login

function emptyInputLogin($benutzer, $kennwort)
{
    $result = null;
    if(empty($benutzer) || empty($kennwort))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $benutzer, $kennwort)
{
    $emailExists = emailExists($conn, $benutzer);

    if($emailExists === false)
    {
        header("location: ../login.php?error=wronglogin");
        exit();
    }


    $passwordHashed = $emailExists["kpasswort"];
    $checkpassword = password_verify($kennwort, $passwordHashed);

    if($checkpassword === false)
    {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    elseif($checkpassword === true)
    {
        session_start();
        $_SESSION["userid"] = $emailExists["kid"];
        $_SESSION["lastname"] = $emailExists["knachname"];
        $_SESSION["mitarbeiter"] = $emailExists["kmitarbeiter"];
        header("location: ../index.php");
        exit();
    }
}


//Funktionen für erstellung von einem Konto wenn sich der Kunde registriert

function createIban()
{
    $kontonummer = "";
    define('iban', 'AT9912345');

    for ($i = 0; $i<3; $i++)
    {
        $z1 = rand(0, 9);
        $z2 = rand(0,9);
        $kontonummer = $kontonummer .$z1 .$z2;
    }
    $ibangesamt = iban .$kontonummer;
    return $ibangesamt;
}

function createVerfueger()
{
    $verfuegernummer = "";

    for ($i = 0; $i<5; $i++)
    {
        $z1 = rand(0, 9);
        $z2 = rand(0,9);
        $verfuegernummer = $verfuegernummer .$z1 .$z2;
    }
    return $verfuegernummer;
}