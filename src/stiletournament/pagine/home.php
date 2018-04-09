<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <?php
        include './funzioniDB.php';
        ?>
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent2">
                <h1>Benvenuto, @nomeutente</h1>
                <br>
                <h2>Ecco i tuoi tornei:</h2>
                <br><br>
                
                <table id="table" align="center">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data Creazione</th>
                        <th>Numero giocatori</th>
                        <th>Gioco</th>
                        <th>Info</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Tombolina 5INB</td>
                        <td>27/03/18</td>
                        <td>4</td>
                        <td>Briscola</td>
                        <td><a href="visualizza.php?id=1"><span class="glyphicon glyphicon-plus-sign"></span></a></td><!-- pagina visualizza torneo -->
                    </tr>
                </table>
                <br>
                <a href="../index.php">Nuovo torneo</a>
                <br>
                <a href="../index.php">Modifica torneo</a>
                <br>
                <a href="../index.php">Elimina torneo</a>
                <br>
                <a href="../index.php">Aggiungi spettatore</a>
                <br><br>
            </div>
        </div>
        <?php
        ?>
    </body>
</html>
