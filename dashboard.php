<?php
    include_once 'header.php';
    include_once 'includes/Ueberweisung.php';
    include_once 'includes/functions.inc.php';
?>

<?php
    if(isset($_SESSION["lastname"]))
    {
        echo "<p>Willkommen zurück Herr " .$_SESSION["lastname"] ."!</p>";
    }
?>

<?php
$result2 = getDashboardData();

$kundeiban = null;
$betrag = null;

foreach ($result2 as $item2)
{
    $kontostand = $item2['kokontostand'];
    $kundeiban = $item2['koiban'];
    $kontonummer = substr($kundeiban, -6);
}

if (isset($_POST['submit']))
{
    if($_POST['datumgenau'] != "")
    {
        $result = Ueberweisung::getAllDatum($kundeiban, $_POST['datumgenau']);
    }
    if($_POST['datumvon'] && $_POST['datumbis'] != "")
    {
        $result = Ueberweisung::getAllDatumVonBis($kundeiban, $_POST['datumvon'], $_POST['datumbis']);
    }
    if($_POST['datumgenau'] && $_POST['datumvon'] && $_POST['datumbis'] === "")
    {
        $result = Ueberweisung::getAll($kundeiban);
    }
}
else
{
    $result = Ueberweisung::getAll($kundeiban);
}



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
                    echo "<p>Ihr Kontostand beträgt: <b>" .$kontostand ." €</b></p>";
                    echo "<p>Ihre Kontonummer lautet: <b>" .$kontonummer ."</b></p>";
            ?>

            <div class="container">


                <form action="dashboard.php" method="post">
                    <div class="form-group">
                        <label for="datumgenau">Genaues Datum</label>
                        <input type="date" class="form-control" name="datumgenau">
                    </div>
                    <div class="form-group">
                        <label for="datumvon">Datum von</label>
                        <input type="date" class="form-control" name="datumvon">
                    </div>
                    <div class="form-group">
                        <label for="datumbis">Datum bis</label>
                        <input type="date" class="form-control" name="datumbis">
                    </div>

                    <button type="submit" name="submit" class="btn btn-default bg-dark">Sortieren</button>
                </form>


            </div>


            <?php

                foreach ($result as $item)
                {

                    echo "<tr><th>" .$item['uibansender'] ."</th>";
                    echo "<th>" .$item['ubicsender'] ."</th>";
                    echo "<th>" .$item['uibanempfaenger'] ."</th>";
                    echo "<th>" .$item['ubicempfaenger'] ."</th>";
                    echo "<th>" .$item['uzahlungsreferenz'] ."</th>";
                    echo "<th>" .$item['uverwendungszweck'] ."</th>";
                    echo "<th>";
                                    if($kundeiban === $item['uibansender'])
                                    {
                                        echo "<p class='text-danger'>- " .$item['ubetrag'] ."</p>";

                                    }
                                    else
                                    {
                                        echo "<p class='text-success'>+ " .$item['ubetrag'] ."</p>";
                                    }

                    echo "</th>";
                    echo "<th>" .date("d.m.Y H:i:s", strtotime($item['udatum'])) ."</th></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>

<?php
include_once 'footer.php';
?>


