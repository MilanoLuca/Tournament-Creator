<?php

include './connessione.php';
session_start();

$result= mysqli_query($connesione, "Select * from utente where nomeutente='".$_POST["user"]."' and password='".$_POST["pass"]."'")
        or die("query errata");



if(mysqli_num_rows($result)==1){
    
    $row= mysqli_fetch_array($result);
    $_SESSION["id"]=$row["ID"];
    $_SESSION["user"]=$row["nomeutente"];
    $_SESSION["psw"]=$row["password"];
    
    echo $_SESSION["user"];
    header("Location: ./MieiTornei.php");
    
}
