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
        <form name="login" method="POST" action="pagine/login.php">
            <table>
                <tr>    
                    <td>Username</td>
                    <td><input type="text" name="user" placeholder="Enter Username"</td>
                </tr>
                <tr>    
                    <td>Password</td>
                    <td><input type="password" name="pass" placeholder="Parola d'ordine"</td>
                </tr>
                
            </table>
            <input type="submit" name="login" value="LOGIN">
        </form>
        
        
        
        
        
        
    </body>
</html>
