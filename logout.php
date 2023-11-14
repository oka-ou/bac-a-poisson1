<?php 
session_start();

//détruire la session courante
session_destroy();





$serveur = $_SERVER['HTTP_HOST'];
$chemin = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), '/\\');
$page = 'index.php';
header("Location: http://$serveur$chemin/$page");


?>