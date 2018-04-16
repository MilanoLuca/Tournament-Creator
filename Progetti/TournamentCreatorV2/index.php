<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        
    </head>
    <body>
        <?php
        session_start();
        ?>
        <h1>Login</h1>
        <form name="login" method="POST" action="pagine/login.php"> <!-- from per Inserimento dei dati utente per il login-->
            <table>
                <tr>    
                    <td>Username</td>
                    <td><input type="text" name="user" placeholder="Enter Username"</td>
                </tr>
                <tr>    
                    <td>Password</td>
                    <td><input type="password" name="pass" placeholder="Enter Password"</td>
                </tr>

            </table>
            <input type="submit" name="login" value="LOGIN">

        </form>
        <br>

        <?php
        if (isset($_SESSION["errore"])) {       //se p settata la variabile di sessione "errore" viene visualizzata un messaggio di errore
            echo "<div> ".$_SESSION["errore"]."</div>";
            unset($_SESSION["errore"]);
        }
        ?>

    </body>
</html>
