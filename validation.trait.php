<?php

trait Validation
{
    public function validerChaine($chaine)
    {
        if (!empty($chaine)) {
            $regex = '/^[A-Za-z\s]+$/u';
            return preg_match($regex, $chaine);
        } else {
            return false; // Le champ est vide, donc invalide
        }
    }

    public function validerEmail($email)
    {
        if (!empty($email)) {
             return filter_var($email, FILTER_VALIDATE_EMAIL);
        } else {
            return false;
        }
    }

    public function validerTelephone($telephone)
    {
        if (!empty($telephone)) {
            $regex = '';
        }
    }
}