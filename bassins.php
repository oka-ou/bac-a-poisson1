<!-- On inclure le gabarit template.php commun au pages-->
<<?php ob_start(); // On met en mémoire tampon tout ce qui devrait être affiché
    session_start();
    $title = "Les bassins de la pisciculture du Web";
    // j'ecris dans du PHP donc ici c'est bien
    //Connexion à la base de données
    require_once "bdd/bddconfig.php";  // va acceder ""une seule fois" au fichier qui ce trouve à ce chemin 

    // gestion des erreurs de connexion par try et catch
    try {
        //Connexion a MySQL
        $objBdd = new PDO("mysql:host=$bddserver;
                          dbname=$bddname;
                          charset=utf8",
                          $bddlogin,
                          $bddpass );

        //  $objBdd = new PDO("mysql:host=localhost;dbname=$bddname;charset=utf8", "bts", "snir");

        $objBdd->setAttribute(PDO::ATTR_ERRMODE,//rapport d'erreur
                              PDO::ERRMODE_EXCEPTION);//emet une exception
                              
        //dans la connexion
        //envoyer la requete SQL
        $listeBassins = $objBdd->query("select idBassin,nom,description, photo from bassin"); // envoyer la la requete SQL// ancien version
        // fin de la requete SQL

    } catch (Exception $prmE) {
        // die('Erreur : ' . $prmE->getMessage());//j'arrete le scriot
        die('Erreur de la connexion a la base'); //j'arrete le scriot
    }
    ?> <!--fin du gabarit template.php commun au pages-->

    <!--   contenu propre a bassin.php        -->
    <article class="art-main">
        <h1>Les bassins de la pisciculture du Web</h1>
        <h2>– dans un écrin de verdure</h2>
        <p>Nos truites danoises éclosent dans nos écloseries continentales, où elles passent les premiers
            mois de leur vie. L’environnement contrôlé de ces élevages nous permet d’assurer les meilleures
            conditions possibles pour leur culture. Quand elles ont environ deux ans, la plupart des truites
            sont transportées à nos élevages marins, dans les eaux côtières propres et limpides du Danemark.
        </p>

        <p>Elles y passent 7 à 8 mois, jusqu'à ce qu'elles remplissent parfaitement les conditions pour la
            récolte. Elles sont transportées vivantes et avec le plus grand soin dans de grands bateaux à
            viviers jusqu’à notre propre site de traitement situé à Aarøsund, dans le Jutland-du-Sud.</p>
    </article>

    <!-- Dans la section. C'est les memes. J'ai 3 article  soit je le fais en dur en htpl 
      soit je ne le fais en code PHP .. ici en PHP mais avec une boucle 
    Pour Afficher les resultat ligne par lignr  -->
    <section class="content-sec">

        <?php
        // while ($bassin = $listeBassins->fetch()) {
        foreach ($listeBassins as $bassin) {// methode plus addapter pour les tableaux 
        ?>
            <article class="art-sec">
        <!--    <h2>Truite saumonée</h2>   devient        -->
         <!--   <img src="images/truite4.jpg" alt="Un filet de truite saumonée">   devient      -->
         <!--   <p>20 hectares dans le centre d'Armentières</p>          devient       -->  
                <h2> <?php echo $bassin['nom'] ?></h2>         
                <img src="images/<?php echo $bassin['photo']; ?>" alt=" <?php echo $bassin['nom']; ?>">             
                <p> <?php echo $bassin['description'] ?></p>
         <!--   creation d'1 lien <a> de données -->       
                <a href="temperatures.php?idbassin=<?php echo $bassin['idBassin']; ?>&nombassin=<?php echo $bassin['nom']; ?>"> Voire les temperatures</a>
            </article>

        <?php
        } //fin du while ou du foreach
        $listeBassins->closeCursor(); //libère les ressources de la bdd car le server garde en memoire vive les données
        ?>
        <!-- fin de la partie " Afficher les resultat ligne par ligne avec la boucle while/forech " -->
        
    </section>
    <!--   fin de la partie propre a bassin.php        -->

    <?php
    // déconnexion de la base de données ici c'est bien c'est dans du PHP et a la fin 
    $objBdd = null;// cette deconnection est du a la connexion "$objBdd = new PDO( etc... )" ligne 12

    $contenu = ob_get_clean(); //On copie le contenu de la memoire tampon dans la variable " $contenu "
    require_once "gabarit/template.php"; // va acceder au fichier qui ce trouve à ce chemin 
    ?>