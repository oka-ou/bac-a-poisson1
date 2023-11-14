# PHP2b : Les formulaires d'ajout et de suppression des bassins


- [PHP2b : Les formulaires d'ajout et de suppression des bassins](#php2b--les-formulaires-dajout-et-de-suppression-des-bassins)
- [1. Page pour ajouter un bassin](#1-page-pour-ajouter-un-bassin)
  - [1.1 Formulaire HTML : ```ajouterbassin.php```](#11-formulaire-html--ajouterbassinphp)
  - [1.2 Script d'insertion dans la base : ```insertbassin.php```](#12-script-dinsertion-dans-la-base--insertbassinphp)
- [2. Page pour supprimer un bassin](#2-page-pour-supprimer-un-bassin)
  - [2.1 Page formulaire choix du bassin à supprimer : ```supprbassin.php```](#21-page-formulaire-choix-du-bassin-à-supprimer--supprbassinphp)
  - [2.2 Script de suppression dans la base : ```deletebassin.php```](#22-script-de-suppression-dans-la-base--deletebassinphp)
  - [2.3 Suppression en une seule page PHP (form + script)](#23-suppression-en-une-seule-page-php-form--script)

# 1. Page pour ajouter un bassin
## 1.1 Formulaire HTML : ```ajouterbassin.php```
```html
<form method="POST" action="insertbassin.php">
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
```
## 1.2 Script d'insertion dans la base : ```insertbassin.php```
1. sécuriser les variables reçues
2. Requête prepare + bindParam
3. lastInsertId()
4. Redirection vers bassins.php


# 2. Page pour supprimer un bassin
## 2.1 Page formulaire choix du bassin à supprimer : ```supprbassin.php```
supprbassin.php (formulaire choix du bassin à supprimer) > POST > deletebassin.php

```html
<tr>
    <td>Bassin du Héron</td>
    <td>
        <form method="POST" action="deletebassin.php">
            <input type="hidden" name="idbassin" value="2">
            <input type="submit" value="Supprimer">
        </form>
    </td>
</tr>
```

## 2.2 Script de suppression dans la base : ```deletebassin.php```
1. sécuriser la variable reçue : idbassin
2. Suppression des températures de ce bassin
3. Suppression du bassin
4. Redirection vers bassins.php

## 2.3 Suppression en une seule page PHP (form + script)
test si ```$_POST["idbassin"]``` existe : 
* si non : code de supprBassin
* si oui : code de deletebassin.php
