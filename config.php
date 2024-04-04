<?php
require_once("billet.class.php");
require_once("client.class.php");
require_once("trajet.class.php");




define('DSN', 'mysql:host=localhost;dbname=gestion_billets;charset=utf8');
define('USER', 'root');
define('PASSWORD', '');

try {
    $connection = new PDO(DSN, USER, PASSWORD);
    // Instanciation de la classe Billet
    $date = '';
    $statut = '';
    $id_client = 0;
    $id__trajet = 0;
    $billet = new Billet($connection, $date, $statut, $id_client, $id__trajet);


    // Instanciation de la classe Client
    $nom = '';
    $prenom = '';
    $email = '';
    $adresse = '';
    $telephone = 0;

    $client = new Client($connection, $nom, $prenom, $email, $adresse, $telephone);
    

    // Instanciation de la classe Trajet
    $trajet = '';
    $heure_depart = 0;
    $heure_arrivee = 0;
    $compagnie = '';
    $prix = 0;

    $trajets = new Trajet($connection, $trajet, $heure_depart, $heure_arrivee, $compagnie, $prix);

} catch (PDOException $erreur) {
    die('Erreur de connexion : ' . $erreur->getMessage());
}
