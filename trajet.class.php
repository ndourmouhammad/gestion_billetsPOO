<?php

class Trajet {

    public $trajet;
    public $heure_depart;
    public $heure_arrivee;
    public $compagnie;
    public $prix;
    public $connection;

    public function __construct($connection, $trajet, $heure_depart, $heure_arrivee, $compagnie, $prix) {
        
        $this->connection = $connection;
        $this->trajet = $trajet;
        $this->heure_depart  = $heure_depart;
        $this->heure_arrivee = $heure_arrivee;
        $this->compagnie = $compagnie;
        $this->prix = $prix;
        
    }

    public function getTrajet()
{
    try {
        $sql = 'SELECT * FROM trajets';
        $req = $this->connection->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $erreur) {
        die('Erreur de connexion : ' . $erreur->getMessage());
    }
}

}