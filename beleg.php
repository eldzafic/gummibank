<?php
session_start();
include_once 'includes/functions.inc.php';
$iban = $_SESSION['iban'];
$betrag = $_SESSION['betrag'];


$result = getAllKundenData($iban);

$datum = date("d.m.Y H:i:s");
$vorname = null;
$nachname = null;
$kontostand = null;
$kontostandVorher = null;


foreach ($result as $item)
{
    $vorname = $item['kvorname'];
    $nachname = $item['knachname'];
    $kontostand = $item['kokontostand'];
}

?>

<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Beleg für Kunden</title>
</head>

<body>

    <div class="container">

        <h1 class="text-center"><b>BELEG</b></h1>

        <?php

            echo "<p class='text-center'>Kontoinhaber-Vorname: <b>" .$vorname ."</b></p>";
            echo "<p class='text-center'>Kontoinhaber-Nachname: <b>" .$nachname ."</b></p>";
            echo "<p class='text-center'>Kontoinhaber-IBAN: <b>" .$iban ."</b></p>";
            if($_SESSION['art'] === "einzahlung")
            {
                echo "<p class='text-center'>Eingezahlter Betrag: <b>" .$betrag ."€</b></p>";
            }
            else
            {
                echo "<p class='text-center'>Ausgezahlter Betrag: <b>" .$betrag ."€</b></p>";
            }
            echo "<p class='text-center'>Aktueller Kontostand: <b>" .$kontostand ."€</b></p>";
            echo "<p class='text-center'>Transaktionszeitpunkt: <b>" .$datum ."</b></p>";

            echo "<script>window.print()</script>";
        ?>

    </div>

</body>
</html>


