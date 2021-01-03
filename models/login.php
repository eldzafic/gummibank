<?php
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
    <form action="login.php" id="loginform" method="post">
        <div class="form-group">
            <label for="benutzername">Vorname</label>
            <input type="text" class="form-control" id="benutzername" required>
        </div>
        <div class="form-group">
            <label for="passwort">Passwort</label>
            <input type="password" class="form-control" id="passwort" required>
        </div>

        <button type="submit" class="btn btn-default bg-dark">Login</button>
    </form>
</body>
</html>
