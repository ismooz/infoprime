<?php
/* Template Name: process */

include ABSPATH . '/comparateur/library/database/MyPDO.class.php';
include ABSPATH . '/comparateur/library/comparateur.class.php';

// Enregistrement dans la base de données
$assureurId = $_POST['assureur'];
$assureurOffreId = $_POST['assureurSelectedId'];
$primeActuelle = $_POST['assureurActuelTotal'];
$primeNouvelleOffre = $_POST['assureurSelectedTotal'] / 12;
$tarif = $_POST['tarif'];
$tarifType = $_POST['tarifType'];
$modelStandard = isset($_POST['standard'])?1:0;
$modelMf = isset($_POST['medecinFamille'])?1:0;
$modelHmo = isset($_POST['hmo'])?1:0;
$modelTelmed = isset($_POST['telmed'])?1:0;
$modelAutre = isset($_POST['autre'])?1:0;
$division = $_POST['division'];
$medecineDouce = isset($_POST['medecineDouce'])?1:0;
$prevoyanceSante = isset($_POST['prevoyanceSante'])?1:0;
$preventionSante = isset($_POST['preventionSante'])?1:0;
$maternite = isset($_POST['maternite'])?1:0;
$urgencesEtranger = isset($_POST['urgencesEtranger'])?1:0;
$correctionsVue = isset($_POST['correctionsVue'])?1:0;
$rechercheSauvetage = isset($_POST['rechercheSauvetage'])?1:0;
$transport = isset($_POST['transport'])?1:0;
$orthodontie = isset($_POST['orthodontie'])?1:0;
$adresse = $_POST['adresse'];
$adresseNo = $_POST['adresseNo'];
//$npa = $_POST['npa'];
//$localite = $_POST['localite'];
list($npa, $localite) = explode(' ', $_POST['npaLocalite'], 2);
$tel = $_POST['tel'];
//$tel2 = $_POST['tel2'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$ip = $_POST['ip'];

$db = library\database\MyPDO::getInstance('mysql:host=mysql.economies.ch;dbname=medt_WP14675', 'medt_ismael', 'IsmaeL_1983');
$comparateur = new \library\comparateur($_POST);
$user = get_current_user_id()!==null?get_current_user_id():null;
$sqlOffre = 'INSERT INTO offres(userId, assureurId, assureurOffreId, divisionId, suivisId, ip, primeActuelle, primeNouvelleOffre, tarif, tarifType, modelStandard, modelMf, modelHmo, modelTelmed, modelAutre, medecineDouce, prevoyanceSante, preventionSante, maternite, urgencesEtranger, correctionsVue, recherchesSauvetage, transport, orthodontie, status, dateCreation, dateModification) VALUES("' . $user . '", "' . $assureurId . '", "' . $assureurOffreId . '", "' . $division . '", "1", "' . $_SERVER['REMOTE_ADDR'] . '", "' .$primeActuelle . '", "' . $primeNouvelleOffre . '", "' . $tarif . '", "' . $tarifType . '",  "' . $modelStandard . '",  "' . $modelMf . '", "' . $modelHmo . '", "' . $modelTelmed . '", "' . $modelAutre . '", "' . $medecineDouce . '", "' . $prevoyanceSante . '", "' . $preventionSante . '", "' . $maternite . '", "' . $urgencesEtranger . '", "' . $correctionsVue . '", "' . $rechercheSauvetage . '", "' . $transport . '", "' . $orthodontie . '", "1", NOW(), NOW())';
$db->exec($sqlOffre);
$offreId = $db->lastInsertId();

for($i=1;$i<=$_POST['nbAssures'];$i++){
    $nationaliteId = $_POST['nationalite-' . $i];
    $nom = $_POST['nom-' . $i];
    $prenom = $_POST['prenom-' . $i];
    $sexe = $_POST['sexe-' . $i];
    $lamal = $_POST['lamal-' . $i];
    $lca = $_POST['lca-' . $i];
    $permisId = $_POST['permis-' . $i];
    $naissance = $_POST['naissance-' . $i];
    $accident = $_POST['accident-' . $i];
    $franchise = $_POST['franchise-' . $i];
    $sqlPersonne = 'INSERT INTO personnes (offreId, nationaliteId, permisId, nom, prenom, adresse, adresseNo, npa, localite, tel, tel2, mobile, email, naissance, accident, franchise, dateCreation, dateModification) VALUES("' . $offreId . '", "' . $nationaliteId . '", "' . $permisId . '", "' . $nom  . '", "' . $prenom . '", "' . $adresse . '", "' . $adresseNo . '", "' . $npa . '", "' . $localite . '", "' . $tel . '", "' . $tel2 . '", "' . $mobile . '", "' . $email . '", "' . $naissance . '", "' . $accident . '", "' . $franchise . '", NOW(), NOW())';
    $db->exec($sqlPersonne);
}

// Envoi de l'email

// Recherche le nom de la langue
$sqlLangue = 'SELECT name_fr FROM langues WHERE id=' . $_POST['langue'];
$stmtLangue = $db->query($sqlLangue);
$langue = $stmtLangue->fetch(\PDO::FETCH_ASSOC); 
    
$message = "<html>\r\n";
$message .= "<head>\r\n";
$message .= "<meta charset='utf-8'>\r\n";
$message .= "<title>Comparateur d'assurance maladie</title>\r\n";
$message .= "</head>\r\n";
$message .= "<p>IP du demandeur : <strong>" . $ip . "</strong></p>\r\n";
$message .= "<h3>Assurance Actuelle</h3>\r\n";
$message .= "<p>Assureur de base actuel : <strong>" . $comparateur->getAssureur($_POST['assureur']) . "</strong></p>\r\n";
$message .= "<p>Prime actuelle : <strong>" . number_format(($_POST['assureurActuelTotal'] / 12), 2, "." , "'") . "</strong></p><br/>\r\n";
$message .= "<h3>Demande d'offre pour l'assurance</h3>\r\n";
$message .= "<p>Assurance : <strong>" . $comparateur->getAssureur($_POST['assureurSelectedId']) . "</strong></p>\r\n";
$message .= "<p>Prime nouvelle offre : <strong>" . number_format(($_POST['assureurSelectedTotal'] / 12), 2, "." , "'") . "</strong></p>\r\n";
$message .= "<p>Franchise souhaitée : <strong>" . $franchise . "</strong></p>\r\n";
$message .= "Tarif : <strong>" . $_POST['tarif'] . "</strong></p>\r\n";
$message .= "Modèle d'assurance : <strong>" . $comparateur->getTarifName($_POST['assureurSelectedId'], $_POST['tarif'], $_POST['tarifType']) . "</strong></p><br/>\r\n";
$message .= '<h3>Données personnelles</h3>' . "\r\n";
// Parcours toutes les personnes
for($i=1;$i<=$_POST['nbAssures'];$i++){
    // Recherche du nom de la nationalié
    //$sqlNationalite = 'SELECT name_fr FROM nationalites WHERE id=' . $_POST['nationalite-' . $i];
    //$stmtNationalite = $db->query($sqlNationalite);
    //$nationalite = $stmtNationalite->fetch(\PDO::FETCH_ASSOC);   
	$message .= "<h4><strong>Personne " . $i . "</strong></h4>\r\n";
    $message .= '<p>Nom : <strong>' . $_POST['nom-' . $i] . "</strong></p>\r\n";
    $message .= '<p>Prénom : <strong>' . $_POST['prenom-' . $i] . "</strong></p>\r\n";
    $message .= '<p>Date de naissance : <strong>' . $_POST['naissance-' . $i] . "</strong></p>\r\n";
    $message .= '<p>Sexe : <strong>' . $_POST['sexe-' . $i] . "</strong></p>\r\n";
    //$message .= "<p>Nationalité : <strong>" . $nationalite['name_fr'] . "</strong></p>\r\n";
    //$message .= "<p>Assurance LAMAL actuelle : <strong>" . $comparateur->getAssureur($_POST['lamal-' . $i]) . "</strong></p>\r\n";
    if(isset($_POST['permis-' . $i]) && $_POST['permis-' . $i] != '-1'){
        $message .= "<p>Permis d'établissement : <strong>" . $comparateur->getPermis($_POST['permis-' . $i]) . "</strong></p>\r\n";
    }
    
    //$message .= "<p>Assurance LCA actuelle : <strong>" . $comparateur->getAssureur($_POST['lca-' . $i]) . "</strong></p>\r\n";
}

$message .= '<br/><h3>Coordonées</h3>' . "\r\n";
$message .= "<p>Adresse : <strong>" . $_POST['adresse'] . ' ' . $_POST['adresseNo'] . "</strong></p>\r\n";
$message .= "<p>NPA / Localité : <strong>" . $_POST['npa'] . ' ' . $_POST['localite'] . "</strong></p>\r\n";
$message .= "<p>Téléphone : <strong>" . $_POST['tel'] . "</strong></p>\r\n";
$message .= "<p>Poratble : <strong>" . $_POST['mobile'] . "</strong></p>\r\n";
$message .= "<p>Email : <strong>" . $_POST['email'] . "</strong></p>\r\n";
$message .= "<p>Langue de correspondance : <strong>" . $langue['name_fr'] . "</strong></p><br/>\r\n";
$message .= '<h3>Division hospitalière</h3>' . "\r\n";
$message .= '<p>Division : <strong>' . (($_POST['division'] !== '-1')?$comparateur->getDivision($_POST['division']):'Aucune') . '</strong></p><br/>' . "\r\n";
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
$message .= '</body>' . "\r\n";
$message .= '</html>' . "\r\n";

// Entête de l'email
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type:text/html;charset=utf-8' . "\r\n";
$headers .= 'From:<noreply@infoprime.ch>' . "\r\n";
$headers .= 'Reply-to:<info@economies.ch>' . "\r\n";
// $headers .= 'Bcc:<i.gashi@economies.ch>';

// Envoie du mail
mail('i.gashi@economies.ch', 'Demande d\'offre assurance maladie', $message, $headers);
// mail('leads@partenaires-conseils.ch', 'Demande d\'offre assurance maladie', $message, $headers);

// Email de confirmation au client
$clientMessage = "<html>\r\n";
$clientMessage .= "<head>\r\n";
$clientMessage .= "<title>Infoprime.ch - Confirmation</title>\r\n";
$clientMessage .= "</head>\r\n";
$clientMessage .= "<body>\r\n";
$clientMessage .= "<img src='https://infoprime.ch/wp-content/uploads/2017/01/Logo-Infoprime-2017-2.png' alt='Infoprime.ch'>\r\n";
$clientMessage .= "<p>Votre demande d'offre pour <strong>" . $comparateur->getAssureur($_POST['assureurSelectedId']) . "</strong> nous est bien parvenue. Nous vous en remercions et vous revenons sous peu.<p>\r\n";
$clientMessage .= "<p>Infoprime.ch<br><br>+41 21 888 10 10<br><a href='mailto://info@infoprime.ch'>info@infoprime.ch</a><p>\r\n";
$clientMessage .= "</body>\r\n";
$clientMessage .= "</html>\r\n";

// Entête de l'email
$clientHeaders = 'MIME-Version: 1.0' . "\r\n";
$clientHeaders .= 'Content-Type:text/html;charset=utf-8' . "\r\n";
$clientHeaders .= 'From:<noreply@infoprime.ch>' . "\r\n";
$clientHeaders .= 'Reply-to:<info@economies.ch>';


// Envoie du mail
mail($_POST['email'], 'Demande d\'offre assurance maladie', $clientMessage, $clientHeaders);


header('Location: http://www.infoprime.ch/offre-maladie/confirmation/?assureur=' . $comparateur->getAssureur($assureurOffreId) . '&nom=' . ($_POST['sexe-1'] == 'masculin'?'Monsieur ':'Madame ') .  $_POST['nom-1'] . ' ' . $_POST['prenom-1']);
