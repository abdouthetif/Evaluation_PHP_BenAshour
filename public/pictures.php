<?php

// Inclusion des dépendances
require '../src/functions.php';

// Récupère l'id du logement dans la requête ajax
$logementId = $_POST['logementId'];

// Récupère tous les détails d'un logement
$logementDetails = getLogementById($logementId);

// Stock un message de succes
$logementPictures = ['status' => 'success'];

// Vérifie s'il y a des images, si oui les stock une par une
if (!empty($logementDetails['picture_1'])) {
    $logementPictures['pictures'][] = $logementDetails['picture_1'];
}
if (!empty($logementDetails['picture_2'])) {
    $logementPictures['pictures'][] = $logementDetails['picture_2'];
}
if (!empty($logementDetails['picture_3'])) {
    $logementPictures['pictures'][] = $logementDetails['picture_3'];
}

// Envoi la réponse de la requête ajax
echo json_encode($logementPictures);