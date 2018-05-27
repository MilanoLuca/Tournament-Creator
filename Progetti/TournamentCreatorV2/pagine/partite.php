<html>
    <head>
        <meta charset="UTF-8">
        <title>Partite</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <div class="fadeIn first">
                    <?php
                    session_start();
                    if (!isset($_SESSION["id"])) {
                        header("Location: ..\index.php ");
                    } else {
                        include './connessione.php';
                        echo "<h1>Benvenuto, " . $_SESSION["user"] . "! </h1>";   //stampa il nome utente con il quale si è loggati
                        
                        //seleziono la fase corrente del torneo
                        $query = "SELECT FaseCorrente "
                               . "FROM torneo "
                               . "WHERE IDTorneo=" . $_SESSION["idTorneo"] . ";";
                        //la query resituisceuna tabella con solo una riga con e una sola colonna "FaseCorrente"
                        $result = mysqli_query($connesione, $query);
                        $faseCorrente = mysqli_fetch_array($result)["FaseCorrente"];
                        
                        //Se tutte le partite hanno un punteggio assegnato e viene 
                        //premuto il pulsante per passare alla prossima fase
                        //viene effettuato passaggio alla prossima fase
                        //(scontro tra le squadre vincitrici della fase precedente)
                        $prossimaFase = FALSE;
                        if(isset($_POST["prossimaFase"])){
                            $faseCorrente++;
                            $prossimaFase = TRUE;
                            //aggiorno la fase del torneo
                            $query = "UPDATE torneo "
                                   . "SET FaseCorrente=$faseCorrente "
                                   . "WHERE IDTorneo=" . $_SESSION["idTorneo"] . ";";
                            mysqli_query($connesione, $query)
                                    or die("Passaggio alla fase successiva fallito");
                        }
                        
                        //query che seleziona i dati di tutte le partite del torneo selezionato
                        $query = "SELECT IDPartita "
                               . "FROM partita, torneo "
                               . "WHERE torneo.IDTorneo = " . $_SESSION["idTorneo"] . " AND "
                               . "torneo.IDTorneo = partita.IDTorneo AND "
                               . "partita.Fase = torneo.FaseCorrente";

                        $result = mysqli_query($connesione, $query)
                                or die("Selezione partite fallita");
                        /*
                         * 
                         * - se non c'e nessuna partita creare partite distribuendo casualmente gli id le squadre
                         * - se esistono ancora delle partite a cui manca idvincitrice, stampare tutte le partite con il relativo punteggio se assegnato (e link per assegnare i punteggi)
                         * - quando tutte le partite hanno un vincitore creare le partite successive utilizzando gli id dei vincitori come nuovi id delle squadre
                         * 
                         */

                        if (mysqli_num_rows($result) == 0) {
                            //se la fase corrente del torneo non ha ancora partite
                            //vengono create le partite
                            
                            //seleziono le squadre del torneo che partecipano alle partite della fase corrente
                            $query = "";
                            if(!$prossimaFase){
                                $query = "SELECT IDSquadra, squadra.Nome "
                                       . "FROM squadra , torneo "
                                       . "WHERE torneo.IDTorneo = " . $_SESSION["idTorneo"] . " AND "
                                       . "torneo.IDTorneo = squadra.IDTorneo;";
                            }
                            else {
                                //se è avvenuto il passaggio alla prossima fase 
                                //seleziono le squadre vincitrici della fase precedente 
                                $query = "SELECT IDSquadra, squadra.Nome "
                                       . "FROM squadra, partita "
                                       . "WHERE partita.IDTorneo = " . $_SESSION["idTorneo"] . " AND "
                                             . "partita.IDTorneo = squadra.IDTorneo "
                                             . "AND partita.IDVincitrice = squadra.IDSquadra "
                                             . "AND partita.Fase = " . ($faseCorrente-1) . ";";
                            }
                            
                           echo $query;
                            $result = mysqli_query($connesione, $query)
                                    or die("Selezione squadre fallita");

                            //copio le squadre in un array
                            $squadre = array();
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $squadre[$i]["ID"] = $row["IDSquadra"];
                                $squadre[$i]["Nome"] = $row["Nome"];
                                $i++;
                            }

                            //query per creazione partite

                            for ($i = 0; $i < count($squadre); $i += 2) {
                                //creo una nuova partita
                                $query = "INSERT INTO partita (IDTorneo,Fase) "
                                       . "VALUES (" . $_SESSION["idTorneo"] . ",$faseCorrente);";
                                mysqli_query($connesione, $query)
                                        or die("Query creazione partite non è andata a buon fine");
                                //visto che IDPartita è auto increment 
                                //uso il metodo che ricava l'ultimo valore auto increment 
                                $idPartita = mysqli_insert_id($connesione);

                                $querySquadra1 = "INSERT INTO gioca(FKSquadra, IDTorneoSquadra, FKPartita, IDTorneoPartita) "
                                        . "VALUES (" . $squadre[$i]["ID"] . "," . $_SESSION["idTorneo"] . ",$idPartita," . $_SESSION["idTorneo"] . ");";

                                $querySquadra2 = "INSERT INTO gioca(FKSquadra, IDTorneoSquadra, FKPartita, IDTorneoPartita) "
                                        . "VALUES (" . $squadre[$i + 1]["ID"] . "," . $_SESSION["idTorneo"] . ",$idPartita," . $_SESSION["idTorneo"] . ");";

                                //combino le squadre
                                mysqli_query($connesione, $querySquadra1)
                                        or die("Query inserimento squadra fallito");
                                mysqli_query($connesione, $querySquadra2)
                                        or die("Query inserimento squadra fallito");
                            }
                        }

                        //visualizzazione partite
                        echo "<br>Partite del torneo:<br><br>";
                        //se esistono ancora delle partite a cui manca idvincitrice, 
                        //vengono stampate tutte le partite con il relativo punteggio se assegnato (e link per assegnare i punteggi)
                        $query = "SELECT partita.IDPartita, squadra.Nome, Punteggio "
                               . "FROM partita, gioca, squadra "
                               . "WHERE partita.IDPartita=gioca.FKPartita AND "
                                     . "squadra.IDSquadra=gioca.FKSquadra AND "
                                     . "squadra.IDTorneo=" . $_SESSION["idTorneo"] . " AND "
                                     . "partita.IDTorneo=" . $_SESSION["idTorneo"] . " AND "
                                     . "partita.Fase = $faseCorrente;";
                        $result = mysqli_query($connesione, $query);
                        $arrayPunteggi = array();
                        $i = 0;
                        
                        //copio la tabella risultante dalla query in un array
                        while ($row = mysqli_fetch_array($result)) {
                            $arrayPunteggi[$i] = array("IDPartita" => $row["IDPartita"],
                                "Nome" => $row["Nome"],
                                "Punteggio" => $row["Punteggio"]);
                            $i++;
                        }
                        
                        //per ogni partita creo un array associativo con chiavi: (IDPartita, Squadra1, Punteggio1, Squadra2, Punteggio2)
                        $partite = array();
                        $i = 0;
                        $k = 0;
                        $lunghezza = count($arrayPunteggi);
                        while ($i < $lunghezza) {
                            if (isset($arrayPunteggi[$i])) {

                                $j = 0;
                                $trovato = FALSE;
                                while ($j < $lunghezza && !$trovato) {
                                    if (isset($arrayPunteggi[$j])) {
                                        if ($arrayPunteggi[$i]["IDPartita"] == $arrayPunteggi[$j]["IDPartita"] &&
                                                $arrayPunteggi[$i]["Nome"] != $arrayPunteggi[$j]["Nome"]) {
                                            $trovato = TRUE;
                                            $partite[$k] = array("IDPartita" => $arrayPunteggi[$i]["IDPartita"],
                                                "Squadra1" => $arrayPunteggi[$i]["Nome"],
                                                "Punteggio1" => $arrayPunteggi[$i]["Punteggio"],
                                                "Squadra2" => $arrayPunteggi[$j]["Nome"],
                                                "Punteggio2" => $arrayPunteggi[$j]["Punteggio"]);


                                            if ($partite[$k]["Punteggio1"] == NULL) {
                                                $partite[$k]["PartitaConclusa"] = FALSE;
                                            } else {
                                                $partite[$k]["PartitaConclusa"] = TRUE;
                                            }


                                            unset($arrayPunteggi[$i]);
                                            unset($arrayPunteggi[$j]);
                                            $k++;
                                        }
                                    }
                                    $j++;
                                }
                            }
                            $i++;
                        }

                        //stampo partite in una tabella con ordine Squadra1-Squadra2 Punteggio1-Punteggo2
                        echo '<table align="center">'
                        . '<tr>'
                        . '<th>Partita</th>'
                        . '<th>Punteggio</th>'
                        . '<th>Modifica</th>'
                        . '</tr>';
                        foreach ($partite as $partita) {
                            ?>

                            <tr>
                                <td><?php echo $partita["Squadra1"] . ' - ' . $partita["Squadra2"]; ?></td>
                                <td>
                                    <?php
                                    if ($partita["PartitaConclusa"]) {
                                        echo $partita["Punteggio1"] . ' - ' . $partita["Punteggio2"];
                                    } else {
                                        //punteggio non assegnato
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="assegnaPunteggi.php?IDPartita=<?php echo $partita["IDPartita"] ?>">
                                        <?php
                                        if ($partita["PartitaConclusa"]) {
                                            echo 'Modifica punteggio';
                                        } else {
                                            echo 'Assegna punteggio';
                                        }
                                        ?>
                                    </a>
                                </td>
                            </tr>

                            <?php
                        }
                        echo '</table><br>';
                        echo '<a href="MieiTornei.php">Torna indietro</a><br><br>';


                        //pulsante prossima fase
                        $query = "SELECT partita.IDPartita FROM partita WHERE partita.IDVincitrice IS NULL AND partita.IDTorneo=" . $_SESSION["idTorneo"] . ";";
                        $result = mysqli_query($connesione, $query);

                        //mysqli_num_rows conta le righe della tabella risultante
                        if (mysqli_num_rows($result) == 0) {
                            //visualizzo il pulsante per passare alla prossima fase del torneo
                            ?>
                            <form name="prossimaFase" action="" method="POST">
                                <input type="submit" name="prossimaFase" value="Passa alla fase successiva">
                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
