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
    <title>Mon compte</title>
</head>
<?php
// connexion a la base de données 
try {
    $bdd = new PDO("mysql:host=localhost;dbname=bateau_pirate", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(PDOException $e) {
    echo "Erreur: ". $e->getMessage();
  }

  //recuperation de l'id
  $email = $_SESSION['email'];
  $recupId = $bdd->prepare("SELECT Id FROM utilisateur WHERE Email=:email ");
       $recupId->execute(array(
        ':email' => $email
       ));
       $id = $recupId->fetch();
       $id = $id[0];

    $_SESSION['id']=$id ;

//suppression du compte
  $id = $_SESSION["id"];

  if(isset($_POST["suppression"])){
        $suppUser = $bdd->prepare('DELETE FROM utilisateur WHERE id ="'.$id.'"');
        $suppUser->execute();
        echo "votre compte a bien été supprimé";
        header("Location: logout.php");
    }
?>


<body>
  <div>
    <?php require_once("header.php") ?>
  </div>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col text-center bg-dark text-white">
                <h2>Mon compte</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <p>Nom : <?php echo $_SESSION["nom"]; ?></p>
                <p>Prenom : <?php echo $_SESSION["login"]; ?></p>
                <p>Inscrit depuis le : <?php echo $_SESSION["date"]; ?></p>
            </div>
            <div class="col-6 border border-dark d-flex justify-content-center text-center">
                <form method="POST">
                    <h3 class="my-2">Modification de votre compte</h3>
                    <input class="my-2 form-control" type="text" placeholder="Nom">
                    <input class="my-2 form-control" type="text" placeholder="Prenom">
                    <input class="my-2 form-control" type="text" placeholder="Mot de passe">
                    <button type="submit"> Modifier </button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex justify-content-center text-center mt-5"> 
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modaldelete">Supprimer son compte</button>
                <div class="modal fade" id="modaldelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Supprimer votre compte</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Vous etes sur le point de supprimer votre compte definitivement, Etes vous sur de vouloir continuer ? 
                        </div>
                        <div class="modal-footer">
                            <form method="POST"><input type="submit" name="suppression" class="btn btn-success" data-bs-dismiss="modal" Value="Oui" ></form>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Non</button>
                        </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="script.js"></script>
</html>