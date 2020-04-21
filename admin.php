<?php 
require "boot.php";
require "Database.php";
require "securite.php";
$dbh = new PDO($config["dsn"], $config["utilisateur"], $config["mdp"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <h1>tu est bien Admin , felicitation ! </h1>
    <a href="index.php">accueil</a>
</body>
</html>





