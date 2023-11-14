
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1> afficher les elel de temperature Bonjour</h1>    
    <?php
    $prix = array();
    //array_push("fruits =>)
    $produits["pommes"] = 1.2;
   // $produits["pommes"] = array("prix" =>1.2, "refe"=>1111); // cas de figure ou $produits contient un tableau
    $produits["poire"] = 2.3;
    $produits["fraises"] = 4.1;

    foreach($produits as $nom=>$prix){
        echo "<p>".$nom.":".$prix;"€";
       // echo "<p>".$nom.":".$infod["prix"]."€ Ref : ".$infos["ref"];// cas de figure ou $produits contient un tableau

    }


  /*  $celsius =20;
    $tempFah = VolumeCone( $celsius);
  //  echo "La temperature est de  " . $tempFah;
    echo "<p>" . $celsius. "°C". $tempFah."°F"."</p>";*/
    
    ?>

</body>
</html>