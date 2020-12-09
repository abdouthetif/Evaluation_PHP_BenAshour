<?php

// Inclusion des dépendances
require '../src/functions.php';

// Récupère tous les logements
$logements = getAllLogements();

// Inclusion du fichier de template
render('index', [
    'pageTitle' => 'Accueil', 
    'template_bg' => 'bg-light',
    'logements' => $logements
]);