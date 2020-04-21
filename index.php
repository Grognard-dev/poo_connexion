<?php
require_once "Database.php";
require_once "boot.php";

$db = new Database($config["utilisateur"],$config["mdp"], $config["dsn"]);
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
</body>
</html>