<?php
include_once 'header.php';
include_once 'includes/Ueberweisung.php';
?>

<?php

    if(isset($_POST['submit']))
    {
        $_SESSION['art'] = "einzahlung";
        $iban = $_POST['iban'];
        $_SESSION['iban'] = $iban;
        $betrag = $_POST['betrag'];
        $_SESSION['betrag'] = $betrag;
        Ueberweisung::einzahlungSchalter($iban, $betrag);

        $u = new Ueberweisung();
        $u->setUibansender("BANK");
        $u->setUbicsender("GUMMI99XXX");
        $u->setUibanempfaenger($_POST['iban']);
        $u->setUbicempfaenger("GUMMI99XXX");
        $u->setUzahlungsreferenz("-");
        $u->setUverwendungszweck("EINZAHLUNG");
        $u->setUbetrag($_POST['betrag']);
        $u->setKid(0);

        $u->createUeberweisungSchalter();

        header("location: beleg.php");

    }

    if(isset($_POST['auszahlung']))
    {
        $_SESSION['art'] = "auszahlung";
        $iban = $_POST['iban'];
        $_SESSION['iban'] = $iban;
        $betrag = $_POST['betrag'];
        $_SESSION['betrag'] = $betrag;
        $k = Ueberweisung::validateAuszahlung($iban);
        $kontostandaktuell = $k['kokontostand'];

        if($kontostandaktuell < $betrag)
        {
            echo "<p class='text-danger'>Kunde hat nicht genug Geld auf dem Konto</p>";
        }
        else {
            Ueberweisung::auszahlungSchalter($iban, $betrag);

            $u = new Ueberweisung();
            $u->setUibansender($_POST['iban']);
            $u->setUbicsender("GUMMI99XXX");
            $u->setUibanempfaenger("BANK");
            $u->setUbicempfaenger("GUMMI99XXX");
            $u->setUzahlungsreferenz("-");
            $u->setUverwendungszweck("AUSZAHLUNG");
            $u->setUbetrag($_POST['betrag']);
            $u->setKid(0);

            $u->createUeberweisungSchalter();

            header("location: beleg.php");
       }
    }
?>

<form action="mitarbeiter.php" method="post">
    <div class="form-group">
        <label for="iban">IBAN</label>
        <input type="text" class="form-control" name="iban" required>
    </div>
    <div class="form-group">
        <label for="betrag">Betrag</label>
        <input type="number" class="form-control" name="betrag" required>
    </div>
    <button type="submit" name="submit" class="btn btn-default bg-dark">Einzahlen</button>
</form>

<form action="mitarbeiter.php" method="post">
    <div class="form-group">
        <label for="iban">IBAN</label>
        <input type="text" class="form-control" name="iban" required>
    </div>
    <div class="form-group">
        <label for="betrag">Betrag</label>
        <input type="number" class="form-control" name="betrag" required>
    </div>
    <button type="submit" name="auszahlung" class="btn btn-default bg-dark">Auszahlen</button>
</form>

<?php
include_once 'footer.php';
?>

