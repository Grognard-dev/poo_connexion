<?php 
require_once "boot.php";
require_once "Database.php";
require_once "User.php";


class UserTable
{
    protected $db; 
    
    
    
    public function __construct($db)
    {
        $this->db = $db;
        
    }
    
    public  function recupParId($ID)
    {
        $requete = $this->db->prepareAndExecute('SELECT * FROM utilisateur WHERE ID_utilisateur = :ID_utilisateur',[':ID_utilisateur' => $ID]);
        $tableau = $requete->fetch();
        if($tableau === false){
            return null;
        }
        return $this->createUserFromDbResult($tableau);
    }
    
    public function recupParPseudo($pseudo)
    {
        $requete = $this->db->prepareAndExecute('SELECT * FROM utilisateur WHERE Pseudo = :Pseudo',[':Pseudo' => $pseudo]);
        $tableau = $requete->fetch();
        if($tableau === false){
            return null;
        }
        return $this->createUserFromDbResult($tableau);
    }

    public function activationtoken($pseudo)
    {
     
        $this->db->prepareAndExecute("UPDATE utilisateur SET actif = 1 WHERE Pseudo = :Pseudo ",[':Pseudo' => $pseudo]);
      
     
    }
    
    
    public function insertUser($user)
    {
        
        $inscription = $this->db->prepareAndExecute("INSERT INTO utilisateur (Email, mot_de_passe, Prenom, Nom, Pseudo,token_utilisateur,actif) 
        VALUES (:Email, :mot_de_passe, :Prenom, :Nom, :Pseudo,:token_utilisateur,:actif)",
        [':Email' => $user->email,
        ':mot_de_passe' => password_hash($user->mot_de_passe, PASSWORD_DEFAULT ),
        ':Prenom' => $user->prenom,
        ':Nom'=>$user->nom,
        ':Pseudo'=>$user->pseudo,
        ':token_utilisateur'=> $user->token_utilisateur,
        ':actif'=>0
        ]) ;
    
    }
    
    protected function createUserFromDbResult($tableau)
    {
        $user = new User();
        //hydratation des valeurs //
        $user->ID_utilisateur = $tableau['ID_utilisateur'];
        $user->nom = $tableau['Nom'];
        $user->prenom = $tableau['Prenom'];
        $user->mot_de_passe = $tableau['mot_de_passe'];
        $user->pseudo = $tableau['Pseudo'];
        $user->email = $tableau['Email'];
        $user->admin = $tableau['Admin'];
        $user->token_utilisateur = $tableau['token_utilisateur'];
        $user->actif = $tableau['actif'];
        return $user;
    }
}