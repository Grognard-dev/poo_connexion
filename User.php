<?php
class User{
    protected $ID;
    protected $pseudo;
    protected $password;

    public function __construct($password,$pseudo)
    {
        
        $this->pseudo = $pseudo;
        $this->password = $password;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getID()
    {
        return $this->ID;
    }

 
}