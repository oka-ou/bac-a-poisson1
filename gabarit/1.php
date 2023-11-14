<?php ob_start(); ?> 


<article class="art-main">
    <h1>La pisciculture du Web</h1>
    <h2>– sûre et durable, pour un goût global</h2>
    <img src="images/truite2.jpg" alt="Une truite dans l'eau">
    <p>Nous faisons de l’élevage de truite à Armentières depuis plus de 60 ans et
        nous sommes le plus grand éleveur de truites dans les Hauts-de-France.</p>
    <h3>Caviar de truite</h3>
    <p>De nombreuses années d'expérience, combinées à un contrôle intégral assuré à toutes les étapes du
        processus d'élevage, nous permettent de produire un caviar de truite de la plus haute
        qualité possible pour nos clients estimés. Nous fournissons les importateurs et les grossistes
        du monde entier.<br>Différentes exigences, emballages et méthodes de production sont nécessaires
        pour les différents
        marchés, et nous faisons preuve de flexibilité afin de répondre à toutes ces demandes
        différentes quant à notre caviar de truite haut-de-gamme.</p>
    <h3>Truites fraîches</h3>
    <p>Nous sommes en mesure de fournir à nos clients du monde entier des truites fraîches tous les ans
        en novembre et en décembre. Les tailles proposées sont 1 à 2 kg, 2 à 3 kg et 3 à 4 kg et elles
        sont toutes emballées dans notre station d’emballage.</p>
</article>

<section class="content-sec">
    <article class="art-sec">
        <h2>Caviar de truite fondant</h2>
        <img src="images/oeufs.jpg" alt="Des oeufs de truites en gros plan">
        <p>
            Nous produisons un ikura de truite à texture fondante. Ce produit est fabriqué à partir de
            notre propre matière première...
        </p>
    </article>

    <article class="art-sec">
        <h2>Truite saumonée</h2>
        <img src="images/truite4.jpg" alt="Un filet de truite saumonée">
        <p>
            Des filets de truite peuvent être produits sur commande. Le filetage aura lieu en novembre
            et décembre, lorsque la majorité des truites fraîches seront prêtes à la récolte...
        </p>
    </article>

    <article class="art-sec">
        <h2>La qualité de l'eau</h2>
        <img src="images/truite3.jpg" alt="Des truites à la surface de l'eau dans un bassin">
        <p>
            L'eau est de très bonne qualité mais sa température varie fortement
            (0°C à 24°C), le pH est neutre et la teneur en oxygène est constante toute l'année...
        </p>
    </article>

    <article class="art-sec">
        <h2>Alimentation</h2>
        <img src="images/alimentation.jpg" alt="Un pisciculteur avec une épuisette dans un bassin">
        <p>
            La nutrition a un impact considérable sur la santé, la taille et la qualité du poisson
            d'élevage...
        </p>
    </article>
                    
</section>


<?php $contenu = ob_get_clean(); 
require_once "template.php";    
?>            