<?php
include_once 'header.php';
?>

<form action="./includes/login.inc.php" method="post">
    <div class="form-group">
        <label for="email">E-Mail</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Passwort</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <button type="submit" class="btn btn-default bg-dark">Log in</button>
</form>

<?php
include_once 'footer.php';
?>
