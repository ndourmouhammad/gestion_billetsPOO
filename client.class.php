<?php
require_once("crud.interface.php");
require_once('validation.trait.php');

// classe client
class Client implements IClient
{
    use Validation;
    
    private $connection;
    private $nom;
    private $prenom;
    private $email;
    private $adresse;
    private $telephone;


    public function __construct($connection, $nom, $prenom, $email, $adresse, $telephone)
    {
        $this->connection = $connection;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
    }


    // les getters et les setters

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($n_nom)
    {
        $this->nom = $n_nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($n_prenom)
    {
        $this->prenom = $n_prenom;
    }


    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($n_email)
    {
        $this->email = $n_email;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }
    public function setTelephone($n_telephone)
    {
        $this->telephone = $n_telephone;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setAdresse($n_adresse)
    {
        $this->adresse = $n_adresse;
    }


    // La méthode ajouter client
    public function create($nom, $prenom, $email, $adresse, $telephone)
    {
        try {
            $sql = "INSERT INTO clients (nom, prenom, email, adresse, telephone) VALUES (:nom, :prenom, :email, :adresse, :telephone)";
            $req = $this->connection->prepare($sql);
            $req->bindValue(':nom', $nom);
            $req->bindValue(':prenom', $prenom);
            $req->bindValue(':email', $email);
            $req->bindValue(':adresse', $adresse);
            $req->bindValue(':telephone', $telephone, pdo::PARAM_INT);
            $req->execute();

            header("location: clientele.php");
            exit();
        } catch (PDOException $erreur) {
            die("Erreur !: " . $erreur->getMessage() . "<br/>");
        }
    }

    public function update($id, $nom, $prenom, $email, $adresse, $telephone)
    {
        try {
            $sql = 'UPDATE clients SET nom = :nom, prenom = :prenom, email = :email, adresse = :adresse, telephone = :telephone WHERE id = :id';
            $req = $this->connection->prepare($sql);
            $req->bindValue(":id", $id, PDO::PARAM_INT);
            $req->bindValue("nom", $nom);
            $req->bindValue("prenom", $prenom);
            $req->bindValue("email", $email);
            $req->bindValue("adresse", $adresse);
            $req->bindValue("telephone", $telephone, PDO::PARAM_INT);
            $req->execute();

            header("location: clientele.php");
            exit();
        } catch (PDOException $erreur) {
            die("Erreur !: " . $erreur->getMessage() . "<br/>");
        }
    }

    public function delete($id)
    {
        try {
            $sql = 'DELETE FROM clients WHERE id = :id';
            $req = $this->connection->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();

            header("location: clientele.php");
            exit();
        } catch (PDOException $erreur) {
            die("Erreur !: " . $erreur->getMessage() . "<br/>");
        }
    }


    public function read()
    {
        try {
            $sql = 'SELECT * FROM clients';

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $clients = $statement->fetchAll(PDO::FETCH_OBJ);
            return $clients;
        } catch (PDOException $erreur) {
            die("Erreur !: " . $erreur->getMessage() . "<br/>");
        }
    }
}
