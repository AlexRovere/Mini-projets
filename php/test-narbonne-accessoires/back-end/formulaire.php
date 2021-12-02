<?php

$host = 'localhost';
$bdd = 'test-narbonne';
$user = 'root';
$password = '';

var_dump($_POST);

if (isset($_POST) && $_POST != null) {

    $vehicule = $_POST['checkbox'];

    unset($_POST['checkbox']);

    foreach ($_POST as $key => $value) {
        htmlspecialchars($value);
    }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $cp =  $_POST['cp'];
    $radio = $_POST['radio'];
    $reponse = $radio;
    $adresse = "non renseigné";
    $ville = "non renseigné";
    $date = date('Y-m-d');

    var_dump($date);

    if ($_POST['consentement'] = 'on') {
        $consentement = true;
    } else {
        $consentement = false;
    }

    if (isset($_POST['adresse'])) {
        $adresse = $_POST['adresse'];
    }
    if (isset($_POST['ville'])) {
        $ville = $_POST['ville'];
    }

    try {
        $bdd = new PDO("mysql:host=$host;dbname=$bdd;charset=utf8", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('erreur de connexion' . $e->getMessage());
    }

    // Création user en base de données
    $req = $bdd->prepare('INSERT INTO user (nom, prenom, email, telephone, cp, adresse, ville, consentement) VALUES (:nom, :prenom, :email, :telephone, :cp, :adresse, :ville, :consentement)');

    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':email', $email);
    $req->bindParam(':telephone', $telephone);
    $req->bindParam(':cp', $cp);
    $req->bindParam(':adresse', $adresse);
    $req->bindParam(':ville', $ville);
    $req->bindParam(':consentement', $consentement);
    $req->execute();

    // Création réponse associé au user en base de données
    $id = $bdd->lastInsertId(); // On récupère le dernier ID de la bdd (celui qu'on vient de rentrer pour notre nouveau user) afin de mettre à jour les véhicules associés
    $req = $bdd->prepare('INSERT INTO concours (user_id, reponse, created_at) VALUES (:id, :reponse, :date)');
    $req->bindParam(':id', $id);
    $req->bindParam(':reponse', $reponse);
    $req->bindParam(':date', $date);
    $req->execute();


    if (isset($vehicule)) {
        // Création véhicule associé au user en base de données
        $req = $bdd->prepare('SELECT * from vehicule');
        $req->execute();
        $vehicule_id = $req->fetchAll();
        foreach ($vehicule_id as $key => $value) {
            if (in_array($value['nom'], $vehicule)) {
                $req = $bdd->prepare('INSERT INTO user_vehicule (user_id, vehicule_id) VALUES (:id, :vehicule_id)');
                $req->bindParam(':id', $id);
                $req->bindParam(':vehicule_id', $value['id']);
                $req->execute();
            }
        }
    }

    header('Location: ../confirmation.php');
}
