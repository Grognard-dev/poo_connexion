<?php
require_once "Database.php";
require_once "boot.php";


$db = new Database($config["utilisateur"],$config["mdp"], $config["dsn"]);



if (isset($_POST['bouton'])){
    $pseudo_user = empty($_POST['pseudo_user']) ? null : $_POST['pseudo_user'];
    $nom_user = empty($_POST['nom_user']) ? null : $_POST['nom_user'];
    $prenom_user = empty($_POST['prenom_user']) ? null : $_POST['prenom_user'];
    $email_user= empty($_POST['email_user']) ? null : $_POST['email_user'];
    $password_user = empty($_POST['password_user']) ? null : $_POST['password_user'];
    
    if ($pseudo_user === null || $nom_user === null || $prenom_user === null || $email_user === null || $password_user === null) {
        $erreur = 'Veuillez remplir tous les champs';
    }else {
        $inscription = $db->prepareAndExecute("INSERT INTO utilisateur (Email, mot_de_passe, Prenom, Nom, Pseudo) 
        VALUES (:Email, :mot_de_passe, :Prenom, :Nom, :Pseudo)",
        [':Email' => $email_user,
        ':mot_de_passe' => password_hash($password_user, PASSWORD_DEFAULT ),
        ':Prenom' => $prenom_user,
        ':Nom'=>$nom_user,
        ':Pseudo'=>$prenom_user]) ;
        header('Location: /poo_connexion/connexion.php');
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
      <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<form action="inscription.php" method="POST">
<h2>Inscription</h2>

<label><b>Pseudo d'utilisateur</b></label>
<input class="login" type="text" name="pseudo_user" required> <br>

<label><b>Nom d'utilisateur</b></label>
<input class="login" type="text" name="nom_user" required> <br>

<label><b>Prenom d'utilisateur</b></label>
<input class="login" type="text" name="prenom_user" required> <br>

<label><b>Email d'utilisateur</b></label>
<input class="login" type="email" name="email_user" required> <br>

<label><b>Mot de passe</b></label>
<input class="login"  type="password" placeholder="Mot de passe" name="password_user" required><br>

<div class="bouton">
<button type="submit" name="bouton" class="btn btn-primary mb-2">s'inscrire</button>
</div>
<?php if(isset($erreur)){
    echo "<p>$erreur</p>";
}
?>
</form>

</body>
</html>