<?php
    include_once 'header.php';
?>

    <form action="includes/register.inc.php" method="post">
        <div class="form-group">
            <label for="firstname">Vorname</label>
            <input type="text" class="form-control" name="firstname" required>
        </div>
        <div class="form-group">
            <label for="lastname">Nachname</label>
            <input type="text" class="form-control" name="lastname" required>
        </div>
        <div class="form-group">
            <label for="telephonenumber">Telefonnummer</label>
            <input type="text" class="form-control" name="telephonenumber" required>
        </div>
        <div class="form-group">
            <label for="email">E-Mail</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="adress">Adresse</label>
            <input type="text" class="form-control" name="adress" required>
        </div>
        <div class="form-group">
            <label for="pwd">Passwort</label>
            <input type="password" class="form-control" name="pwd" required>
        </div>
        <div class="form-group">
            <label for="pwd2">Passwort wiederholen</label>
            <input type="password" class="form-control" name="pwd2" required>
        </div>
        <button type="submit" name="submit" class="btn btn-default bg-dark">Registrieren</button>
    </form>

<?php
    if(isset($_GET['error']))
    {
        if($_GET['error'] == "emptyinput")
        {
            echo "<p>Sie müssen alle Felder ausfüllen!</p>";
        }
        elseif($_GET['error'] == "invalidfirstname")
        {
            echo "<p>Der Vorname entspricht nicht den Vorgaben. Es dürfen nur Groß und Klein-Buchstaben verwendet werden.</p>";
        }
        elseif($_GET['error'] == "invalidlastname")
        {
            echo "<p>Der Nachname entspricht nicht den Vorgaben. Es dürfen nur Groß und Klein-Buchstaben verwendet werden.</p>";
        }
        elseif($_GET['error'] == "invalidtelephonenumber")
        {
            echo "<p>Die Telefonnummer entspricht nicht den Vorgaben. Es dürfen nur Zahlen verwendet werden.</p>";
        }
        elseif($_GET['error'] == "invalidemail")
        {
            echo "<p>Die E-Mail entspricht nicht den Vorgaben. Bitte folgendes Format verwenden: mustermann@muster.at</p>";
        }
        elseif($_GET['error'] == "invalidadress")
        {
            echo "<p>Die Adresse entspricht nicht den Vorgaben. Es dürfen nur Groß und Klein-Buchstaben und Zahlen verwendet werden.</p>";
        }
        elseif($_GET['error'] == "passwordsdontmatch")
        {
            echo "<p>Die Passwörter stimmen nicht überein. Bitte versuchen Sie es nochmal.</p>";
        }
        elseif($_GET['error'] == "emailtaken")
        {
            echo "<p>Dieser E-Mail Adresse ist schon vergeben.</p>";
        }
        elseif($_GET['error'] == "none")
        {
            echo "<p>Sie wurden erfolgreich registriert.</p>";
        }
    }
?>

<?php
    include_once 'footer.php';
?>