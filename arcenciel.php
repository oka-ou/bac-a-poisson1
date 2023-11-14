<?php 
ob_start();
session_start();
$title = "Les truites arc en ciel";
?>

<article class="art-main">
    <h1>La truite arc-en-ciel</h1>
    <h2>– également connue sous le nom de "truite saumonée"</h2>
    <img src="images/arc-en-ciel.jpg" alt="Une truite dans l'eau">
    <p>La truite arc-en-ciel (Oncorhynchus mykiss ) est originaire d'Amérique du Nord, mais est élevée
        au Danemark depuis plus de 100 ans.
        La truite est aujourd'hui élevée un peu partout à travers le monde, mais le Danemark fait partie
        des 10 plus grands pays producteurs de truites au monde. La production annuelle du Danemark est
        d’environ 30 mt de truite d'eau douce et env. 15 mt de truite élevée en mer. Lorsqu’elle est
        destinée au marché européen, la truite d'eau douce a généralement une taille portion. La truite
        de mer fait 1 à 4 kg.</p>
    <h3>Aqua Production</h3>
    <p>Notre site de traitement, Aqua Production, a le numéro d’agrément DK4731. Nous transformons et
        conditionnons nos truites conformément à nos stricts protocoles en matière de qualité et de
        sécurité alimentaire, afin de garantir les normes de produits les plus élevées. Nous basons
        notre production sur les principes HACCP et sommes régulièrement contrôlés par les services
        vétérinaires et de sécurité alimentaire danois (Danish Veterinary and Food Administration).</p>
    <h3>Truites fraîches</h3>
    <p>Nous sommes en mesure de fournir à nos clients du monde entier des truites fraîches tous les ans
        en novembre et en décembre. Les tailles proposées sont 1 à 2 kg, 2 à 3 kg et 3 à 4 kg et elles
        sont toutes emballées dans notre station d’emballage.</p>
    <h3>Truites surgelées</h3>
    <p>Pendant le traitement, nous envoyons une grande partie de nos truites au Danemark pour quelles y
        bénéficient d’un entreposage frigorifique. Nous produisons de la truite congelée avec et sans
        tête. Nous exportons de la truite congelée dans le monde entier. AquaPri travaille en étroite
        collaboration avec les entreprises d’entreposage frigorifique afin de s’assurer qu’elles
        respectent les mêmes normes strictes qu’elle en matière de sécurité alimentaire et de qualité.
        AquaPri accorde une importance à ce que nos précieux clients aient toujours la certitude
        qu’AquaPri leur fournit la meilleure qualité de produit qui soit.</p>
    <h3>Filets de truite</h3>
    <p>Des filets de truite peuvent être produits sur commande. Le filetage aura lieu en novembre et
        décembre, lorsque la majorité des truites fraîches seront prêtes à la récolte. Nous pouvons
        personnaliser ce produit, le découper et l’emballer exactement comme vous le souhaitez. </p>
</article>
<!-- <section class="content-sec">
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
                </section> -->

<?php $contenu = ob_get_clean();
require_once "gabarit/template.php";
?>