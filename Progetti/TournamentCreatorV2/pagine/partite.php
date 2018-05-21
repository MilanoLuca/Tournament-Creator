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
                    include './connessione.php';
                    echo "<h1>Benvenuto, " . $_SESSION["user"] . "! </h1>";   //stampa il nome utente con il quale si è loggati
                    //query che seleziona i dati di tutti i tornei appartenenti all'utente che si è loggato
                    $query = "SELECT IDPartita FROM partita, torneo WHERE torneo.IDTorneo = " . $_SESSION["idTorneo"] . " AND torneo.IDTorneo = partita.IDTorneo";
                    $result = mysqli_query($connesione, $query)
                            or die("query sbagliata");
                    /*
                     * LISTA DELLE COSE DA FARE
                     * 
                     * - se non c'e nessuna partita creare partite distribuendo casualmente gli id  le squadre
                     * - se esistono già delle partite stampare solamente quelle a cui manca idvincitore
                     * - quando tutte le partite hanno un vincitore creare le partite successive utilizzando gli id dei vincitori come nuovi id delle squadre
                     * 
                     */

                    if (mysqli_num_rows($result) == 0) {
                        echo "<br>Non hai partite<br><br>";
                        $query = "SELECT IDSquadra, squadra.Nome FROM squadra , torneo WHERE torneo.IDTorneo = " . $_SESSION["idTorneo"] . " AND torneo.IDTorneo = squadra.IDTorneo";
                        $result = mysqli_query($connesione, $query)
                                or die("query sbagliata");

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
                            $query = "INSERT INTO partita (IDTorneo) VALUES (" . $_SESSION["idTorneo"] . ");";
                            echo $query;
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
                    } else {
                        //se esistono già delle partite stampare solamente quelle a cui manca idvincitore
                        //queri non funziona, da modificare
                        $query = "SELECT * FROM partita, squadra s1, squadra s2, gioca g1, gioca g2 WHERE partita.IDPartita = g1.FKPartita AND g1.FKSquadra = s1.IDSquadra AND partita.IDPartita = g2.FKPartita AND g2.FKSquadra = s2.IDSquadra AND partita.IDVincitrice IS NULL AND partita.IDTorneo = 23;";

                        echo "<br>Partite<br><br>";
                        
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
