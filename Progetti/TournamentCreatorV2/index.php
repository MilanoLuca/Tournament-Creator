<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php
        session_start();
        ?><?php
        if (isset($_GET["reg"])) {
            ?>
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <h2>Registrazione</h2>

                    <div class="fadeIn first">
                        <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
                    </div>

                    <form action="pagine/signin.php" method="post">
                        <input type="text" name="user" class="fadeIn second" placeholder="Nome Utente" required>
                        <input type="password" name="pass" class="fadeIn third" placeholder="Password" required>
                        <input type="password" name="pass" class="fadeIn third" placeholder="Conferma Password" required>
                        <input type="submit" name="login" class="fadeIn fourth" value="Registrati">
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
                    <form name="login" method="POST" action="pagine/login.php">
                        <input type="text" name="user" class="fadeIn second" placeholder="Nome Utente" required>
                        <input type="password" name="pass" class="fadeIn third" placeholder="Password" required>
                        <input type="submit" name="login" class="fadeIn fourth" value="Accedi">
                    </form>
                    <a href="?reg"> Crea nuovo account</a>
                    <br><br>
                </div>
            </div>
            <?php
        }
        if (isset($_SESSION["errore"])) {       //se p settata la variabile di sessione "errore" viene visualizzata un messaggio di errore
            echo "<div> " . $_SESSION["errore"] . "</div>";
            unset($_SESSION["errore"]);
        }
        ?>

    </body>
</html>
