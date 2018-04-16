<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <title>Modifica Torneo</title>
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <h2>Modifica Torneo</h2>
                <br><br>
                <div class="fadeIn first">
                    <img src="http://www.antiracketliberaimpresa.it/wp-content/uploads/coppa.png" width="30%">
                </div>
                <br>
                <form action="pagine/home.php" method="post">
                    <input type="text" id="nomeTm" class="fadeIn second" placeholder="Nome Torneo" required>
                    <input type="text" id="dataCm" class="fadeIn second" placeholder="Data Creazione: " disabled>
                    <input type="text" id="numPm" class="fadeIn second" placeholder="Numero Partecipanti" required>
                    <input type="text" id="tornGm" class="fadeIn second" placeholder="Torneo di" required>
                    <input type="submit" class="fadeIn third" value="Modifica">
                </form>

                <a href="home.php">Torna alla home</a>
                <br><br>
            </div>
        </div>
        <?php
        ?>
    </body>
</html>
