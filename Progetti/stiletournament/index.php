<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php
        session_start();
        ?>
        <?php
        if (isset($_GET["reg"])) {
            ?>
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <h2>Registrazione</h2>

                    <div class="fadeIn first">
                        <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
                    </div>

                    <form action="pagine/home.php" method="post">
                        <input type="text" id="login" class="fadeIn second" name="user" placeholder="Nome Utente" required>
                        <input type="password" id="password" class="fadeIn third" name="psw" placeholder="Password" required>
                        <input type="password" id="passwordConferma" class="fadeIn third" name="pswConferma" placeholder="Conferma Password" required>
                        <input type="submit" class="fadeIn fourth" value="Crea">
                    </form>

                    <a href="index.php">Vai all'accesso</a>
                    <br><br>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <h2>Accesso</h2>

                    <div class="fadeIn first">
                        <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
                    </div>

                    <form action="pagine/login.php" method="post">
                        <input type="text" id="login" class="fadeIn second" name="user" placeholder="Nome Utente" required>
                        <input type="password" id="password" class="fadeIn third" name="psw" placeholder="Password" required>
                        <input type="submit" class="fadeIn fourth" value="Accedi">
                    </form>

                    <a href="?reg"> Crea nuovo account</a>
                    <br><br>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($_SESSION["errore"])) {       //se p settata la variabile di sessione "errore" viene visualizzata un messaggio di errore
            echo "<div> " . $_SESSION["errore"] . "</div>";
            unset($_SESSION["errore"]);
        }
        ?>
    </body>
</html>