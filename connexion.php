<?php

require_once "boot.php";

$db = new Database($config["utilisateur"],$config["mdp"], $config["dsn"]);

if (isset($_POST['bouton'])){
    $pseudo_user = empty($_POST['pseudo_user']) ? null : $_POST['pseudo_user'];
    $password_user = empty($_POST['password_user']) ? null : $_POST['password_user'];
    
    if ($pseudo_user === null || $password_user === null) {
        echo 'Veuillez remplir tous les champs';
    }else {
        
       
// la fonction prépare et execute son dans la meme fonction, il suffit de la remplir de votre requete et de vos valeurs //
       
        $usertable = new UserTable($db);
        $utilisateur = $usertable->recupParPseudo($pseudo_user);
        $actif = $utilisateur->actif;
        if($utilisateur === null){
            $erreur =  "login et / ou mot de passe incorrect";
        }
        
        if(!password_verify($password_user, $utilisateur->mot_de_passe ?? '')) {
            $erreur =  "login et / ou mot de passe incorrect";
        }
        if($actif == '0')
        {
            $erreur = "compte non actif";
        }
        if( $erreur === null ){
            if (session_status() === PHP_SESSION_NONE){
                session_start();
            }
            session_regenerate_id();
            $_SESSION["ID"] = $utilisateur->ID_utilisateur;
            $_SESSION["Pseudo"] = $utilisateur->pseudo;
            if($utilisateur->admin === 1){
                $_SESSION['is_admin'] = true;
            }else{
                $_SESSION['is_admin'] = false;
            }
            header('Location: index.php');
            exit();
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>connexion</title>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<form action="" method="POST">
<h2>Connexion</h2>

<?php if($erreur != null){
    echo "<p>$erreur</p>";
}
?>

<label class="block text-gray-700 text-dm font-bold mb-2"><b>Nom d'utilisateur</b></label>
<input class="shadow appearance-none border rounded w-64 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline " type="text" name="pseudo_user" required> <br>

<label class="block text-gray-700 text-dm font-bold mb-2"><b>Mot de passe</b></label>
<input class="shadow appearance-none border rounded w-64 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "  type="password" name="password_user" required><br>

<div class="bouton">
<button class=" m-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="bouton" class="btn btn-primary mb-2">connexion</button>
</div>


<?php
if(isset($_GET['erreur'])){
    $err = $_GET['erreur'];
    if($err==1 || $err==2)
    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
}
?> 
</form>

</body>
</html>