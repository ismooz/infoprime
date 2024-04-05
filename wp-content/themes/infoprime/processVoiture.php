<?php
/* Template Name: processVoiture */

    // Fixe le niveau de rapport d'erreurs PHP
    error_reporting(E_ALL);
    // Modifie la valeur d'une option de configuration
    ini_set("display_errors", 'on');

if(!isset($_POST['type'])){
    header('location: http://www.syntesis.ch');
}

// Inclus la class PDF
include_once ABSPATH . '/voitures/library/tcpdf/tcpdf.php';
//include_once '/library/tcpdf/tcpdf.php';

$pdf = new tcpdf('P', 'mm', 'A4', true, 'utf-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Vazquez Luis');
$pdf->SetTitle('Demande d\'offre véhicule à moteur');
$pdf->SetSubject('Assurance véhicule à moteur');
$pdf->SetKeywords('Assurance, Voiture de tourisme, Camion, Moto, Scooter, Remorque, Utilitaire');
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10, true);
// Image with resizing
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->Image(ABSPATH . '/voitures/web/images/Logo-Syntesis-2015-300x82.png', 10, 10, 50, 14);
//$pdf->Image('web/images/Logo-Syntesis-2015-300x82.png', 10, 10, 50, 14);
$pdf->SetXY(95, 15);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->Cell(0, 0, 'Demande d\'offre véhicule à moteur', 0, 1);
$pdf->SetXY(10, 30);
$pdf->SetFont('dejavusans', 'B', 10);
if($_POST['type'] === 'Entreprise'){
    $pdf->Cell(45, 0, 'Preneur d\'assurance : ', 0, 0);
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->Cell(55, 0, 'Entreprise', 0, 0);
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Cell(50, 0, 'Demande faite par un : ', 0, 0);
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->Cell(50, 0, ($_POST['contact'] === 'Agent'?$_POST['nomAgent']:'Client'), 0, 1);
    $pdf->line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln();    
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Nom de l\'entreprise', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['nomEntreprise'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Date de création', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['dateCreationEntreprise'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Adresse', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['adresseEntreprise'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Npa/Localité', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['npaLocaliteEntreprise'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Télépone', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['telephoneEntreprise'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Email', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['emailEntreprise'], 0, 1);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Cell(45, 0, 'Conducteur habituel', 0, 1);
    $pdf->line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln();
}else{
    $pdf->Cell(45, 0, 'Preneur d\'assurance : ', 0, 0);
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->Cell(55, 0, 'Particulier', 0, 0);
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Cell(50, 0, 'Demande faite par un : ', 0, 0);
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->Cell(50, 0, ($_POST['contact'] === 'Agent'?$_POST['nomAgent']:'Client'), 0, 1);
    $pdf->line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln();       
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Nom', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['nom'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Prénom', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['prenom'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Adresse', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['adresse'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Npa/Localité', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['npaLocalite'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Télépone', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['telephone'], 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Date de naissance', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['dateNaissance'], 0, 1); 
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Nationalité', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['nationalite'], 0, 1);
    if(isset($_POST['permis'])){
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->Cell(100, 0, 'Permis d\'établissement', 0, 0);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->Cell(0, 0, $_POST['permis'], 0, 1); 
    }
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Date du permis de conduire', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, $_POST['datePermis'], 0, 1);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->Cell(45, 0, 'Conducteur habituel', 0, 1);
    $pdf->line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln();
}

$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Prenueur d\'assurance', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['preneur'], 0, 1);

if($_POST['preneur'] === 'non'){
    $pdf->Ln();
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Nom', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Vazquez', 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Prénom', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Luis', 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Adresse', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Chemin de Renens 24', 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Npa/Localité', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, '1004 Lausanne', 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Télépone', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, '021 624 10 07', 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Date de naissance', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, '20/08/1969', 0, 1); 
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Nationalité', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Espagnol', 0, 1); 
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Permis d\'établissement', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Permis C', 0, 1); 
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 0, 'Date du permis de conduire', 0, 0);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, '10/10/2000', 0, 1);     
}
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->Cell(45, 0, 'Véhicule', 0, 1);
$pdf->line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln();
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Type de véhicule', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['typeVehicule'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Marque', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['marque'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Model', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['model'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Cylindrée', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['cylindree'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Kilométres annuel', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['kmAnnuel'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Kilométres au compteur', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['kmCompteur'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Nombres de portes', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['nbPortes'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'N° de matricule', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['matricule'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Première mise en circulation', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['miseCirculation'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Prix catalogue', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['prixCatalogue'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Récéption par type', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['receptionType'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Boîte à vitesses', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['boiteVitesse'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Carburant', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['carburant'], 0, 1);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Parking', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['parking'], 0, 1);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->Cell(45, 0, 'Couvertures souhaitées', 0, 1);
$pdf->line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln();
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Responsabilité Civile', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, isset($_POST['responsabiliteCivile'])?'Oui':'Non', 0, 1);
if(isset($_POST['franchiseResponsabiliteCivile'])){
    $pdf->Cell(100, 0, '- Franchise', 0, 0);
    $pdf->Cell(0, 0, $_POST['franchiseResponsabiliteCivile'], 0, 1);
    $pdf->Ln();
}
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Casco Partielle', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, isset($_POST['cascoPartielle'])?'Oui':'Non', 0, 1);
if(isset($_POST['franchiseCascoPartielle'])){
    $pdf->Cell(100, 0, '- Franchise', 0, 0);
    $pdf->Cell(0, 0, $_POST['franchiseCascoPartielle'], 0, 1);
    $pdf->Ln();
}
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Casco Complète', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, isset($_POST['cascoComplete'])?'Oui':'Non', 0, 1);
if(isset($_POST['franchiseCascoComplete'])){
    $pdf->Cell(100, 0, '- Franchise', 0, 0);
    $pdf->Cell(0, 0, $_POST['franchiseCascoComplete'], 0, 1);
    $pdf->Ln();
}
$pdf->Ln();
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->Cell(45, 0, 'Couvertures complémentaires', 0, 1);
$pdf->line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln();
// ----------------
// Protection bonus
// ----------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Protection Bonnus', 0, 0);
if(isset($_POST['protectionBonus'])){
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Oui', 0, 1);
}else{
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Non', 0, 1);    
}
// -----------
// Faute grave
// -----------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Protection faute grave', 0, 0);
if(isset($_POST['fauteGrave'])){
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Oui', 0, 1);
}else{
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Non', 0, 1);    
}
// -------------
// Casco parking
// -------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Parking', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
if(isset($_POST['cascoParking'])){
    $pdf->Cell(10, 0, 'Oui', 0, 0);
    $pdf->Cell(0, 0, $_POST['franchiseCascoParking'], 0, 1);
}else{
    $pdf->Cell(10, 0, 'Non', 0, 1);
}
// ---
// Vol
// ---
$pdf->SetFont('dejavusans', 'B', 8);    
$pdf->Cell(100, 0, 'Vol', 0, 0);
if(isset($_POST['vol'])){
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(10, 0, 'Oui', 0, 0);
    $pdf->Cell(0, 0, $_POST['volMontant'], 0, 1);
}else{
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Non', 0, 1);
}
// -------------
// Bris de Glace
// -------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Bris de glace', 0, 0);
if(isset($_POST['brisGlace'])){
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Oui', 0, 1);
}else{
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Non', 0, 1);
}
// -------------------
// Protection occupant
// -------------------
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Protection occupants', 0, 0);
if(isset($_POST['protectionOccupants'])){
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Oui', 0, 1);
}else{
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(0, 0, 'Non', 0, 1);   
}
$pdf->Ln();
$pdf->Ln();
$pdf->AddPage();
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->Cell(45, 0, 'Informations complémentaires obligatoires', 0, 1);
$pdf->line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln();
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Sinistre au cours des 3 dernières années', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(0, 0, $_POST['sinistre'] === 'oui'?'Oui':'Non', 0, 1);
if($_POST['sinistre'] === 'oui'){
    $pdf->Ln();
    $pdf->MultiCell(0, 0, 'J\'ai emboutis un véhicule le 22.12.2012, J\'ai emboutis un véhicule le 22.12.2012, J\'ai emboutis un véhicule le 22.12.2012, J\'ai emboutis un véhicule le 22.12.2012', 0, 1);
    $pdf->Ln();
}
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell(100, 0, 'Retrait de permis au cours des 5 dernières années', 0, 0);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(10, 0, $_POST['retrait'] === 'oui'?'Oui':'Non', 0, 1);
if($_POST['retrait'] === 'oui'){
    $pdf->Ln();
    $pdf->MultiCell(0, 0, 'J\'ai eu un retrait de 2 mois à cause de J\'ai eu un retrait de 2 mois à cause de J\'ai eu un retrait de 2 mois à cause de', 0, 1);
    $pdf->Ln();
}

// Nom du fichier à enregistrer
$data = $pdf->Output('demande_offre_vehicule_moteur.pdf', 'E'); // I

//================================
// Envoi du mail avec pièce jointe
// ===============================

// Expéditeur
$from = "webmaster@syntesis.ch";
// Réponse à
$replyTo = "info@syntesis.ch";
// Destinataire
$to = "offre@syntesis.ch";
// Copie carbone invisible
$bcc = "info@syntesis.ch";
// Sujet
$subject = utf8_decode("Demande d'offre pour véhicule à moteur");
// Corps du message
$body = "Mesdames, Messieurs\n\nVeuillez trouver ci-joint la demande d'offre.";
// ----------
// Séparateur
// ----------
$boundary = md5(uniqid(rand()));
// --------------
// Entête de mail
// --------------
$header = "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
$header .= "From:\"Syntesis\"<$from>\r\n";
$header .= "To:\"offre\" <$to>\r\n";
$header .= "Bcc:\"info\" <$bcc>\r\n";
$header .= "Reply-to:\"info@syntesis.ch <$replyTo>\r\n";
$header .= "X-Mailer: Webmaster <$from>\r\n";
$header .= "X-Priority: 3\r\n";
// -------------
// Message Texte
// -------------
$message = "This is a multi-part message in MIME format\r\n";
$message .= "--$boundary\r\n";
$message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
$message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$message .= $body . "\r\n\r\n";
// ------------
// Pièce jointe
// ------------
$message .= "--$boundary\r\n";        
$message .= "Content-Type: application/pdf;name='demande_offre_vehicule_moteur(" . ($_POST['type'] === 'Particulier'?$_POST['nom'] . ' ' . $_POST['prenom']:$_POST['nomEntreprise']) . ").pdf'\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n";
$message .= "Content-Disposition: attachment; filename='demande_offre_vehicule_moteur.pdf'\r\n";
$message .= $data . "\r\n\r\n";
$message .= "--$boundary--";  
// -------------
// Envoi du mail
// -------------
mail($to, $subject, $message, $header);

get_header();

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="http://www.syntesis.ch/voitures/web/library/bootstrap-3.3.5/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="http://www.syntesis.ch/voitures/web/library/font-awesome-4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="http://www.syntesis.ch/voitures/web/library/jquery-ui-1.11.4/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="http://www.syntesis.ch/voitures/web/library/jquery-ui-1.11.4/jquery-ui.theme.min.css" />
        <link rel="stylesheet" type="text/css" href="http://www.syntesis.ch/voitures/web/css/styles.css" />
        <meta charset="UTF-8">
        <title>Confirmation d'envoi de mail</title>
    </head>
    <body>
        <div class="container" style="padding:30px 0 30px 0;">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" style="height:800px;text-align:center">
                    <br/>
                    <br/>
                    <img src="/voitures/web/images/remerciements.jpg" alt="Remerciements" />
                    <h3><strong>Merci pour votre demande d'offre, Votre demande à bien été envoyée.</strong></h3>
                    Vous allez être redirigé dans <span id="time">10</span> secondes.
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <script type="text/javascript" src="http://www.syntesis.ch/voitures/web/library/jquery-2.1.4/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="http://www.syntesis.ch/voitures/web/library/jquery-ui-1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://www.syntesis.ch/voitures/web/js/fonction.js"></script>
        <script type="text/javascript" src="http://www.syntesis.ch/voitures/web/js/app.js"></script>
        <script>
            function countdown() {
                // your code goes here
                var count = 10;
                var timerId = setInterval(function() {
                    count--;
                    document.getElementById('time').innerHTML = count;
                    if(count === 0) {
                        clearTimeout(timerId);
                        document.location.href = 'http://www.syntesis.ch/';
                    }
                }, 1000);
            }
            countdown();
        </script>
    </body>
</html>
<?php
get_footer();
?>