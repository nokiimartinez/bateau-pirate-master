<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <title>Panel Administrateur</title>
</head>
<body>
    <?php

        // connexion a la base de données 
        try {
        $bdd = new PDO("mysql:host=localhost;dbname=bateau_pirate", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(PDOException $e) {
        echo "Erreur: ". $e->getMessage();
        }

    ?>

    <?php require_once("header.php") ; ?>

    <div class="container-fluid ">
        <div class="row text-center bg-dark text-white pb-3 pt-4 fs-5">
            <div class="col" id="dash"><p>Dashboard</p></div>
            <div class="col" id="vinyle"><p>Vinyles</p></div>
            <div class="col" id="membre"><p>Membres</p></div>
        </div>
    </div>
    <div class="container-fluid p-0 border-3 border border-white" id="containerpanel">
        <?php require "dashboard.php" ?>
    </div>
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script>
</html>
<?php

?>
