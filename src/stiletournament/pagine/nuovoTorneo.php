<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <title>Crea Nuovo Torneo</title>
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <h2>Creazione Torneo</h2>
                <br><br>
                <div class="fadeIn first">
                    <img src="http://www.antiracketliberaimpresa.it/wp-content/uploads/coppa.png" width="30%">
                </div>
                <br>
                <form action="pagine/home.php" method="post">
                    <input type="text" id="nomeT" class="fadeIn second" placeholder="Nome Torneo" required>
                    <input type="text" id="dataC" class="fadeIn second" placeholder="Data Creazione" required>
                    <input type="text" id="numP" class="fadeIn second" placeholder="Numero Partecipanti" required>
                    <input type="text" id="tornG" class="fadeIn second" placeholder="Torneo di" required>
                    <input type="submit" class="fadeIn third" value="Crea">
                </form>

                <a href="home.php">Torna alla home</a>
                <br><br>
            </div>
        </div>
        <?php
        ?>
    </body>
</html>
