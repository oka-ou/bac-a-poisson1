<?php ob_start();
session_start();
$title = "Login";
//Accès seulement si authentifié 
if (isset($_SESSION['logged_in']['login']) !== TRUE) {
    // Redirige vers la page d'accueil (ou login.php) si pas authentifié
    $serveur = $_SERVER['HTTP_HOST'];
    $chemin = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), '/\\');
    $page = 'index.php';
    header("Location: http://$serveur$chemin/$page");
}
?>

<article class="art-main">
        
<h1>Supprimer un bassin</h1>
   <table border="2">
   <tr>
    <td>Bassin du Héron</td>
    <td>
        <form method="POST" action="deletebassin.php">
            <input type="hidden" name="idbassin" value="2">
            <input type="submit" value="Supprimer">
        </form>
    </td>
</tr>
</table>
    </article>
  


<?php
$contenu = ob_get_clean();
require "gabarit/template.php";
?>