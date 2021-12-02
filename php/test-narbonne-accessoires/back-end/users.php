<?php

$host = 'localhost';
$bdd = 'test-narbonne';
$user = 'root';
$password = '';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$bdd;charset=utf8", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('erreur de connexion' . $e->getMessage());
}

$req = $bdd->prepare("SELECT user.id, user.nom, prenom, email, adresse, ville, consentement, cp, telephone, concours.reponse, GROUP_CONCAT(vehicule.nom) as vehicules FROM `user` LEFT JOIN user_vehicule on user.id = user_vehicule.user_id LEFT JOIN vehicule on vehicule.id = user_vehicule.vehicule_id LEFT JOIN concours on user.id = concours.user_id GROUP BY user.id, user.nom, prenom, email, adresse, ville, consentement, cp, telephone, concours.reponse");
$req->execute();
$users = $req->fetchAll();
