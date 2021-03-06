
// panel de connexion-inscription ajax
$(document).ready(function () {
  $("#form1, #connexion").click(function () {
    document.cookie = "form=0";
    $("#formchoose").load("connexion.php");
    $(".panel").animate({ height: "500px", margin: "150px 0 0 0" });
  });

  $("#form2, #inscription").click(function () {
    document.cookie = "form=1";
    $("#formchoose").animate({ opacity: "1" });
    $("#formchoose").load("inscription.php");
    $(".panel").animate({ height: "765px", margin: "115px 0 0 0" });
  });
  //fait appel a la fonction tooltip
  tooltip();

  //Ouverture du panier
  $("#panier").click(function () {
    $("#panelpanier").animate({ width: "toggle" });
  });

  //Ouverture du panel parametres

  $("#parametres").click(function () {
    $("#menuparametre").slideToggle("slow");
  });

  //affichage des differents panel d'administrateur
  //panel dashboard
  $("#dash").click(function () {
    $("#containerpanel").load("dashboard.php");
  });
  //panel vinyles
  $("#vinyle").click(function () {
    $("#containerpanel").load("Vinyle.php");
  });
  //panel membres
  $("#membre").click(function () {
    $("#containerpanel").load("membre.php");
  });
});

// conditions des champs du formulaire d'inscription

// addeventlistener est une fonction qui ecoute l'element, il lui applique une fonction a chaque fois que l'evenment est produit ("change"). 
// ici c'est lorsque l'utilisateur rentre et sort du champ de formulaire.
document.getElementById("email").addEventListener("change", verifemail);
document.getElementById("nom").addEventListener("change", verifnom);
document.getElementById("prenom").addEventListener("change", verifprenom);
document.getElementById("mdp1").addEventListener("change", verifmdp1);
document.getElementById("mdp2").addEventListener("change", verifmdp2);
document.getElementById("condition").addEventListener("change", validation);

//etablis des verifications sur le champ "mail"
function verifemail() {
  //recupere la valeur du champ.
  email = document.getElementById("email").value;
  //recupere l'element a savoir notre input.
  inputemail = document.getElementById("email");
  // test effectu??s a email. utilisation d'un reggex ( petite expression connu de tous servant ?? verifier si l'email est bien conforme ) 
  // testemail renvoie 1 si tout est bon et 0 sinon.
  testemail = email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g);
  //mesure la longueur de la variable "email" ;
  longueur = email.length;
  // conditions : email conforme et longueur ne depassant pas les 75 caract??res.
  if (testemail && longueur <= 75) {
    //ajoute et supprime une classe CSS a l'element inputemail 
    inputemail.classList.add("valid");
    inputemail.classList.remove("error");
    //pour les verifications de la fonction validation
    validationmail = 1;
  } else {
    inputemail.classList.remove("valid");
    inputemail.classList.add("error");
    validationmail = 0;
  }
  validation();
}

function verifnom() {
  nom = document.getElementById("nom").value;
  inputnom = document.getElementById("nom");
  testnom = nom.match(/^\p{L}+$/iu);
  longueur = nom.length;
  console.log(longueur);
  if (testnom && longueur <= 50) {
    inputnom.classList.add("valid");
    inputnom.classList.remove("error");
    validationnom = 1;
  } else {
    inputnom.classList.remove("valid");
    inputnom.classList.add("error");
    validationnom = 0;
  }
  validation();
}

function verifprenom() {
  prenom = document.getElementById("prenom").value;
  inputprenom = document.getElementById("prenom");
  testprenom = prenom.match(/^\p{L}+$/iu);
  longueur = prenom.length;
  if (testprenom && longueur <= 50) {
    inputprenom.classList.add("valid");
    inputprenom.classList.remove("error");
    validationprenom = 1;
  } else {
    inputprenom.classList.remove("valid");
    inputprenom.classList.add("error");
    validationprenom = 0;
  }
  validation();
}

function verifmdp1() {
  mdp1 = document.getElementById("mdp1").value;
  inputmdp1 = document.getElementById("mdp1");
  testmdp1 = mdp1.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/g);
  longueur = mdp1.length;
  if (longueur <= 50 && testmdp1) {
    inputmdp1.classList.add("valid");
    inputmdp1.classList.remove("error");
    validationmdp1 = 1;
  } else {
    inputmdp1.classList.add("error");
    inputmdp1.classList.remove("valid");
    validationmdp1 = 0;
  }
  validation();
}

function verifmdp2() {
  mdp1 = document.getElementById("mdp1").value;
  mdp2 = document.getElementById("mdp2").value;
  inputmdp2 = document.getElementById("mdp2");
  testmdp2 = mdp2.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/g);
  longueur = mdp2.length;
  if (longueur <= 50 && testmdp2 && mdp1 == mdp2) {
    inputmdp2.classList.add("valid");
    inputmdp2.classList.remove("error");
    validationmdp2 = 1;
  } else {
    inputmdp2.classList.add("error");
    inputmdp2.classList.remove("valid");
    validationmdp2 = 0;
  }
  validation();
}

function validation() {
  checkbox = document.getElementById("condition");
  console.log(checkbox.checked);
  if (checkbox.checked) {
    if (validationmail && validationprenom && validationmdp2) {
      condition = document.getElementById("submit");
      condition.classList.remove("disabled");
    } else {
      alert("tout les champs du formulaire doivent etre rempli");
      condition.classList.add("disabled");
    }
  } else {
    condition.classList.add("disabled");
  }
}

// fonction permettant l'utilisation du tooltip bootstrap
function tooltip() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
}
