<?php ob_start(); ?> 

    <article> 
        <h1>Présentation</h1> 
        <p> contenu specifique de la page 0.php</p> 
    </article>     
    
    <?php $contenu = ob_get_clean(); 
        require_once "template.php";    
  ?>
