<?php
include_once 'header.php';
require 'includes/Ueberweisung.php';
?>

<?php
    if(isset($_POST['submit']))
    {
        $k = Ueberweisung::validateAuszahlung($_SESSION['userid']);
        $kontostandaktuell = $k['kokontostand'];

        if($kontostandaktuell < $_POST['betrag'])
        {
            echo "<p class='text-danger'>Nicht genug Geld auf dem Konto</p>";
        }
        else
        {
            if(Ueberweisung::validateUeberweisung($_POST['empfaengeriban'], $_POST['empfaengerbic'], $_POST['zahlungsreferenz'], $_POST['verwendungszweck'], $_POST['betrag']))
            {
                $u = new Ueberweisung();
                $u->setUibanempfaenger($_POST['empfaengeriban']);
                $u->setUbicempfaenger($_POST['empfaengerbic']);
                $u->setUzahlungsreferenz($_POST['zahlungsreferenz']);
                $u->setUverwendungszweck($_POST['verwendungszweck']);
                $u->setUbetrag($_POST['betrag']);
                $u->setKid($_SESSION['userid']);

                $u->createUeberweisung();
            }
            else
            {
                echo "<p class='text-danger'>Ungültige eingabe. Bitte alle Felder überprüfen!</p>";
            }
        }
    }
?>

<form action="ueberweisung.php" method="post">
    <div class="form-group">
        <label for="empfaengeriban">Empfänger-IBAN</label>
        <input type="text" class="form-control" name="empfaengeriban" required>
    </div>
    <div class="form-group">
        <label for="empfaengerbic">Empfänger-BIC</label>
        <input type="text" class="form-control" name="empfaengerbic" required>
    </div>
    <div class="form-group">
        <label for="zahlungsreferenz">Zahlungsreferenz</label>
        <input type="text" class="form-control" name="zahlungsreferenz" required>
    </div>
    <div class="form-group">
        <label for="verwendungszweck">Verwendungszweck</label>
        <input type="text" class="form-control" name="verwendungszweck" required>
    </div>
    <div class="form-group">
        <label for="betrag">Betrag</label>
        <input type="number" class="form-control" name="betrag" required>
    </div>
    <button type="submit" name="submit" class="btn btn-default bg-dark">Überweisen</button>
</form>

<?php
include_once 'footer.php';
?>
