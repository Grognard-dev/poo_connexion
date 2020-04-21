<?php 
require_once "boot.php";
  //connecter votre BDD //
     $dbh = new PDO($config["dsn"], $config["utilisateur"], $config["mdp"]); 

class User{

    
    public $username;
    public $password;

    public function __construct($username,$password)
    {
       
        $this->username =$username;
        $this->password=$password;
       
    }

    

    
}