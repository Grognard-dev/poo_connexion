<?php

require_once "Connexion.php";
require_once "User.php";

  $connexion = new Database($config["dsn"], $config["utilisateur"], $config["mdp"]);
  $dbh = $connexion->PDOConnexion();

  function user($pseudo,$password,$ID){

return  new User($pseudo, $password,$ID);
        
}

  
if(isset($_POST['button'])){
    $pseudo =  empty($_POST['pseudo']) ? null : $_POST['pseudo'];
    $password =  empty($_POST['password']) ? null : $_POST['password'];
     $ID =  empty($_POST['id']) ? null : $_POST['id'];

    
    if($pseudo === null || $password === null || $ID === null){
        $erreur = "Veuillez remplir tous les champs";
    }else{
        $user = user($pseudo,$password,$ID);  
         $connexion = new Database($pseudo,$password,$ID);
          $_SESSION['connexion'] = serialize($connexion);
          header('location: index.php');
          die;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
    <label for="nom">Nom personnage</label>
    <input type="text" name="pseudo" id="pseudo">
        <label for="nom">mot de passe</label>
    <input type="text" name="password" id="password">
    <button type="submit" name="button">connexion</button>
  <?=  $erreur ?>
    </form>
</body>
</html>