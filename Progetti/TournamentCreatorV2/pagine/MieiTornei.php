<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>I miei tornei</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php
        session_start();
        include './connessione.php';
        echo "<h1>Benvenuto " . $_SESSION["user"] . " </h1>";   //stampa il nome utente con il quale si è loggati
        //query che seleziona i dati di tutti i tornei appartenenti all'utente che si è loggato
        $query = "SELECT        
            torneo.IDTorneo,
    utente.NomeUtente,
    tipo.Nome as Tipo,
    torneo.Nome,
    torneo.DataCreazione,
    torneo.NomeGioco
FROM
    torneo,
    tipo,
    utente
WHERE
    torneo.FKTipo = tipo.IDTipo AND torneo.IDAdmin = " . $_SESSION["id"] ." AND utente.IDUtente = ".$_SESSION["id"];

        echo "I miei tornei<br> <br>";
        $result = mysqli_query($connesione, $query)
                or die("query sbagliata");
        ?>
        <!--Stampa la tabella contenete i dati dei tornei -->
        <table>
            <tr>
                <th>Nome Torneo</th>
                <th>Tipo Torneo</th>
                <th>Data creazione</th>
                <th>Torneo di</th>
                <th>Modifica</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                <td>" . $row["Nome"] . "</td>
                <td>" . $row["Tipo"] . "</td>
                <td>" . $row["DataCreazione"] . "</td>
                <td>" . $row["NomeGioco"] . "</td>
                <td><a href=\"gestioneTorneo.php?idTorneo=" . $row["IDTorneo"] . "\">Gestisci</a>  </td>"; //link che manda alla pagina per la gestione del toreneo
                //al link è concatenato l'id del torneo che sarà utilizato per selezionare il torneo specifico
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <form action="nuovoTorneo.php"> <!--Form che manda alla pagina per la creazione di un nuovo torneo -->
            <input type="submit" value="Crea Torneo" name="crea" />
        </form>

    </body>
</html>
