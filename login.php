<!--  Page de saisie des identifiants   Formulaire de connexion        -->
<?php ob_start();
session_start();
$titre = "Autenfication";// c'est le Login
?>

<!--  Formulaire de connexion (page spécifique login.php, mais pourrait être dans le template)           -->
<article class="art-main">
  <h1>Autentification</h1>

  <form method="POST" action="login_action.php">
    <input type="text" name="login" placeholder="Saisissez votre login..." required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="submit" value="Se connecter">
  </form>

</article>


<?php $contenu = ob_get_clean();
require_once "gabarit/template.php";
?>