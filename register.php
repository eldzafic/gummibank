<?php
    include_once 'header.php';
?>

    <form action="./includes/register.inc.php" method="post">
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
            <label for="password">Passwort</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="password2">Passwort wiederholen</label>
            <input type="password" class="form-control" name="password2" required>
        </div>
        <button type="submit" class="btn btn-default bg-dark">Registrieren</button>
    </form>

<?php
    include_once 'footer.php';
?>
