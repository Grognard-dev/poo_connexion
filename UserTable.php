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
        return $this->createUser($tableau);
    }

    public function recupParPseudo($pseudo)
    {
         $requete = $this->db->prepareAndExecute('SELECT * FROM utilisateur WHERE Pseudo = :Pseudo',[':Pseudo' => $pseudo]);
        $tableau = $requete->fetch();
        if($tableau === false){
            return null;
        }
        return $this->createUser($tableau);
    }

    protected function createUser($tableau)
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
        return $user;
    }
}