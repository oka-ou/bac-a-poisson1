# PHP2c : authentification des utilisateurs web

- [PHP2c : authentification des utilisateurs web](#php2c--authentification-des-utilisateurs-web)
- [3. Authentification et sessions](#3-authentification-et-sessions)
  - [3.1 Base de données table ```userweb```](#31-base-de-données-table-userweb)
  - [3.2 Fonctionnement des variables de session](#32-fonctionnement-des-variables-de-session)
  - [3.3 Page de saisie des identifiants ```login.php```](#33-page-de-saisie-des-identifiants-loginphp)
  - [3.4 Script d'authentification ```login_action.php```](#34-script-dauthentification-login_actionphp)
    - [3.4.1 Réception des variables POST login et password](#341-réception-des-variables-post-login-et-password)
    - [3.4.2 Vérifier que le login existe dans la BDD ET que mot de passe est correct](#342-vérifier-que-le-login-existe-dans-la-bdd-et-que-mot-de-passe-est-correct)
    - [3.4.3 Créer les variables de session si l'authentification est réussie](#343-créer-les-variables-de-session-si-lauthentification-est-réussie)
    - [3.4.4 Redirection sur la page d'accueil](#344-redirection-sur-la-page-daccueil)
  - [3.5 Affichage des liens Utilisateur/Connexion/Déconnexion ```template.php```](#35-affichage-des-liens-utilisateurconnexiondéconnexion-templatephp)
  - [3.6 Script de déconnexion ```logout.php```](#36-script-de-déconnexion-logoutphp)
  - [3.7 Affichage des éléments privés du menu ```template.php```](#37-affichage-des-éléments-privés-du-menu-templatephp)
  - [3.8 Protection d'accès ```sur toutes les pages privées```](#38-protection-daccès-sur-toutes-les-pages-privées)


# 3. Authentification et sessions
## 3.1 Base de données table ```userweb```

schéma de la base

> Attention au jeu de caractère du champ password ! xxx_cs : le cs veut dire ```Case Sensitive```
```sql
CREATE TABLE IF NOT EXISTS `userweb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
)
```
Pour commencer, il faut ajouter des login/password hashé dans la base : Voilà un script PHP utilitaire pour ajouter dans la base un login avec password hashé (insert_userweb_hash.php)
```php
<?php
/****petit code pour enregistrer dans la base des logins avec le mot de passe enregistré hashé ****/
session_start();

//donnée à insérer
$login = strtolower('gdetrez');
$password_clair = 'Garage';
$nom = 'Detrez'; 
$prenom = 'Gérard';

//hashage du mot de passe
$hash_password = password_hash($password_clair, PASSWORD_BCRYPT);

//Connexion à la base et insertion du nouvel utilisateur
require 'bdd/bddconfig.php';
try {
    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $PDOinsertuserweb = $objBdd->prepare("INSERT INTO userweb (login, password, nom, prenom) VALUES (:login, :password, :nom, :prenom)");
        $PDOinsertuserweb->bindParam(':login', $login, PDO::PARAM_STR);
        $PDOinsertuserweb->bindParam(':password', $hash_password, PDO::PARAM_STR);
        $PDOinsertuserweb->bindParam(':nom', $nom, PDO::PARAM_STR);
        $PDOinsertuserweb->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $PDOinsertuserweb->execute();
        //récupérer la valeur de l'ID du nouveau bassin créé
        echo $lastId = $objBdd->lastInsertId();


} catch (Exception $prmE) {
    die('Erreur : ' . $prmE->getMessage());
}

```

## 3.2 Fonctionnement des variables de session
Création
```php
//activer les sessions
session_start();
//créer une variable de session
$_SESSION['pseudo'] = "toto";
```
Utilisation
```php
if (isset($_SESSION['pseudo']) == TRUE) {
    echo $_SESSION['pseudo'];
}
```

## 3.3 Page de saisie des identifiants ```login.php```
Formulaire de connexion (page spécifique login.php, mais pourrait être dans le template)
```html
<form method="POST" action="login_action.php">
    <input type="text" name="login" placeholder="Saisissez votre login..." required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="submit" value="Se connecter">
</form>
```

## 3.4 Script d'authentification ```login_action.php```
### 3.4.1 Réception des variables POST login et password
```php
<?php 
//activer les sessions
session_start();

//Tester si les variables POST existent
$paramOK = false;
if (isset($_POST["login"])) {
    $login = strtolower(htmlspecialchars($_POST["login"]));
    if (isset($_POST["password"])) {
        $password = htmlspecialchars($_POST["password"]);
        $paramOK = true;
    }
}

//si login et password sont bien reçus
if ($paramOK == true) {
    // A INSERER ICI : vérifier si le login passord est correct (base de données) : voir après
} else {
    die('Vous devez fournir un login et un mot de passe');
}
```

### 3.4.2 Vérifier que le login existe dans la BDD ET que mot de passe est correct

> **Important !!!!** :
> * dans un try/catch pour accéder à la BDD
> * les login doivent être unique dans la BDD, sinon ça ne marche pas

1. Récupérer toutes les infos de cet utilisateur
```php
$PDOlistlogins = $objBdd->prepare("SELECT * FROM userweb WHERE login = :login ");
$PDOlistlogins->bindParam(':login', $login, PDO::PARAM_STR);
$PDOlistlogins->execute();
//S'il y a un résultat à la requête 
$row_userweb = $PDOlistlogins->fetch();
if ($row_userweb != false) {
    //il existe un login identique dans la base
    // A INSERER ICI : vérif du password : voir après
} else {
    //Mauvais login
    session_destroy();
    die('Authentification incorrecte');
}
```
2. vérifier si les hash des password correspondent
```php
if (password_verify($password, $row_userweb['password'])) {
    //authentification réussie
    // A INSERER ICI : création de la variable de session : voir après
}else {
    //Mauvais password
    session_destroy();
    die('Authentification incorrecte');
}
```

### 3.4.3 Créer les variables de session si l'authentification est réussie
Si l'authentifiacation est correcte
```php
//tableau des données à stocker en session
$session_data = array(
    'id' => $row_userweb['id'],
    'login' => $row_userweb['login'],
    'nom' => $row_userweb['nom'],
    'prenom' => $row_userweb['prenom']
);
//régénérer le session id
session_regenerate_id();
//enregistrer les données dans une variable de session
$_SESSION['logged_in'] = $session_data;
$PDOlistlogins->closeCursor();
// A INSERER ICI : redirection vers la page d'accueil : voir après
```

### 3.4.4 Redirection sur la page d'accueil
```php
/* Redirige vers la page d'accueil */
$serveur = $_SERVER['HTTP_HOST'];
$chemin = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), '/\\');
$page = 'index.php';
header("Location: http://$serveur$chemin/$page");
```

## 3.5 Affichage des liens Utilisateur/Connexion/Déconnexion ```template.php```
```php
session_start(); // ou dans les pages de contenu

if (isset($_SESSION['logged_in']['login']) == TRUE) {
    //l'internaute est authentifié
    echo $_SESSION['logged_in']['prenom'].' '.$_SESSION['logged_in']['nom'];
    //affichage "Se déconnecter"(logout.php), "Prif", "Paramètres", etc ...
} else { 
    //Personne n'est authentifié 
    // affichage d'un lien pour se connecter
    //<a  href="login.php">Connexion</a>
}
```

## 3.6 Script de déconnexion ```logout.php```
```php
session_start();

//détruire la session courante
session_destroy();

/* Redirige vers la page d'accueil */
```

## 3.7 Affichage des éléments privés du menu ```template.php```
```php
session_start(); // ou dans les pages de contenu

if (isset($_SESSION['logged_in']['login']) == TRUE) {
    //l'internaute est authentifié
    //affichage des liens vers les pages privées
}
```

## 3.8 Protection d'accès ```sur toutes les pages privées```
Au début de chaque page :
```php
session_start();
//Accès seulement si authentifié 
if (isset($_SESSION['logged_in']['login']) !== TRUE) {
    // Redirige vers la page d'accueil (ou login.php) si pas authentifié
    $serveur = $_SERVER['HTTP_HOST'];
    $chemin = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), '/\\');
    $page = 'index.php';
    header("Location: http://$serveur$chemin/$page");
}
// contenu de la page privée
```