
<?php
//PHP_SESSION_ACTIVE = 2 
if (isset($_SESSION['login'])){
   ?> 
    <header class="session">
    <div class="container-fluid">
      <div class="row">
        <img class="logo" src="img/logo.png" alt="logobateaupirate" />
        <div class="col"><h1>Bateau Pirate</h1></div>
        <div class="col">
          <div class="float-end pe-3 pt-2 mt-3 fs-5"><?= "Bienvenue ". $_SESSION["login"]; ?><i id="panier" class="bi bi-cart ms-3 "></i><i class="bi bi-gear-fill ms-3" id="parametres"><div id="menuparametre"><a href="settings.php">Mon Compte</a><br><a href="logout.php">Se deconnecter</a></div></i></div>
          <!-- <div id="menuparametre"></div> -->
        </div>
      </div>
    </header>
    <?php
} else {
    ?>
    <header>
    <div class="container-fluid">
      <div class="row">
        <img class="logo" src="img/logo.png" alt="logobateaupirate" />
        <div class="col"><h1>Bateau Pirate</h1></div>
        <div class="col">
          <ul class="float-end me-3">
            <li>
              <a href="sign.php?form=1"><button type="button" class="btn btn-dark" id="connexion">Connexion 
              </button></a>
            </li>
            <li>
            <a href="sign.php?form=0"><button type="button" class="btn btn-dark ms-3" id="inscription">Inscription
              </button></a>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <?php 
}
?>
