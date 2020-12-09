<?php

// Inclusion du fichier de configuration
require '../config_exemple.php';
require '../vendor/autoload.php';

/* Crée la connexion PDO */
function getPDOConnection()
{    
    // Construction du Data Source Name
    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
    
    // Tableau d'options pour la connexion PDO
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    
    // Création de la connexion PDO (création d'un objet PDO)
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    $pdo->exec('SET NAMES UTF8');

    return $pdo;
}

/* Prépare et exécute une requête SQL */
function prepareAndExecuteQuery(string $sql, array $criteria = []): PDOStatement
{
    // Connexion PDO
    $pdo = getPDOConnection();

    // Préparation de la requête SQL
    $query = $pdo->prepare($sql);

    // Exécution de la requête
    $query->execute($criteria);

    return $query;
}

/* Exécute une requête de sélection et retourne plusieurs résultats */
function selectAll(string $sql, array $criteria = [])
{
    // Prépare et exécute une requête SQL
    $query = prepareAndExecuteQuery($sql, $criteria);

    return $query->fetchAll();
}

/* Exécute une requête de sélection et retourne un résultat */
function selectOne(string $sql, array $criteria = [])
{
    // Prépare et exécute une requête SQL
    $query = prepareAndExecuteQuery($sql, $criteria);

    return $query->fetch();
}

/* Récupère tous les logements */
function getAllLogements()
{
    // Requête de sélection SQL
    $sql = 'SELECT id_logement, 
                   titre,
                   adresse, 
                   ville, 
                   cp,
                   surface,
                   prix,
                   logement.description,
                   label,
                   picture_1
            FROM logement
            JOIN `type` AS T
            ON logement.type_id = T.id_type
            JOIN picture
            ON logement.id_logement = picture.logement_id
            ORDER BY id_logement';

    return selectAll($sql);
}

/* Récupère tous les types de contrat */
function getAllTypes()
{
    // Requête de sélection SQL
    $sql = 'SELECT id_type, label
            FROM `type`
            ORDER BY label';
    
    return selectAll($sql);
}

/* Récupère les détails d'un logement à partir de son id*/
function getLogementById(int $id) 
{    
    // Requête de sélection SQL
    $sql = 'SELECT id_logement, 
                   titre,
                   adresse, 
                   ville, 
                   cp,
                   surface,
                   prix,
                   logement.description,
                   label,
                   picture_1,
                   picture_2,
                   picture_3
            FROM logement
            JOIN `type` AS T
            ON logement.type_id = T.id_type
            JOIN picture
            ON logement.id_logement = picture.logement_id
            WHERE id_logement = ?';
    
    return selectOne($sql, [$id]);
}

/* Ajoute le logement dans la BDD */
function insertLogement(string $title, string $address, string $city, int $zipcode, int $area, int $price, string $pictureA, string $pictureB, string $pictureC, int $typeId, string $description)
{
    // Requête de sélection SQL
    $sql = 'INSERT INTO logement (titre, adresse, ville, cp, surface, prix, type_id, description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);
            INSERT INTO picture (logement_id, picture_1, picture_2, picture_3)
            VALUES (LAST_INSERT_ID(), ?, ?, ?)';

    prepareAndExecuteQuery($sql, [$title, $address, $city, $zipcode, $area, $price, $typeId, $description, $pictureA, $pictureB, $pictureC]);
}

/******************************
 * GESTION DES MESSAGES FLASH
 ******************************/

/**
 * Démarre la session (le cas échéant, si aucune session n'est déjà démarrée)
 * Initialise un tableau vide à la clé 'flashbag' si jamais la clé n'existe pas 
 * ou si elle ne contient pas de tableau
 */
function initFlashbag()
{
    // Si aucune session n'est encore démarrée ...
    if (session_status() === PHP_SESSION_NONE) {

        // ... alors on en démarre une
        session_start();
    } 

    // Si la clé 'flashbag' n'existe pas en session ou si elle n'est pas définie... 
    if (!array_key_exists('flashbag', $_SESSION) || !isset($_SESSION['flashbag'])) {

        // ... alors on range dans la clé 'flashbag' un tableau vide
        $_SESSION['flashbag'] = [];
    }
}

/* Ajoute un message flash au flashbag en session */
function addFlashMessage(string $message)
{
    // Initialisation du flashbag
    initFlashbag();

    // On ajoute dans le tableau de message le message passé en paramètre
    // $_SESSION['flashbag'][] = $message;
    array_push($_SESSION['flashbag'], $message);
}

/* Récupère et retourne l'ensemble des messages flash de la session */
function fetchAllFlashMessages(): array 
{
    // Initialisation du flashbag
    initFlashbag();

    // On récupère tous les messages 
    $FlashMessages = $_SESSION['flashbag'];

    // On supprime les messages de la session
    $_SESSION['flashbag'] = [];

    // On retourne le tableau de messages
    return $FlashMessages;
}

/* Détermine si il y a des messages flash en session */
function hasFlashMessages(): bool
{
    // Initialisation du flashbag
    initFlashbag();

    // Retourne true si il y a des messages dans le tableau, false sinon
    return !empty($_SESSION['flashbag']);
}


/* Inclut le template de base et ses variables */
function render(string $template, array $values = [])
{
    // Extraction des variables
    extract($values);

    // Affichage des messages flash
    $flashMessages = fetchAllFlashMessages();

    /* Inclusion du template de base */
    include '../templates/base.phtml';
}

/******************************
 * VALIDATION DU FORMULAIRE
 ******************************/
function validateLogementForm($title, $address, $city, $zipcode, $area, $price, $typeId)
{
    $errors = [];

    if (!$title) {
        $errors[] = 'Le titre du logement est obligatoire';
    }

    if (!$address) {
        $errors[] = "L'adresse du logement est obligatoire";
    }

    if (!$city) {
        $errors[] = 'La ville du logement est obligatoire';
    }

    if (!$zipcode) {
        $errors[] = 'Le code postal du logement est obligatoire';
    }
    else if (!preg_match('#[0-9]{5}#', $zipcode)) {
        $errors[] = 'Le format du code postal est incorrect';
    }

    if (!$area) {
        $errors[] = 'La surface du logement est obligatoire';
    }
    else if (!is_numeric($area) || $area < 0) {
        $errors[] = 'La valeur de la surface est incorrecte';
    }

    if (!$price) {
        $errors[] = 'Le prix du logement est obligatoire';
    }
    else if (!is_numeric($price) || $price < 0) {
        $errors[] = 'La valeur du prix est incorrecte';
    }

    if (!$typeId) {
        $errors[] = 'Le type de contrat est obligatoire';
    }
    
    return $errors;
}