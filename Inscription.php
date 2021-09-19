<form method="POST">
  <div class="mb-3">
    <div><label for="Email" class="form-label">Adresse email</label></div>
    <div class="d-inline-flex">
    <input type="email" class="form-control ms-4" name='email' id="email">
    <i class="ps-4 pt-1 bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="L'adresse email ne peut pas contenir de caractéres speciaux, et doit contenir une '@'. ne peut pas depasser 75 caractéres. "></i>
    </div>
  </div>
  <div class="mb-3">
    <div><label for="Nom" class="form-label">Nom</label></div>
    <div  class="d-inline-flex">
    <input type="text" class="form-control ms-4" name="nom" id="nom" >
    <i class="ps-4 pt-1 bi bi-info-circle " data-bs-toggle="tooltip" data-bs-placement="right" title="Le nom ne doit pas dépasser 50 caractéres."></i>
    </div>
  </div>
  <div class="mb-3">
    <div><label for="Prenom" class="form-label">Prenom</label></div>
    <div class='d-inline-flex'>
    <input type="text" class="form-control ms-4" name="prenom" id="prenom" >
    <i class="ps-4 pt-1 bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Le prenom ne doit pas dépasser 50 caractéres."></i>
    </div>
  </div>
  <div class="mb-3">
    <div><label for="Password" class="form-label">Mot de passe</label></div>
    <div class="d-inline-flex">
    <input type="password" class="form-control ms-4" name="mdp1" id="mdp1">
    <i class="ps-4 pt-1 bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Le mot de passe doit contenir une majuscule, une minuscule, un chiffre. Plus de 8 caractéres. "></i>
    </div>
  </div>
  <div class="mb-3">
    <div><label for="Password2" class="form-label">Confirmation du mot de passe</label></div>
    <div class="d-inline-flex">
    <input value="" type="password" class="form-control ms-4" name="mdp2" id="mdp2">
    <i class="ps-4 pt-1 bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Les deux mots de passe doivent être identique."></i>
    </div>
  </div>
  <p><input type="checkbox" id="condition"> En cochant cette case, vous acceptez <br> les conditions génerales d'utilisation</p>
  <input class="btn btn-dark m-3 disabled" type="submit" name="inscription" id="submit">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script>
 