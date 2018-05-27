<?php
    if(isset($_POST["inserisciPunteggi"])){
        session_start();
        include './connessione.php';
        
        $p1 = $_POST["p1"];
        $p2 = $_POST["p2"];
        $IDSquadra1 = $_POST["squadra1"];
        $IDSquadra2 = $_POST["squadra2"];
        $idPartita = $_POST["idPartita"];
        
        //inserimento dei punteggi relativi alle squadre
        //squadra1
        $query = "UPDATE gioca SET Punteggio=$p1 "
               . "WHERE FKPartita=$idPartita AND "
                     . "FKSquadra=$IDSquadra1; ";
        
        mysqli_query($connesione, $query)
                or die("Inserimento punteggi fallito");
        //squadra2
        $query = "UPDATE gioca SET Punteggio=$p2 "
               . "WHERE FKPartita=$idPartita AND "
                     . "FKSquadra=$IDSquadra2;";
        
        mysqli_query($connesione, $query)
                or die("Inserimento punteggi fallito");
        
        //inserimento squadra vincitrice
        $IDVincitrice = $IDSquadra1;
        if($p1 < $p2){
            $IDVincitrice = $IDSquadra2;
        }
        
        $query = "UPDATE partita "
               . "SET IDVincitrice=$IDVincitrice,IDTorneoVincitrice=" . $_SESSION["idTorneo"] . " "
               . "WHERE IDPartita=$idPartita;";
        
       mysqli_query($connesione, $query)
               or die("Inserimento vincitrice fallito");
       
    }
    header("Location: partite.php");

