<?php

$dbHost = "localhost";
$dbName = "tournament";
$dbUser = "root";
$dbPsw = "";

$connesione = mysqli_connect($dbHost, $dbUser, $dbPsw)
        or die("Connessoine fallita");

mysqli_select_db($connesione, $dbName)
        or die("Impossibile selzionare il DataBase");
?>