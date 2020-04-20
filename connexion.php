<?php
require_once "Database.php";
require_once "boot.php";

$db = new Database($config["utilisateur"],$config["mdp"], $config["dsn"]);

if (isset($_POST['bouton'])){
    $pseudo_user = empty($_POST['pseudo_user']) ? null : $_POST['pseudo_user'];
    $password_user = empty($_POST['password_user']) ? null : $_POST['password_user'];
    
    if ($pseudo_user === null || $password_user === null) {
        echo 'Veuillez remplir tous les champs';
    }else {
        $requeteprepare = $db->prepareAndExecute('SELECT * FROM utilisateur WHERE Pseudo = :Pseudo',[":Pseudo" => $pseudo_user] );
        
        $utilisateur = $requeteprepare->fetch(PDO::FETCH_ASSOC);
        if($utilisateur === false){
            $erreur =  "login et / ou mot de passe incorrect";
        }
        
        if(!password_verify($password_user, $utilisateur["mot_de_passe"] ?? '')) {
            $erreur =  "login et / ou mot de passe incorrect";
        }
        
        if( $erreur === null){
            if (session_status() === PHP_SESSION_NONE){
                session_start();
            }
            session_regenerate_id();
            $_SESSION["ID"] = $utilisateur["ID_utilisateur"];
            $_SESSION["Pseudo"] = $utilisateur["Pseudo"];
            if($utilisateur["Admin"] === "1"){
                $_SESSION['is_admin'] = true;
            }else{
                $_SESSION['is_admin'] = false;
            }
            header('Location: http://lefevre.simplon-charleville.fr/poo_connexion/connexion.php');
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
<title>Document</title>
</head>
<body>

<form action="" method="POST">
<h2>Connexion</h2>

<?php if($erreur != null){
    echo "<p>$erreur</p>";
}
?>

<label><b>Nom d'utilisateur</b></label>
<input type="text" name="pseudo_user" required> <br>

<label><b>Mot de passe</b></label>
<input  type="password" name="password_user" required><br>

<div class="bouton">
<button type="submit" name="bouton" class="btn btn-primary mb-2">connexion</button>
</div>


<?php
if(isset($_GET['erreur'])){
    $err = $_GET['erreur'];
    if($err==1 || $err==2)
    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
}
?> 
</body>
</html>