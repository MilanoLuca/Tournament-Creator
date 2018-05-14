<?php

include './connessione.php'; //include la connessione al database per l'accesso alla tabella utenti
session_start();
$result = mysqli_query($connesione, "INSERT INTO utente (NomeUtente, Password) VALUES ('" . $_POST["user"] . "', '" . $_POST["pass"] . "')") //seleziona tutti gli utenti con username e password inseiti 
        or die("query errata");
header("Location: ../index.php");
?>