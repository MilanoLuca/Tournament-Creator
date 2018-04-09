<?php

function connetti() {
    $host = "localhost";
    $user = "root"; //user di default del DBMS
    $password = ""; //relativa password (è una stringa vuota)
    $database = "tournament";

    $connessione = mysqli_connect($host, $user, $password, $database);

    if (mysqli_error($connessione)) {
        die("Impossibile connettersi al database");
    }

    return $connessione;
}

function disconnetti($connessione) {
    mysqli_close($connessione);
}

function visualizzaTornei() {
    $utente = ""; //da sessione?
    $query = "SELECT t.ID, t.Nome, t.DataCreazione, COUNT(s.ID) AS NumeroGiocatori, t.NomeGioco FROM torneo t, utente u, squadra s WHERE t.IDAdmin = u.ID AND u.Nome = '$utente' AND s.IDTorneo = t.ID GROUP BY t.ID";

    $conn = connetti();
    $result = mysqli_query($conn, $query);
    disconnetti($conn);
}
?>