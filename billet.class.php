<?php

require_once('crud.interface.php');

class Billet implements Ibillet
{
    private $connection;
    private $date_heure_reservation;
    private $statut;
    private $id_client;
    private $id__trajet;

    public function __construct($connection, $date_heure_reservation, $statut, $id_client, $id__trajet)
    {
        $this->connection = $connection;
        $this->date_heure_reservation = $date_heure_reservation;
        $this->statut = $statut;
        $this->id_client = $id_client;
        $this->id__trajet = $id__trajet;
    }

    // getters et setters
    public function getDate()
    {
        return $this->date_heure_reservation;
    }
    public function setDate($n_date)
    {
        $this->date_heure_reservation = $n_date;
    }

    public function getStatut()
    {
        return $this->statut;
    }
    public function setStatut($n_statut)
    {
        $this->statut = $n_statut;
    }

    public function getClient()
    {
        return $this->id_client;
    }
    public function setClient($n_idClient)
    {
        $this->id_client = $n_idClient;
    }

    public function getTrajet()
    {
        return $this->id__trajet;
    }
    public function setTrajet($n_idTrajet)
    {
        $this->id__trajet = $n_idTrajet;
    }


    public function create($date_heure_reservation, $statut, $id_client, $id__trajet){
        try {
            $sql = "INSERT INTO billets (date_heure_reservation, statut, id_client, id__trajet) VALUES (:date_heure_reservation, :statut, :id_client, :id__trajet)";
            $req = $this->connection->prepare($sql);
            $req->bindValue(':date_heure_reservation', $date_heure_reservation);
            $req->bindValue(':statut', $statut);
            $req->bindValue(':id_client', $id_client, PDO::PARAM_INT);
            $req->bindValue(':id__trajet', $id__trajet, PDO::PARAM_INT);
            $req->execute();

            header("location: index.php");
            exit();
        } catch (PDOException $erreur) {
            die("Erreur !: " . $erreur->getMessage() . "<br/>");
        }
    }

    public function read()
    {
        try {
            $sql = 'SELECT billets.id, nom, prenom, telephone 
            FROM billets 
            JOIN clients ON billets.id_client = clients.id
            ORDER BY billets.id;
            ';

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $billets = $statement->fetchAll(PDO::FETCH_OBJ);
            return $billets;
        } catch (PDOException $erreur) {
            die("Erreur !: " . $erreur->getMessage() . "<br/>");
        }
    }

    public function afficherDetails($id)
    {

        try {
            $sql = "SELECT * FROM billets JOIN clients ON billets.id_client = clients.id JOIN trajets ON trajets.id = billets.id__trajet WHERE billets.id= :id";
            $req = $this->connection->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
            $details = $req->fetch(PDO::FETCH_ASSOC);
            return $details;
        } catch (PDOException $erreur) {
            die("Erreur !: " . $erreur->getMessage() . "<br/>");
        }
    }

    public function update($id, $date_heure_reservation, $statut, $id_client, $id__trajet)
{
    try {
        $sql = "UPDATE billets SET date_heure_reservation = :date_heure_reservation , statut = :statut , id_client = :id_client, id__trajet = :id__trajet WHERE id = :id";
        $req = $this->connection->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':date_heure_reservation', $date_heure_reservation);
        $req->bindValue(':statut', $statut);
        $req->bindValue(':id_client', $id_client, PDO::PARAM_INT);
        $req->bindValue(':id__trajet', $id__trajet, PDO::PARAM_INT);
        $req->execute();

        header("location: index.php");
        exit();
    } catch (PDOException $erreur) {
        die("Erreur !: " . $erreur->getMessage() . "<br/>");
    }   
}

    public function delete()
    {
        
    }
}
