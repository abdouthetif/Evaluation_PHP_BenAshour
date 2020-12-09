<?php

// Inclusion des dépendances
require '../src/functions.php';

// Si problème avec l'id du produit -> message d'erreur + exit;
if (!isset($_GET['id'])) {
    echo 'Error : no valid logement id';
    exit;
}

// Récupère l'id du logement
$logementId = intval($_GET['id']);

// Récupération des détails d'un logement
$logementDetails = getLogementById($logementId);

// Inclusion du fichier de template
$pageTitle = $logementDetails['titre'];
render('logement_details', [
    'pageTitle' => $pageTitle, 
    'template_bg' => 'bg-light',
    'logementDetails' => $logementDetails
]);