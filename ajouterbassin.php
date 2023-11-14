<?php ob_start();
session_start();
$title = "Ajouter un bassin";
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
    <h1>ajout un bassin</h1>

    <form method="POST" action="insertbassin.php">
    <!-- est remplacé par ..
        <input type="text" name="login" placeholder="Saisissez votre login..." required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="submit" value="Se connecter">      -->

        <fieldset>
            <legend>Caractéristiques du bassin</legend>
            Nom :<br />
            <input type="text" name="nom" value="" placeholder="Nom du bassin" required>
            <br />
            Description :<br>
            <textarea name="descript" rows="10" cols="40" placeholder="Description du bassin" required></textarea>
            <br />
            Ref. Capteur :<br>
            <input type="text" name="refcapteur" value="" placeholder="ID du capteur" required>
            <br />
            <input type="submit" value="Enregistrer">
        </fieldset>

    </form>
</article>

    <?php $contenu = ob_get_clean();
    require_once "gabarit/template.php";
    ?>