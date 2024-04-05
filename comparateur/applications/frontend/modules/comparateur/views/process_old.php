<?php

// Vérifie que le formulaire soit bien posté
if(!isset($_POST['assureur'])){
    die('La page ne doit pas être ouverture directement');
}

$db = \library\database\MyPDO::getInstance(DB_DSN, DB_USER, DB_PASS);
$comparateur = new \library\comparateur($db, $_POST);

// Recherche du nom de la nationalié
$sqlNationalite = 'SELECT name_fr FROM nationalites WHERE id=' . $_POST['nationalite'];
$stmtNationalite = $db->query($sqlNationalite);
$nationalite = $stmtNationalite->fetch(\PDO::FETCH_ASSOC);
// Recherche le nom de la langue
$sqlLangue = 'SELECT name_fr FROM langues WHERE id=' . $_POST['langue'];
$stmtLangue = $db->query($sqlLangue);
$langue = $stmtLangue->fetch(\PDO::FETCH_ASSOC);

$message = '<html>' . "\r\n";
$message .= '<head>';
$message .= '<meta charset="utf-8">' . "\r\n";
$message .= '<title>Comparateur d\'assurance maladie</title>' . "\r\n";
$message .= '</head>' . "\r\n";
$message .= "<h3>Assurance Actuelle</h3>\r\n";
$message .= "<p>Assurance : <strong>" . $comparateur->getAssureur($_POST['assureur'])['name'] . "</strong></p>\r\n";
$message .= "<p>Prime actuelle : <strong>" . number_format($_POST['assureurActuelTotal'], 2, "." , "'") . "</strong></p><br/>\r\n";
$message .= "<h3>Demande d'offre pour l'assurance</h3>\r\n";
$message .= "<p>Assurance : <strong>" . $comparateur->getAssureur($_POST['assureurSelectedId'])['name'] . "</strong></p>\r\n";
$message .= "<p>Prime actuelle : <strong>" . number_format($_POST['assureurSelectedTotal'], 2, "." , "'") . "</strong></p>\r\n";
$message .= "Tarif : <strong>" . $_POST['tarif'] . "</strong></p>\r\n";
$message .= "Tarif type : <strong>" . $_POST['tarifType'] . "</strong></p><br/>\r\n";
$message .= '<h3>Données personnelles</h3>' . "\r\n";

// Parcours toutes les personnes
for($i=1;$i<=$_POST['nbAssures'];$i++){
    $message .= "<h5><strong>Personne " . $i . "</strong></h5>\r\n";
    $message .= '<p>Nom : <strong>' . $_POST['nom-' . $i] . "</strong></p>\r\n";
    $message .= '<p>Prénom : <strong>' . $_POST['prenom-' . $i] . "</strong></p>\r\n";
    $message .= '<p>Date de naissance : <strong>' . $_POST['naissance-' . $i] . "</strong></p>\r\n";
    $message .= '<p>Sexe : <strong>' . $_POST['sexe-' . $i] . "</strong></p><br/>\r\n";    
}

$message .= '<h3>Coordonées</h3>' . "\r\n";
$message .= "<p>Adresse : <strong>" . $_POST['adresse'] . ' ' . $_POST['adresseNo'] . "</strong></p>\r\n";
$message .= "<p>Loclaité : <strong>" . $_POST['npa'] . ' ' . $_POST['ville'] . "</strong></p>\r\n";
$message .= "<p>Téléphone : <strong>" . $_POST['tel'] . "</strong></p>\r\n";
$message .= "<p>Email : <strong>" . $_POST['email'] . "</strong></p>\r\n";
$message .= "<p>Nationalité : <strong>" . $nationalite['name_fr'] . "</strong></p>\r\n";
$message .= "<p>Permis d'établissement : <strong>" . ((isset($_POST['permis']))?$_POST['permis']:'Pas de permis (Suisse)') . "</strong></p>\r\n";
$message .= "<p>Langue de correspondance : <strong>" . $langue['name_fr'] . "</strong></p><br/>\r\n";
$message .= '<h3>Division hospitalière</h3>' . "\r\n";
$message .= '<p>' . (($_POST['division'] !== '-1')?$_POST['division']:'Aucune') . '</p><br/>' . "\r\n";
$message .= '<h3>Garantie(s) sélectionnée(s) par l\'assuré</h3>' . "\r\n";

// Vérification des garanties sélectionnées par l'assuré
if(isset($_POST['medecineDouce'])){
    $message .= '<p>Médecine Douce : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Médecine Douce : <strong>Non</strong></p>' . "\r\n";
}

if(isset($_POST['prevoyanceSante'])){
    $message .= '<p>Prévoyance santé : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Prévoyance santé : <strong>Non</strong></p>' . "\r\n";
}

if(isset($_POST['preventionSante'])){
    $message .= '<p>Prévention santé : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Prévention santé : <strong>Non</strong></p>' . "\r\n";
}

if(isset($_POST['maternite'])){
    $message .= '<p>Maternité : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Matérnité : <strong>Non</strong></p>' . "\r\n";
}

if(isset($_POST['urgencesEtranger'])){
    $message .= '<p>Urgences étranger : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Urgences étranger : <strong>Non</strong></p>' . "\r\n";
}

if(isset($_POST['correctionsVue'])){
    $message .= '<p>Corrections de la vue : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Corrections de la vue : <strong>Non</strong></p>' . "\r\n";
}

if(isset($_POST['rechercheSauvetage'])){
    $message .= '<p>Recherches et sauvetage : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Recherches et sauvetage : <strong>Non</strong></p>' . "\r\n";
}

if(isset($_POST['transport'])){
    $message .= '<p>Transport : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Transport : <strong>Non</strong></p>' . "\r\n";
}

if(isset($_POST['orthodontie'])){
    $message .= '<p>Orthodontie : <strong>Oui</strong></p>' . "\r\n";
} else {
    $message .= '<p>Orthodontie : <strong>Non</strong></p>' . "\r\n";
}

$message .= '</div>' . "\r\n";
//$message .= '</body>' . "\r\n";
//$message .= '</html>' . "\r\n";
//
//// Entête de l'email
//$headers = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-Type:text/html;charset=utf-8' . "\r\n";
//$headers .= 'From:<noreply@syntesis.ch>' . "\r\n";
//$headers .= 'Reply-to:<noreply@syntesis.com>';

// Envoie du mail
//$result = @mail('info@syntesis.ch', 'Demande d\'offre assurance maladie', $message, $headers);

echo $message;


// Vérifie que le mail ait bien été envoyé
//if(!$result){
//    die('Un erreur s\'est produite : ' . error_get_last()['message']);
//} else {
//    header('Location: http://economies.ch/');
//}