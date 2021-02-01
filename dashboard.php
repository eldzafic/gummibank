<?php
    include_once 'header.php';
    include_once 'includes/Ueberweisung.php';
    include_once 'includes/functions.inc.php';
?>

<?php
    if(isset($_SESSION["lastname"]))
    {
        echo "<h2 class='text-center'>Willkommen zurück, Herr/Frau " .$_SESSION["lastname"] ."!</h2>";
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
    else if($_POST['datumvon'] && $_POST['datumbis'] != "")
    {
        $result = Ueberweisung::getAllDatumVonBis($kundeiban, $_POST['datumvon'], $_POST['datumbis']);
    }else
    {
        $result = Ueberweisung::getAll($kundeiban);
    }
}
else if (isset($_POST['submitbetrag']))
{
    if($_POST['betraggenau'] != null)
    {
        $result = Ueberweisung::getAllBetrag($kundeiban, $_POST['betraggenau']);
    }
    else if($_POST['betragvon'] && $_POST['betragbis'] != "")
    {
        $result = Ueberweisung::getAllBetragVonBis($kundeiban, $_POST['betragvon'], $_POST['betragbis']);
    }else
    {
        $result = Ueberweisung::getAll($kundeiban);
    }
}
else if (isset($_POST['submittext']))
{
    if($_POST['referenzoderverwendung'] != null)
    {
        $result = Ueberweisung::getAllInfo($kundeiban, $_POST['referenzoderverwendung']);
    }
    else
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
            <thead>                <tr>
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

            <button id="filteranzeigen" type="button" class="btn btn-primary" onclick="myFunction()">Filter anzeigen</button>
            <button id="filterausblenden" type="button" class="btn btn-primary" onclick="filterAusblenden()" hidden>Filter ausblenden</button>

            <div class="container" id="filter" hidden>


                <form action="dashboard.php" method="post" id="filter">
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
                    <button type="submit" name="submit" class="btn btn-default bg-dark">Sortieren Datum</button>
                    <div class="form-group">
                        <label for="betraggenau">Genauer Betrag</label>
                        <input type="number" class="form-control" name="betraggenau">
                    </div>
                    <div class="form-group">
                        <label for="betragvon">Betrag von</label>
                        <input type="number" class="form-control" name="betragvon">
                    </div>
                    <div class="form-group">
                        <label for="betragbis">Betrag bis</label>
                        <input type="number" class="form-control" name="betragbis">
                    </div>

                    <button type="submit" name="submitbetrag" class="btn btn-default bg-dark">Sortieren Betrag</button>

                    <div class="form-group">
                        <label for="referenzoderverwendung">Zahlungsreferenz oder Verwendungszweck</label>
                        <input type="text" class="form-control" name="referenzoderverwendung">
                    </div>

                    <button type="submit" name="submittext" class="btn btn-default bg-dark">Sortieren Infos</button>
                </form>


            </div>

            <script>
                function myFunction() {
                    document.getElementById("filter").removeAttribute("hidden");
                    document.getElementById("filteranzeigen").setAttribute("hidden","");
                    document.getElementById("filterausblenden").removeAttribute("hidden","");
                }
                function filterAusblenden() {
                    document.getElementById("filter").setAttribute("hidden","");
                    document.getElementById("filterausblenden").setAttribute("hidden","");
                    document.getElementById("filteranzeigen").removeAttribute("hidden","");
                }
            </script>

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


