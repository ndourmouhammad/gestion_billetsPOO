<?php

interface IClient
{
    public function create($nom, $prenom, $email, $adresse, $telephone);
    public function read();
    public function update($id, $nom, $prenom, $email, $adresse, $telephone);
    public function delete($id);
}

interface Ibillet
{
    public function create($date_heure_reservation, $statut, $id_client, $id__trajet);
    public function read();
    public function update($id, $date_heure_reservation, $statut, $id_client, $id__trajet);
    public function delete($id);
}