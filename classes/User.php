<?php 
require_once "boot.php";
require_once "Database.php";
require_once "UserTable.php";

class User
{
   
    public $ID_utilisateur;
    public $nom;
    public $prenom;
    public $mot_de_passe;
    public $pseudo;
    public $email;
    public $admin;
    
    public function __construct()
    {
    }
   
    
}