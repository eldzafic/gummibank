<?php
/*
if (isset($_POST['submit']))
{
    $benutzername = $_POST['benutzername'];
    $passwort = $_POST['passwort'];

    echo $benutzername;
}
*/

?>

<html lang="de">
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Login</title>
    <meta charset="UTF-8">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbar">
                <div class="navbar-nav">
                    <a class="nav-link active" href="../index.php">Home</a>
                    <a class="nav-link active" href="impressum.html">Impressum</a>
                    <a class="nav-link active" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <h1 class="text-center">Onlinebanking Login</h1>

    <form action="authenticate.php" method="post">
        <div class="form-group">
            <label for="username">Vorname</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Passwort</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-default bg-dark">Login</button>
    </form>

</body>
</html>
