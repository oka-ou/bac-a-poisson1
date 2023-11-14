<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Exemple de mise en page avec CSS grid layout, fake content">
    <meta name="author" content="Gwénaël LAURENT">
    <meta name="robots" content="none">
    <title>La pisciculture du Web</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <header class="main-head">
            <img src="images/logo.png" class="logo-banner" alt="Logo de la pisciculture du web">
            <blockquote>Le meilleur caviar de truite des Hauts-de-France</blockquote>

            <div class="auth-container">
                <!--  Affichage des lien Utilisateur Connexion/Deconnexion  -->
                <?php
                    if (isset($_SESSION['logged_in']['login']) == TRUE) {
                    //l'internaute est authentifié
                    $ident = $_SESSION['logged_in']['prenom'] . ' ' . $_SESSION['logged_in']['nom'];
                    //affichage "Se déconnecter"(logout.php), "Prif", "Paramètres", etc ...
                ?>
                    <p class='nom-prenom'>
                        <?= $ident; ?><br>
                        <a href="logout.php" class="signout-link">Déconnexion</a>
                    </p>
                <?php
                } else {
                    //Personne n'est authentifié 
                    // affichage d'un lien pour se connecter
                ?>
                    <a href="login.php" class="signin-link">Connexion</a>
                <?php
                }
                ?>
            <!--  fin de : Affichage des lien Utilisateur Connexion/Deconnexion  -->

            </div>
            
        </header>

        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="bassins.php">Les bassins</a></li>
                <li><a href="arcenciel.php">La truite arc-en-ciel</a></li>

                <li><a href="bassins.php">Ajouter un bassin</a></li>
                <li><a href="arcenciel.php">Supprimer un bassin</a></li>



                <?php if (isset($_SESSION['logged_in']['login']) == TRUE) {  ?>

                    <li><a href="ajouterbassin.php">Ajouter un bassin</a></li>
                    <li><a href="supprimerbassin.php">Supprimer un bassin</a></li>
                    
                <?php
                }
                ?>
            </ul>
        </nav>
        <section class="main-content">

            <!--contenu spécifique à la page et l’enregistrer dans une variable $contenu -->
            <?php echo $contenu; ?>
            <!--fin du contenu spécifique à la page et l’enregistrer dans une variable $contenu -->

        </section>
      
        <footer class="main-footer">
            <p>&copy; Pisciculture du Web Armentières - Tous droits réservés -
                <a href="#">Contact</a>
            </p>
        </footer>
    </div>
</body>

</html>