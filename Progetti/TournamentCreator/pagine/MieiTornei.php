<html>
    <head>
        <meta charset="UTF-8">
        <title>I miei tornei</title>
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
                        //query che seleziona i dati di tutti i tornei appartenenti all'utente che si è loggato
                        $query = "SELECT torneo.IDTorneo,utente.NomeUtente,tipo.Nome as Tipo,torneo.Nome,torneo.DataCreazione,torneo.NomeGioco "
                                . "FROM torneo,tipo,utente "
                                . "WHERE torneo.FKTipo = tipo.IDTipo AND "
                                . "torneo.IDAdmin = " . $_SESSION["id"] . " AND "
                                . "utente.IDUtente = " . $_SESSION["id"];

                        echo "<br>I tuoi tornei:<br><br>";
                        $result = mysqli_query($connesione, $query)
                                or die("query sbagliata");
                        ?>
                        <!--Stampa la tabella contenete i dati dei tornei -->

                        <table align="center" border="1">
                            <tr>
                                <th>Nome Torneo</th>
                                <th>Tipo Torneo</th>
                                <th>Data creazione</th>
                                <th>Torneo di</th>
                                <th>Modifica</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>"
                                . "<td>" . $row["Nome"] . "</td>"
                                . "<td>" . $row["Tipo"] . "</td>"
                                . "<td>" . $row["DataCreazione"] . "</td>"
                                . "<td>" . $row["NomeGioco"] . "</td>"
                                /* link che manda alla pagina per la gestione del toreneo */
                                . "<td><a href=\"gestioneTorneo.php?idTorneo=" . $row["IDTorneo"] . "\">Gestisci</a>  </td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                    <br>
                    <div class="fadeIn second">
                        <form action="nuovoTorneo.php"> <!--Form che manda alla pagina per la creazione di un nuovo torneo -->
                            <input type="submit" value="Crea Torneo" name="crea" />
                        </form>
                    </div>
                    <div class="fadeIn third">
                        <form action="logout.php"> <!--Form che manda alla pagina per la creazione di un nuovo torneo -->
                            <input type="submit" value="Disconnessione" name="lg" />
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </body>
</html>
