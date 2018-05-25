<html>
    <head>
        <meta charset="UTF-8">
        <title>Crea Torneo</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION["id"])) {
            header("Location: ..\index.php ");
        } else {
            include './connessione.php';
            if (isset($_POST["aggiungi"])) {  //se è stato cliccato il pulsante per l'immisisione viene inserito nel database un nuovo torneo con i dqati inseriti nel form la data corrente e come admin l'id con cui si è loggata la sessione
                $query = "INSERT INTO `torneo`( `FKTipo`, `Nome`, `DataCreazione`, `NomeGioco`, `IDAdmin`) VALUES ('1','" . $_POST["nome"] . "',CURRENT_DATE,'" . $_POST["gioco"] . "','" . $_SESSION["id"] . "')";
                echo $query;
                mysqli_query($connesione, $query)
                        or die("jadsgfkhwsa");
                unset($_POST["aggiungi"]);
                header("Location: ./MieiTornei.php");
            }
            ?>
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <div class="fadeIn first">
                        <h1>Crea un nuovo torneo</h1><br>

                        <form id="NuovoTorneo" action="#" method="POST">
                            <table align="center">
                                <tr>
                                    <td>Tipologia del Torneo</td>
                                    <td><input type="text" name="nome" placeholder="Tipologia" value="Eliminazione diretta" readonly required> </td>
                                </tr>
                                <tr>
                                    <td>Nome del Torneo</td>
                                    <td><input type="text" name="nome" placeholder="Nome" required> </td>
                                </tr>
                                <tr>
                                    <td>Torneo di</td>
                                    <td><input type="text" name="gioco" placeholder="Torneo di..." required></td>
                                </tr>
                            </table>
                            <input type="submit" name="aggiungi" value="CREA">
                        </form>
                    </div></div></div>
            <?php
        }
        ?>
    </body>
</html>
