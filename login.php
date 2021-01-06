<?php
include_once 'header.php';
?>

<form action="includes/login.inc.php" method="post">
    <div class="form-group">
        <label for="email">E-Mail</label>
        <input type="email" class="form-control" name="benutzername" required>
    </div>
    <div class="form-group">
        <label for="pwd">Passwort</label>
        <input type="password" class="form-control" name="kennwort" required>
    </div>
    <button type="submit" name="submit" class="btn btn-default bg-dark">Log in</button>
</form>

<?php
if(isset($_GET['error']))
{
    if($_GET['error'] == "emptyinput")
    {
        echo "<p>Sie müssen alle Felder ausfüllen!</p>";
    }
    elseif($_GET['error'] == "wronglogin")
    {
        echo "<p>Benutzername/Passwort ist falsch.</p>";
    }
}
?>

<?php
include_once 'footer.php';
?>
