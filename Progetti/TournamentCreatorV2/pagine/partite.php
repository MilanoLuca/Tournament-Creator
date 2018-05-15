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
                    echo "<br>Partite<br><br>";
                    $result = mysqli_query($connesione, $query)
                            or die("query sbagliata");
                    /*
                     * LISTA DELLE COSE DA FARE
                     * 
                     * - se non c'e nessuna partita creare partite distribuendo casualmente gli id  le squadre
                     * - se esistono già delle partite stampare solamente quelle a cui manca idvincitore
                     * - quando tutte le partite hanno un vincitore creare le partite successive utilizzando gli id dei vincitori come nuovi id delle squadre
                     * 
                     * per eventuali problemi contattate Gabriele Ceccato su slack
                     */

                    if (mysqli_num_rows($result) == 0) {
                        echo "<br>Non hai partite<br><br>";
                        $query = "SELECT IDSquadra, Nome FROM squadra, torneo WHERE torneo.IDTorneo = " . $_SESSION["idTorneo"] . "AND torneo.IDTorneo = squadra.IDTorneo";
                        echo "<br>Partite<br><br>";
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
                        $query = "INSERT INTO partita (IDTorneo) VALUES (<ID TORNEO per numero squadre/2 volte>)";
                    } else {
                        
                    }
                    ?>

                </div>

            </div>

        </div>
    </body>
</html>
