<?php
    // connexion a la base de données 
    try {
    $bdd = new PDO("mysql:host=localhost;dbname=bateau_pirate", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    catch(PDOException $e) {
    echo "Erreur: ". $e->getMessage();
        }
    
    $requesteNbVinyle = $bdd->prepare('SELECT ID_Vinyl FROM vinyl');
    $requesteNbVinyle->execute(array());
    print_r($requesteNbVinyle);
    echo "bonjour" ;
    $nbVinyle= $requesteNbVinyle -> fetch();
    echo $nbVinyle ;

?>
<div class="container-fluid text-white">
    <div class="row text-center">
        <div class="col bg-dark"><h2>Dashboard</h2></div>
    </div>
</div>
<div class="container-fluid bg-dark">
    <div class="row justify-content-center">
        <div class="col-2 bg-secondary border border-1 border-white m-5">
            <h3 class="text-center">Vinyles</h3>
            <p>Nombres Total: <?= $nbVinyle ?> </p>
            <p>Nombres actuel en boutique : </p>
            
        </div>
    </div>
</div>