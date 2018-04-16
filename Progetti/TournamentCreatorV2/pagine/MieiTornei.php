<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>I miei tornei</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php
        session_start();
        include './connessione.php';
        echo "<h1>Benvenuto " . $_SESSION["user"] . " </h1>";

        $query = "SELECT
    utente.NomeUtente,
    tipo.Nome as Tipo,
    torneo.Nome,
    torneo.DataCreazione,
    torneo.NomeGioco
FROM
    `torneo`,
    tipo,
    utente
WHERE
    torneo.IDTipo = tipo.ID AND torneo.IDAdmin = '" . $_SESSION["id"] . "'";

        echo "I miei tornei";
        $result=mysqli_query($connesione, $query)
                or die("query sbagliata");
           ?>
        <table>
            <tr>
                <th>Nome Torneo</th>
                <th>Tipo Torneo</th>
                <th>Data creazione</th>
                <th>Torneo di</th>
            </tr>
                <?php
        while($row=mysqli_fetch_array($result)){
         echo "<tr>
                <td>".$row["Nome"]."</td>
                <td>".$row["Tipo"]."</td>
                <td>".$row["DataCreazione"]."</td>
                <td>".$row["NomeGioco"]."</td>
            </tr>";
        
        }
        ?>
        </table>
        
        <form action="nuovoTorneo.php">
            <input type="submit" value="Crea Torneo" name="crea" />
        </form>
    </body>
</html>
