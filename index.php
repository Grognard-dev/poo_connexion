<?php
require_once "boot.php";
require_once "User.php";
require_once 'UserTable.php';
require_once "Database.php";
require_once "FilmTable.php";
require_once "Film.php";

$db = new Database($config["utilisateur"],$config["mdp"], $config["dsn"]);

$usertable = new UserTable($db);

$filmtable = new FilmTable($db);

    $films = $filmtable->recuptous();
       
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <?php include "navbar.php";?>
    <form method="post">
        <?php 
        
        echo "<select class='block appearance-none w-48 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline m-4' name='select_genre' >";
            
            foreach($films as $film){
                
                echo   "<option value=".$film->ID_film.">".$film->Nom_du_film."</option>";
                
            } 
            echo "</select>";
            ?>
            <div class="bouton">
                <button class="shadow bg-purple-300 hover:bg-purple-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded m-4" type="submit" name="ajout_film" class="btn btn-primary mb-2">ajout film</button>
            </div>
           <?php $affiche = $filmtable->recupParNomfilm($film->Nom_du_film); ?>
        </form>
    <?= $affiche->Nom_du_film;?>
       <?= $affiche->Affiche;?>
       <?= $affiche->Date_de_sortie;?>
       <?= $affiche->synopsis;?>
    </body>
    </html>