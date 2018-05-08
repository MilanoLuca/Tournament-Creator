<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../js/controlliform.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        session_start();
        include 'connessione.php';
        if (isset($_GET["idTorneo"])) { //viene recuperato l'id del torneo selezionato e salvato in una variabile di sessione
            $_SESSION["idTorneo"] = $_GET["idTorneo"];
        }
        $idTorneo = $_SESSION["idTorneo"];
        $idUtente = $_SESSION["id"];
        
        //inserisce le squadre nel database se i nomi sono inseriti
        if(isset($_POST["nomi"])){
            $numSquadre = $_POST["numSquadre"];
            for($i = 1; $i <= $numSquadre; $i++){
                //query di esempio per l'inserimento di una squadra NB Deve essere valorizzata
                $inserimentoSquadre = "INSERT INTO `squadra`(`IDTorneo`, `Nome`) VALUES ($idTorneo,'".$_POST["squadra".$i]."')";
                mysqli_query($connesione, $inserimentoSquadre);
            }
           header("Location: MieiTornei.php");
        }
        
        $query = "SELECT * from torneo, squadra WHERE $idTorneo=squadra.IDTorneo"; //seleziona tutte le squadre del toreno
        
        
        $result = mysqli_query($connesione, $query);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) < 1) { //se il numero di squadre è < di 1 viene chiesto di inserirle
            echo 'Inserisci le squadre';
        ?>
        <form method="POST" action="gestioneTorneo.php?idTornero=<?php $idToreno ?>"><!--form per l'inserimento delle squadre
            NB visto che la pagina vine ricaricat è necessario rinviare l'id del torneo-->
            <table>
                <tr><td>Numero di squadre</td>
                    <td><select name="numero">
                            <option value="4">4</option>
                            <option value="8">8</option>
                            <option value="16">16</option>
                            <option value="32">32</option>                               
                        </select></td></tr>
            </table>
            <input type="submit" value="CONFERMA" name="conferma">
        </form>

        <!-- da controllare js-->
        <!--<form name="frmNomiSquadre" method="GET" action="#" onsubmit="return controllaNomi();">
            <input type="hidden" name="numSquadre" value="<?php echo $_POST["numero"]?>">
        </form>-->
        <?php
            if (isset($_POST["conferma"])) { //dopo aver inserito il numero delle squadre che si vogliono inserire si stampa il form per l?inserimento di quelle
                $cont = 1;               
                
                echo "<form method=\"POST\" action=\"gestioneTorneo.php?idTornero=$idTorneo\">"; //form che rimanda alla stessa pagina 
                echo '<input type="hidden" name="numSquadre" value="'.$_POST["numero"].'">';
                //NB visto che la pagina vine ricaricat è necessario rinviare l'id del torneo
                while ($cont != $_POST["numero"] + 1) {   //stampa il numero di volte inserito le textbox per l'inserimento del nome dele squadre
                    echo " Inserisci nome squadra $cont <input type=\"text\" name=\"squadra" . $cont . "\" placeholder=\"Squadra" . $cont . "\"><br><br>";
                    $cont++;
                }
                echo '<input type="submit" name="nomi" value="conferma">';
            }
        }
        else{
            echo "Le squadre sono già state create";
        }
        ?>
    </body>
</html>
