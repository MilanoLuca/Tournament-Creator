<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>

        <?php
        if (isset($_GET["del"])) {
            ?>
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <br><br>
                    <div class="fadeIn first">
                        <img src="http://www.antiracketliberaimpresa.it/wp-content/uploads/coppa.png" width="30%">
                    </div>
                    <h2>Sei sicuro di voler cancellare il torneo?</h2>
                    <br><br>
                    <form action="home.php" method="post">
                        <input type="submit" class="fadeIn second" value="SI">
                        <input type="submit" class="fadeIn second" value="NO">
                    </form>
                </div>
            </div>
        <?php } else {
            ?>
            <div class="wrapper fadeInDown">
                <div id="formContent2">
                    <h1>Benvenuto, @nomeutente</h1>
                    <br>
                    <h2>Ecco i tuoi tornei:</h2>
                    <br>

                    <table id="table" align="center">
                        <tr>
                            <th>●</th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data Creazione</th>
                            <th>Numero giocatori</th>
                            <th>Gioco</th>
                            <th>Info</th>
                        </tr>
                        <tr>
                            <td><input type="radio" name="selection"><br></td>
                            <td>1</td>
                            <td>Tombolina 5INB</td>
                            <td>27/03/18</td>
                            <td>4</td>
                            <td>Briscola</td>
                            <td><a href="visualizza.php?id=1">+ info</a></td><!-- pagina visualizza torneo -->
                        </tr>
                        <tr>
                            <td><input type="radio" name="selection"><br></td>
                            <td>2</td>
                            <td>Tombolin 5INC</td>
                            <td>09/04/18</td>
                            <td>4</td>
                            <td>Briscola</td>
                            <td><a href="visualizza.php?id=1">+ info</a></td><!-- pagina visualizza torneo -->
                        </tr>
                    </table>
                    <br><br>
                    <a href="nuovoTorneo.php">Nuovo torneo</a> | <a href="modificaTorneo.php">Modifica torneo</a> | <a href="?del">Elimina torneo</a>
                    <br><br>
                </div>
            </div>
            <?php
        }
        ?>
    </body>
</html>
