<?php session_start()?>
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

    <div class="row">
        <?php require_once("header.php") ?>
    </div>

    <div class="container-fluid mynavbar">
    <div class="row align-items-center" style="min-height: 353px;">
        <div class="col d-flex flex-row  justify-content-center"> 
            <input type="search" class="search form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="width:350px"/>
            <button type="button" class="btn_search btn btn-dark">Rechercher</button>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col "><div id="panelpanier" class="float-end"></div></div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script>
</html>


