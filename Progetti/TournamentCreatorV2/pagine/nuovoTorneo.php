<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crea</title>
    </head>
    <body>
        <?php
        session_start();
        include './connessione.php';
        if(isset($_POST["aggiungi"])){  //se è stato cliccato il pulsante per l'immisisione viene inserito nel database un nuovo torneo con i dqati inseriti nel form la data corrente e come admin l'id con cui si è loggata la sessione
            
            $query = "INSERT INTO `torneo`( `FKTipo`, `Nome`, `DataCreazione`, `NomeGioco`, `IDAdmin`) VALUES ('".$_POST["tipo"]."','".$_POST["nome"]."',CURRENT_DATE,'".$_POST["gioco"]."','".$_SESSION["id"]."')";
            echo $query;
            mysqli_query($connesione, $query)
                    or die("jadsgfkhwsa");
            unset($_POST["aggiungi"]);
            header("Location: ./MieiTornei.php");
        }
        
        ?>
        <h1>Crea un nuovo torneo</h1>

        <form action="#" method="POST">
            <table>
                <tr>
                    <td>Tipologia del Torneo</td>
                    <td><select name="tipo">
                            <?php
                            $result = mysqli_query($connesione, "Select * from tipo"); //vengono estratti tutti i tipi di torneo dalla tabella torei ed inseriti una combobox
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                            <option value="<?php echo $row["IDTipo"]; ?>"><?php echo $row["Nome"]; ?>   </option>
                                <?php
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Nome del Toreno</td>
                    <td><input type="text" name="nome" placeholder="Nome del Torneo"> </td>
                </tr>
                <tr>
                    <td>Torneo di</td>
                    <td><input type="text" name="gioco" placeholder="Torneo di..."></td>
                </tr>
            </table>
            <input type="submit" name="aggiungi" value="CREA">
        </form>
        
    </body>
</html>
