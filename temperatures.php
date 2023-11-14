<!-- On inclure le gabarit template.php commun au pages-->
<?php ob_start();
session_start();
$title = "Les Temperatures";

//connexion a la base de données
require_once "bdd/bddconfig.php";

$idBassin = 0;// id Bassin de la BDD
$nomBassin = "Bassin inconnu";// nom bassin de la BDD

//recupere les données URL dans un tableau associatif
$idok = isset($_GET['idbassin']);// isset() verifie si la variable existe 
$nomok = isset($_GET['nombassin']);// et Get['toto'] four nit un tableau assiociatif

if (($idok == true) && ($nomok == true)) {
    $idBassin = intval(htmlspecialchars($_GET['idbassin'])); // intval() convertit la valeur en entier
    $nomBassin = htmlspecialchars($_GET['nombassin']); //htmlspecialchars() convertit les caracteres speciaux en entier HTML
}
// recup les données dans URL
//isset() verifie si la variable existe et $_GET[] fournit un tableau associatif
if (isset($_GET["nombassin"])){ $nomBassin = strval($_GET["nombassin"]); }   

try {
    $objBdd = new PDO("mysql:host=$bddserver; 
                       dbname=$bddname;
                       charset=utf8", 
                       $bddlogin, $bddpass);

    $objBdd->setAttribute(PDO::ATTR_ERRMODE, 
                          PDO::ERRMODE_EXCEPTION);

    // envoie une requete SQL  
    //  $listeTemperatures = $objBdd->query("SELECT * FROM temperature WHERE idBassin =".$_GET['idbassin']);// ancienne version

    // requete preparer 
    //  $idbassin = intval($_GET["idbassin"]);   existe deja a la ligne 15 dans le if ..
    $objBdd = new PDO("mysql:host=$bddserver;
                       dbname=$bddname;
                       charset=utf8", 
                       $bddlogin, $bddpass);

    //  avec variable liees 
    $listeTemperatures = $objBdd->prepare("SELECT * FROM temperature 
                        WHERE idBassin = :id 
                        ORDER BY date DESC");// trie par 
    $listeTemperatures->bindParam(':id', $idBassin, PDO::PARAM_INT);
    $listeTemperatures->execute();  

} catch (Exception $prmE) {

    die('Erreur : ' . $prmE->getMessage());
    //die('Erreur de connexion à la base');
}

?>
    <!--  Afficher les temperatures par date dans un tableau   -->
    <article class="art-main">
        <h1>Les températures <?php echo$_GET['nombassin']; ?></h1>
        <table class="tableTemperature">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Temperature (°C)</th>
                </tr>  
            </thead>
            <tbody>
                <?php foreach ($listeTemperatures as $temperature){ 
                ?>

                <tr>
                  <td><?php echo $temperature['date']; ?></td>
                  <td><?php echo $temperature['temp']; ?></td> 
                </tr>
                    
                <?php  } 
                // $listeTemperatures->closeCursor(); //libère les ressources de la bdd ??????????????
                ?>
            
            </tbody>        
        
        </table>
    </article>

<?php
// déconnexion à ma base de données
$objBdd = null;

$contenu = ob_get_clean(); //On copie le contenu de la memoire tampon dans la variable " $contenu "
require_once "gabarit/template.php";  // va acceder au fichier qui ce trouve à ce chemin 
?>