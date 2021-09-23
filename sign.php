<?php

  if(isset($_COOKIE)){
    $_GET['form'] = 0 ;
  }else { $_GET['form'] = 1 ; }

  // connexion a la base de données 
  try {
    $bdd = new PDO("mysql:host=localhost;dbname=bateau_pirate", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(PDOException $e) {
    echo "Erreur: ". $e->getMessage();
  }

  //Formulaire d'inscription 
  if(isset($_POST["inscription"])){
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $mdp1 = htmlspecialchars($_POST["mdp1"]);
    $mdp2 = htmlspecialchars($_POST["mdp2"]);
    $validmdp = password_hash($mdp1, PASSWORD_BCRYPT );
    $date = date('d/m/Y à H:i:s');
    $token="" ;

    if(!empty($nom) AND !empty($prenom) AND !empty($email) AND !empty($mdp1) AND !empty($mdp2)){
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if( $mdp1 == $mdp2 ){
          if (strlen($nom) <= 50 AND preg_match('#^\p{L}+$#', $nom)){
            if (strlen($prenom) <= 50 AND preg_match('#^\p{L}+$#', $prenom)){
              if (strlen($email) <= 75 ){
                if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $mdp1) AND strlen($mdp1)) {
                   $verifmail = $bdd->prepare('SELECT id from utilisateur WHERE Email = "'.$email.'"');
                   $verifmail->execute();
                   if($verifmail->rowCount() < 1){
                    $insertUser = $bdd ->prepare('INSERT INTO utilisateur (Nom, Prenom, Email, Pass, Date, Token ) VALUES (:Nom, :Prenom, :Email ,:Pass, :Date, :Token) ');
                    if($insertUser->execute(array(
                      ':Nom' =>$nom, 
                      ':Prenom' =>$prenom, 
                      ':Email' =>$email , 
                      ':Pass' =>$validmdp, 
                      ':Date' => $date, 
                      ':Token' => $token
                    ))) {
                      session_start();
                      header("Location:home.php");
                      $_SESSION["login"] = $prenom ;
                    } else {
                      $return = " une erreur est survenu." ;
                    }
                   }else { $return = "Votre adresse email est deja utilisée " ;}
                }else { $return = "Votre mot de passe doit être conforme au modéle présentez ci-dessus" ; }
              }else { $return = "Votre adresse email posséde trop de caractéres" ; }
            }else { $return = "<br>"."Votre prenom posséde trop de caractéres" ; }
          }else { $return = "Votre nom posséde trop de caractéres" ; }
        }else { $return = "les deux mot de passe ne sont pas identique" ; }
      }else { $return = "l'adresse email est invalide " ; }
    }else { $return = "il manque un ou plusieurs champ de formulaire" ; }
    
  }

  //Formulaire de connexion

  if(isset($_POST["connexion"])){
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];
    $validmdp = password_hash($mdp, PASSWORD_BCRYPT );
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y a H:i:s');
  
  // securise les entrées en base de données ( pas de caractéres speciaux )
    $login = htmlspecialchars($login);
    $mdp = htmlspecialchars($mdp);
  
    if(!empty($login) AND !empty($mdp)){
      $bdd -> query('INSERT INTO connexion (AdresseIP, Login , Pass , Date ) VALUES ("'.$ip.'","'.$login.'","'.$validmdp.'","'.$date.'") ' );
      $verifconnexion = $bdd -> prepare('SELECT * FROM utilisateur WHERE Email = "'.$login.'" ' );
        $verifconnexion-> execute();
        $UserData = $verifconnexion-> fetch() ;
        $pass = $UserData['Pass'];
        $prenom = $UserData['Prenom'];
        $nom= $UserData["Nom"];
        $date= $UserData["Date"];
        $id= $UserData["Id"];
        //accés au panel admin
          if($login === "administrateur@gmail.com" AND password_verify($mdp,$pass)){
            session_start();
            $_SESSION["login"] = $prenom ;
            header('Location:PanelAdmin.php');
          }else if(password_verify($mdp,$pass)){
            session_start();
            $_SESSION["login"] = $prenom ;
            $_SESSION["nom"] = $nom ;
            $_SESSION["date"] = $date ;
            $_SESSION["id"] = $id ;
            header('Location: home.php') ;
          }else { $return = "Les identifiants sont invalides" ; }
    }else{ $return = " veuillez renseigner tous les champs " ; }

  }


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <title>Connexion/Inscripiton</title>
</head>
<body>
  <div>
    <?php require "header.php" ?>
  </div>
    <div class="container">
    <div class="row">
        <div class="col"></div>
            <div class="col-xs-12 col-sm-11 col-md-9 col-lg-8 col-xl-6 col-xxl-5">
                <div class="panel p-3">
                    <div class="haut_de_panel">
                      <h2 id="form1" class="panel1 p-5 pt-4"> Connexion </h2> 
                      <h2 id="form2" class=" p-5 pt-4"> Inscription </h2>
                      <br>
                    </div>
                <div class="formchoose" id="formchoose" >
                <?php 
                    if ($_COOKIE['form'] == 0 ) {
                      require "connexion.php"; 
                    } else { require "inscription.php";}
                ?>
            </div>
            </div>
            </div>
        <div class="col"></div>
    </div>
    <div class="retour_de_formulaire">
            <?php echo $return ?? '' ?>
            </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="script.js"></script>
<?php if (!$_COOKIE['form'] == 0 ) echo "<script>$('.panel').animate({ height: '765px', margin: '115px 0 0 0' });</script>"?>
</html>
