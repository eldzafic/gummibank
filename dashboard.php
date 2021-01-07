<?php
    include_once 'header.php';
?>

<?php
    if(isset($_SESSION["lastname"]))
    {
        echo "<p>Willkommen zurück Herr " .$_SESSION["lastname"] ."!</p>";
    }
?>

<?php
include_once 'footer.php';
?>


