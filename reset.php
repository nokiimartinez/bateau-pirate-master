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
        <div class="row justify-content-center align-items-center" style="min-height: 403px;">
            <form method="POST" class="col-11 col-sm-10 col-md-7 col-lg-5 d-flex flex-column text-center bg-white border border-dark border-4 shadow-lg rounded p-5">
                    <div class="row"><h2 class="fs-3 py-4">Réinitialisation de mot de passe </h2></div>
                    <label for="email" class="p-3">Veuillez saisir votre adresse email</label>
                    <input type="email" class="mx-3 mb-2" name="resetemail" >
                    <input class="btn btn-dark m-3" type="submit" >
            </form>
        </div>
    </div>
    
    
<?php

    require ('sendemail.php');

     // connexion a la base de données 
    try {
    $bdd = new PDO("mysql:host=localhost;dbname=bateau_pirate", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    catch(PDOException $e) {
    echo "Erreur: ". $e->getMessage();
        }

        
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
       $email = $_POST['resetemail'];
       $email = htmlspecialchars($email) ;
       
       //Creation du token
       $newtoken = password_hash($email, PASSWORD_BCRYPT ) ;

       //verification que l'utilisateur existe bien grace a l'Id et recuperation de celui ci. 
       $recupId = $bdd->prepare("SELECT Id FROM utilisateur WHERE Email=:email ");
       $recupId->execute(array(
        ':email' => $email
       ));
       $id = $recupId->fetch();
       $id = $id[0];
       
       //insertion du token dans la base de données correspondant a l'utilisateur en question
       $insertToken = $bdd->prepare("UPDATE utilisateur SET Token=:token WHERE Email=:email ");
       $insertToken->execute(array(
        ':token' => $newtoken,
        ':email' => $email
       ));
       
       //envoie du mail
       $sujet = "Reinitialisation de mot de passe.";
       $message = "Veuillez cliquer sur le lien suivant pour reinitialiser votre mot de passe : ". "<a href='http://localhost/projet/bateau%20pirate%20v0.7/bateau%20pirate/newpass.php?id=".$id."&token=".$newtoken."'><p>clique ici</p></a>" ;
       
       send_mail($email, $sujet , $message);
       
    }
?>

    
</body>
</html>


