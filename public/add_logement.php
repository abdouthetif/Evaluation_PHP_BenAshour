<?php

// Inclusion des dépendances
require '../src/functions.php';

// Initialisation
$errors = null;

// Si le formulaire est soumis 
if (!empty($_POST)) {
    
    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipcode = intval($_POST['zipcode']);
    $area = intval($_POST['area']);
    $price = intval($_POST['price']);
    $pictureA = $_POST['picture_1'];
    $pictureB = $_POST['picture_2'];
    $pictureC = $_POST['picture_3'];
    $typeId = intval($_POST['type']);
    $description = $_POST['description'];
    
    // Validation des données
    $errors = validateLogementForm($title, $address, $city, $zipcode, $area, $price, $typeId); 
    
    // Si tout est OK
    if (empty($errors)) {

        // Insertion du logement dans la BDD
        insertLogement($title, $address, $city, $zipcode, $area, $price, $pictureA, $pictureB, $pictureC, $typeId, $description);

        // Message flash puis redirection vers la page d'accueil
        addFlashMessage('Logement correctement ajouté');

        header('Location:index.php');
        
        exit;
    }

}    

// Sélection des types de contrat
$types = getAllTypes();

// Inclusion du fichier de template
render('add_logement', [
    'pageTitle' => 'Ajouter un logement', 
    'template_bg' => 'bg-light',
    'errors' => $errors,
    'types' => $types
]);