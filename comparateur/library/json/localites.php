<?php

include_once '../../library/constantes.php';

// Vérifie qu'il y ait bien une requête
if(isset($_GET['query'])) {
    // Mot tapé par l'utilisateur
    $q = htmlentities(trim($_GET['query']));
    include_once '../../library/database/MyPDO.class.php';
    // Inclusion de la base de données
    $db = \library\database\MyPDO::getInstance(DB_DSN, DB_USER, DB_PASS);
    // Requête SQL
    $requete = "SELECT id, npa, localite, canton, commune FROM regions WHERE npa LIKE '" . $q . "%' OR LOWER(localite) LIKE '" . $q . "%' LIMIT 0, 10";
    // Exécution de la requête SQL
    $resultat = $db->query($requete) or die(print_r($bdd->errorInfo()));
    // On parcourt les résultats de la requête SQL
    while($donnees = $resultat->fetch(\PDO::FETCH_ASSOC)) {
        // On ajoute les données dans un tableau
        if($donnees['localite'] !== $donnees['commune']){
            $suggestions['suggestions'][] = array('value' => $donnees['npa'] . ' ' . $donnees['commune'] . ' (' . $donnees['canton'] . ') ' . $donnees['localite'], 'data' => $donnees['id']);
        }else{
            $suggestions['suggestions'][] = array('value' => $donnees['npa'] . ' ' . $donnees['localite'] . ' (' . $donnees['canton'] . ')', 'data' => $donnees['id']);
        }
    }
    // On renvoie le données au format JSON pour le plugin
    echo json_encode($suggestions);
}