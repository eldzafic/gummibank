<?php

//echo "<script>window.print()</script>"


$datum = date("d.m.Y H:i:s");

?>

<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Beleg für Kunden</title>
</head>

<body>

    <div class="container">
        <?php
        echo $datum;
        ?>
        <h1 class="text-center"><b>BELEG</b></h1>

    </div>

</body>
</html>


