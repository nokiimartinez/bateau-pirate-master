<?php

$cat = htmlspecialchars($_POST['cat']);
$nom = htmlspecialchars($_POST['nom']);
$artiste = htmlspecialchars($_POST['artiste']);
$sortie = htmlspecialchars($_POST['sortie']);
$prix = htmlspecialchars($_POST['prix']);

// if checkbox checked $dispo= 1 else dispo=0 ;
$dispo = htmlspecialchars($_POST['disponible']);


$ajoutDeVinyle= $bdd->prepare('INSERT INTO vinyl (Categorie_Vinyl , Nom_Vinyl , Groupe_Vinyl , Annee_sortie_Vinyl, Prix_Vinyl, Dispo_Vinyl) VALUES (:cat , :nom, :artiste, :sortie, :prix, :dispo)')


?>


<!-- //formulaire d'ajout de vinyle -->
<h2>Vinyles</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form Method="POST">
                <Label for="nom">Nom</Label>
                <input type="text" name="nom">
                <Label for="artiste">Artiste/Groupe</Label>
                <input type="text" name="artiste">
                <Label for="date de sortie">Date de sortie</Label>
                <input type="text" name="sortie">
                <Label for="categorie">Categorie</Label>
                <input type="text" name="cat">
                <Label for="prix">Prix</Label>
                <input type="text" name="prix">
                <label for="Check">Disponible</label>
                <input type="checkbox" class="form-check-input">
                <input class="btn btn-dark m-3" type="submit" name="ajouter" value="Ajouter">
            </form>
        </div>
    </div>
</div>