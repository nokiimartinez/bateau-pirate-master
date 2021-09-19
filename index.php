<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link type="text/css" rel="stylesheet" href="styles.css" />
    <title>Accueil</title>
  </head>
  <body>
    <div><?php require "header.php" ?></div>
    <section>
      <div class="image_accueil">
        <h2 class="texte_accueil">Bienvenue sur notre boutique</h2>
        <p class="sous_texte_accueil">Decouvrez nos vinyles</p>
        <div class="row">
          <div class="col bouton_accueil_position">
            <button type="button" class="btn btn-light bouton_accueil">
              <a href="home.php">Entrer</a>
            </button>
          </div>
        </div>
        <p class="texte_de_bas_de_page">Paris, France</p>
      </div>
    </section>
  </body>
</html>
