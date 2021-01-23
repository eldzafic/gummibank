<?php
    include_once 'header.php';
    include_once 'includes/Ueberweisung.php';
?>

<?php
    if(isset($_SESSION["lastname"]))
    {
        echo "<p>Willkommen zurück Herr " .$_SESSION["lastname"] ."!</p>";
    }
?>

<?php
$result = Ueberweisung::getAll();
?>

    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">IBAN-Sender</th>
                    <th scope="col">BIC-Sender</th>
                    <th scope="col">IBAN-Empfänger</th>
                    <th scope="col">BIC-Empfänger</th>
                    <th scope="col">Zahlungsreferenz</th>
                    <th scope="col">Verwendungszweck</th>
                    <th scope="col">Betrag</th>
                    <th scope="col">Datum/Uhrzeit</th>
                </tr>
            </thead>
            <tbody>

            <?php
                foreach ($result as $item)
                {
                    echo "<tr><th>" .$item['uibansender'] ."</th>";
                    echo "<th>" .$item['ubicsender'] ."</th>";
                    echo "<th>" .$item['uibanempfaenger'] ."</th>";
                    echo "<th>" .$item['ubicempfaenger'] ."</th>";
                    echo "<th>" .$item['uzahlungsreferenz'] ."</th>";
                    echo "<th>" .$item['uverwendungszweck'] ."</th>";
                    echo "<th>" .$item['ubetrag'] ."</th>";
                    echo "<th>" .$item['udatum'] ."</th></tr>";
                }
            ?>

            </tbody>
        </table>
    </div>

<?php
include_once 'footer.php';
?>


