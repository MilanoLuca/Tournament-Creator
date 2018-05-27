<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Assegnazione punteggio</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/controlliform.js" type="text/javascript"></script>
        <?php
            include 'connessione.php';
            session_start();
        ?>
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <div class="fadeIn first">
                    <?php
                        if(isset($_GET["IDPartita"])){
                            $idPartita = $_GET["IDPartita"];
                            //dal database seleziono i nomi e gli id delle squadre
                            $query = "SELECT squadra.IDSquadra,squadra.Nome,gioca.Punteggio "
                                   . "FROM squadra, gioca, partita "
                                   . "WHERE squadra.IDSquadra = gioca.FKSquadra AND "
                                         . "gioca.FKPartita = partita.IDPartita AND "
                                         . "partita.IDPartita = " . $idPartita . " AND "
                                         . "partita.IDTorneo = " . $_SESSION["idTorneo"] . " AND "
                                         . "squadra.IDTorneo = " . $_SESSION["idTorneo"] . ";";

                            $result = mysqli_query($connesione, $query)
                                    or die("Query sbagliata");

                            $squadra1 = mysqli_fetch_array($result);
                            $squadra2 = mysqli_fetch_array($result);

                    ?>

                    <form name="frmPunteggi" action="inserimentoPunteggi.php" method="POST" onsubmit="return controlloPunteggi();">
                        <table align="center">
                            <tr>
                                <th>Nome squadra</th>
                                <th>Punteggio</th>
                            </tr>
                            <tr>
                                <td><?php echo $squadra1["Nome"];?></td>
                                <td>
                                    <input type="text" name="p1" value="<?php echo $squadra1["Punteggio"];?>" class="fadeIn second" required="">
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $squadra2["Nome"];?></td>
                                <td>
                                    <input type="text" name="p2" value="<?php echo $squadra2["Punteggio"];?>" class="fadeIn third" required="">
                                </td>
                            </tr>
                        </table>
                        <!-- ID delle squadre -->
                        <input type="hidden" name="squadra1" value="<?php echo $squadra1["IDSquadra"];?>">
                        <input type="hidden" name="squadra2" value="<?php echo $squadra2["IDSquadra"];?>">

                        <input type="hidden" name="idPartita" value="<?php echo $idPartita;?>">

                        <input type="submit" name="inserisciPunteggi" value="Modifica">
                    </form>

                    <?php

                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
