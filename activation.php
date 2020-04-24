<?php
require "boot.php"; 

$db = new Database($config["utilisateur"],$config["mdp"], $config["dsn"]);
$userTable = new UserTable($db);

if(empty($_GET['Pseudo']))
{
  $erreur = "Erreur Pseudo";
  die;
}
if(empty($_GET['token_utilisateur']))
{
  $erreur = "Erreur token";
  die;
}
$Pseudo = $_GET['Pseudo'];
$token_utilisateur = $_GET['token_utilisateur'];


$user = $userTable->recupParPseudo($Pseudo);
if($user === null){
  $erreur = "User invalid";
  die;
}
if($user->actif == 1)
{
  echo "Votre compte est déjà actif !";
}
else 
{
 
  if($token_utilisateur == $user->token_utilisateur)    
  {

     $userTable->activationtoken($user->pseudo);
      
      echo "Votre compte a bien été activé !";
      echo "<a href='connexion.php'>Retour a la page de connexion</a>";
  }
  else 
  {
    echo "Erreur ! Votre compte ne peut être activé...";
  }
}

