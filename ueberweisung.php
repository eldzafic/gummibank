<?php
include_once 'header.php';
require 'includes/Ueberweisung.php';
?>

<?php
    if(isset($_POST['submit']))
    {
        $u = new Ueberweisung();
        $u->setUibanempfaenger($_POST['empfaengeriban']);
        $u->setUbicempfaenger($_POST['empfaengerbic']);
        $u->setUzahlungsreferenz($_POST['zahlungsreferenz']);
        $u->setUverwendungszweck($_POST['verwendungszweck']);
        $u->setUbetrag($_POST['betrag']);

        $u->createUeberweisung();
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