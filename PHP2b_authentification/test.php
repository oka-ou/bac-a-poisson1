<?php
//
session_start();
//$_SESSION['pseudo'] = $_GET["nom"];

if (isset($_SESSION['pseudo']) == TRUE) {
echo $_SESSION['pseudo'];
}
else{
    echo"la variable de session n'est pas ";
}

