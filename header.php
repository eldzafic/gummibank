<?php
    session_start();
?>

<html lang="de">

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Gummibärbank</title>
    <meta charset="UTF-8">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav">
                <a class="nav-link active" href="index.php">Home</a>
                <a class="nav-link active" href="models/impressum.html">Impressum</a>
                <?php
                    if(isset($_SESSION["userid"]))
                    {
                        if($_SESSION["mitarbeiter"] === 1)
                        {
                            echo "<a class='nav-link active' href='mitarbeiter.php'>Mitarbeiter</a>";
                            echo "<a class='nav-link active' href='includes/logout.inc.php'>Logout</a>";
                        }
                        else
                        {
                            echo "<a class='nav-link active' href='dashboard.php'>Dashboard</a>";
                            echo "<a class='nav-link active' href='ueberweisung.php'>Überweisung</a>";
                            echo "<a class='nav-link active' href='includes/logout.inc.php'>Logout</a>";
                        }
                    }
                    else
                    {
                        echo "<a class='nav-link active' href='login.php'>Login</a>";
                        echo "<a class='nav-link active' href='register.php'>Registrieren</a>";
                    }
                ?>
            </div>
        </div>
    </div>
</nav>