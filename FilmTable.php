<?php 
require_once "boot.php";
require_once "Database.php";
require_once "Film.php";


class FilmTable
{
    protected $db; 
    
    
    
    public function __construct($db)
    {
        $this->db = $db;
       
    }
    
     public  function recupParId($ID_film)
    {
         $requete = $this->db->prepareAndExecute('SELECT * FROM Film WHERE ID_film = :ID_film',[':ID_film' => $ID_film]);
        $tableau = $requete->fetch();
        if($tableau === false){
            return null;
        }
        return $this->createFilm($tableau);
    }

    public function recupParNomfilm($Nom_du_film)
    {
         $requete = $this->db->prepareAndExecute('SELECT * FROM Film WHERE Nom_du_film = :Nom_du_film',[':Nom_du_film' => $Nom_du_film]);
        $tableau = $requete->fetch();
        if($tableau === false){
            return null;
        }
        return $this->createFilm($tableau);
    }

    public function recuptous()
    {
         $requete = $this->db->prepareAndExecute("SELECT * FROM Film",[]);
        $tableau = $requete->fetchAll();
        if($tableau === false){
            return null;
        }
        $tab = [];
        foreach ($tableau as $film)
        {
            $tab[$film['ID_film']]  = $this->createFilm($film);
            
        }
         return $tab;
        
       
    }

    protected function createFilm($tableau)
    {
         $film = new Film();
        $film->ID_film = $tableau['ID_film'];
        $film->Nom_du_film = $tableau['Nom_du_film'];
        $film->Date_de_sortie = $tableau['Date_de_sortie'];
        $film->Affiche = $tableau['Affiche'];
        $film->synopsis = $tableau['synopsis'];
        return $film;
    }
}