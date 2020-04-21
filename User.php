<?php 
require_once "boot.php";
  //connecter votre BDD //
     $dbh = new PDO($config["dsn"], $config["utilisateur"], $config["mdp"]); 

class User{

    
    public $username;
    public $password;
    public $salutation;
    public function __construct($username,$password,$salutation)
    {
       
        $this->username =$username;
        $this->password=$password;
        $this->salutation=$salutation;
       
    }
    public function afficherSalutation(){
            $this->salutation->saluation();
            
        }
    public function parler(string $phrase)
    {
        echo $this->username.":$phrase<br>";
    }
    
    public function salutation(){
        $this->parler($this->salutation);
    }

    
}