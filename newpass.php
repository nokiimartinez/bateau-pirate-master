<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <?php require "header.php" ?>

     <div class="container-fluid mynavbar">
        <div class="row justify-content-center align-items-center" style="min-height: 503px;">
            <form method="POST" class="col-11 col-sm-10 col-md-7 col-lg-5 d-flex flex-column text-center bg-white border border-dark border-4 shadow-lg rounded p-5">
                    <div class="row"><h2 class="fs-3 py-4">Réinitialisation de mot de passe </h2></div>
                    <label for="newmdp1" class="p-3">Veuillez saisir votre nouveau mot de passe</label>
                    <input type="text" class="mx-3 mb-2" name="newmdp1">
                    <label for="newmdp2" class="p-3">Confirmation du mot de passe</label>
                    <input type="text" class="mx-3 mb-2" name="newmdp2">
                    <input class="btn btn-dark m-3" type="submit" >
            </form>
        </div>
    </div>

<?php
    // connexion a la base de données 
    try {
    $bdd = new PDO("mysql:host=localhost;dbname=bateau_pirate", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    catch(PDOException $e) {
    echo "Erreur: ". $e->getMessage();
        }


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //recuperation des variables dans l'URL (token, id) grace a la medthode 'GET'
        $id = $_GET["id"];
        $token = $_GET["token"];
        $mdp1 = $_POST["newmdp1"];
        $mdp2 = $_POST["newmdp2"];
        $newmdp = password_hash($mdp1, PASSWORD_BCRYPT ) ;

        //mise a jour du mot de passe 
        if (!empty($mdp1) AND !empty($mdp2)){
            if ($mdp1 === $mdp2 ){
                if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $mdp1)){
                    $majmdp = $bdd->prepare("UPDATE utilisateur SET Pass=:mdp WHERE Id=:id AND Token=:token");
                    $majmdp ->execute(array(
                        ':mdp' => $newmdp,
                        ':id' => $id,
                        ':token' => $token
                    ));
                    echo " mot de passe mise a jour";
                    header( "Location: sign.php" );
                }else { $return = "le mot de passe n'est pas conforme" ; }
            }else { $return = "les mots de passe ne sont pas identiques" ; }
        }else { $return = "veuillez remplir tous les champs du formulaire" ; }
        
    }
?>