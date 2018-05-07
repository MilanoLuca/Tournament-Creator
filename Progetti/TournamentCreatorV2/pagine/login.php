<?php
include './connessione.php'; //include la connessione al database per l'accesso alla tabella utenti
session_start();

$result = mysqli_query($connesione, "Select * from utente where NomeUtente='" . $_POST["user"] . "' and Password='" . $_POST["pass"] . "'") //seleziona tutti gli utenti con username e password inseiti 
        or die("query errata"); //altreimenti blocca l'esecuzione e mostra un messaggio d'errore

if (mysqli_num_rows($result) == 1) {    //se la query ha 1 solo risultato salva le variabile dell'utente in variabili di sessione per poter essere visualizzate in tutte le altre pagine
    $row = mysqli_fetch_array($result);
    $_SESSION["id"] = $row["IDUtente"];
    $_SESSION["user"] = $row["NomeUtente"];
    $_SESSION["psw"] = $row["Password"];


    header("Location: ./MieiTornei.php"); //manda alla pagina con tutti i tornei
} else {
    $_SESSION["errore"] = "Utente non esistente"; //se non esiste nessun utente viene generato il messaggio d'errore e si è rimandati alla pagina di login
    header("Location: ../index.php");
}
?>