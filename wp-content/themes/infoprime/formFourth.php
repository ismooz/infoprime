<?php
/* Template Name: formFourth */

if (!isset($_POST['assureurSelectedId'])) {
    header('location: https://infoprime.ch/offre-maladie/comparateur/');
}

get_header();

include ABSPATH . '/comparateur/library/comparateur.class.php';
include ABSPATH . '/comparateur/library/database/MyPDO.class.php';

$db = library\database\MyPDO::getInstance('mysql:host=mysql.economies.ch;dbname=medt_WP14675', 'medt_ismael', 'IsmaeL_1983');
$comparateur = new \library\comparateur($_POST);

$stmt = $db->query('SELECT id, name_fr FROM nationalites ORDER BY priorite, name_fr');
$nationalites = $stmt->fetchAll(\pdo::FETCH_ASSOC);

$stmtLangues = $db->query('SELECT id, name_fr FROM langues ORDER BY name_fr');
$langues = $stmtLangues->fetchAll(\pdo::FETCH_ASSOC);

$stmtAssureurs = $db->query('SELECT id, name FROM assureurs ORDER BY preffered, name');
$assureurs = $stmtAssureurs->fetchAll(\pdo::FETCH_ASSOC);

$stmtPermis = $db->query('SELECT id, name FROM permis ORDER BY id');
$permis = $stmtPermis->fetchAll(\pdo::FETCH_ASSOC);

$stmtDivisions = $db->query('SELECT id, nom FROM divisions WHERE status=1');
$divisions = $stmtDivisions->fetchAll(\pdo::FETCH_ASSOC);

$npaLocalite = $_POST["npaLocalite"];
$region = $_POST["idRegion"];

?>
<!doctype html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/jquery-ui.structure.min.css" />
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/styles.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
        function updateDestinataire() {
            var prenom = document.getElementById('prenom-1').value.substr(0, 1).toUpperCase() +
                document.getElementById('prenom-1').value.substr(1).toLowerCase();
            var nom = document.getElementById('nom-1').value.substr(0).toUpperCase();
            document.getElementById('prenom').value = prenom
            document.getElementById('nom').value = nom
        }
    </script>
</head>

<body>
    <!-- formFourth.php -->
    <form action="https://infoprime.ch/offre-maladie/process/" method="post" id="form-fourth" onsubmit="return checkFourthSubmission();">
        <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
        <div id="main-content-comparateur">
            <div class="container">
                <div class="txt-center">
                    <h1>Comparatif des primes d'assurance maladie</h1>
                </div>
                <div class="container" style="">
                    <br>
                    <h3 class="center"><strong>Votre Demande d'offre gratuite et sans engagement pour <span class="text-primary"><?php echo $comparateur->getAssureur($_POST['assureurSelectedId']); ?>.</strong></span></h3>
                    <br>
                    <div id="assurance-selection-cadre" class="form-maladie">
                        <div id="">
                            <div class="row">
                                <?php
                                for ($i = 1; $i <= $_POST['nbAssures']; $i++) :
                                ?>
                                    <div class="col-lg-12 col-md-12">
                                        <h3 class="blue" id="title-pers-<?php echo ($i); ?>"><strong>Personne <?php echo ($i); ?> </strong></h3>

                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-lg-3 col-md-3">
                                        <label class="bold" id="lblPrenom-<?php echo ($i); ?>">Prénom</label><br />
                                        <input type="text" name="prenom-<?php echo ($i); ?>" id="prenom-<?php echo ($i); ?>" class="client" onkeyup="javscript:changeName(<?php echo ($i); ?>);<?php if ($i == 1) {
                                                                                                                                                                                                    echo ("updateDestinataire()");
                                                                                                                                                                                                } ?>" required autofocus tabindex="<?php echo ($i); ?>1" />
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label class="bold" id="lblNom-<?php echo ($i); ?>">Nom </label> <?php echo (($i !== 1) ? '<button type="button" class="btn-link" style="margin-left:0px;margin-bottom:0px;" onclick="copieChamp(\'nom-1\', \'nom-' . $i . '\');" title="Copier le nom du parent"><span class="fa fa-copy"></span></button>' : ''); ?><br />
                                        <input type="text" name="nom-<?php echo ($i); ?>" id="nom-<?php echo ($i); ?>" onkeyup="javscript:changeName(<?php echo ($i); ?>);<?php if ($i == 1) {
                                                                                                                                                                                echo ("updateDestinataire()");
                                                                                                                                                                            } ?>" class="client" required tabindex="<?php echo ($i); ?>2" />

                                    </div>

                                    <div class="col-lg-3 col-md-3">
                                        <label class="bold" id="lblNaissance-<?php echo ($i); ?>">Date de naissance</label><br />
                                        <input type="text" name="naissance-<?php echo ($i); ?>" id="naissance-<?php echo ($i); ?>" class="datepicker" maxlength="10" tabindex="<?php echo ($i); ?>3" onkeyup="dateValidation(this,event)" value="01/01/<?php echo $_POST['naissance-' . $i]; ?>" required />
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label id="lblSexe-<?php echo ($i); ?>">Sexe</label><br />
                                        <div class="radio">
                                            <input type="radio" id="sexeMasculin-<?php echo ($i); ?>" name="sexe-<?php echo ($i); ?>" value="masculin" tabindex="<?php echo ($i); ?>4" /><label for="sexeMasculin-<?php echo ($i); ?>">H</label>

                                            <input type="radio" id="sexeFeminin-<?php echo ($i); ?>" name="sexe-<?php echo ($i); ?>" value="feminin" tabindex="<?php echo ($i); ?>5" /><label for="sexeFeminin-<?php echo ($i); ?>">F</label>

                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <br>
                                    <!-- <div class="col-lg-3 col-md-3">
                                <b>Année de naissance</b>
                                <br/>
                                <p><strong><?php echo $_POST['naissance-' . $i]; ?></strong></p>
                            </div> -->
                                    <div class="col-lg-3 col-md-3 mt-3">
                                        Modèle choisi<br />
                                        <p><strong><?php echo ($comparateur->getTarifName($_POST['assureurSelectedId'], $_POST['tarif'], $_POST['tarifType'])); ?></strong></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 mt-3">
                                        Franchise choisie<br />
                                        <p><strong>CHF <?php echo $_POST['franchise-' . $i]; ?></strong></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 mt-3">
                                        Accidents<br />
                                        <p><strong><?php echo $_POST['accident-' . $i]; ?></strong></p>
                                    </div>

                                    <div class="col-lg-3 col-md-3 mt-3">
                                        Localité<br />
                                        <p><strong><?php echo $npaLocalite; ?></strong></p>
                                    </div>

                                    <div class="clear"></div>
                                    <div class="col-lg-12 col-md-12">
                                        <hr class="eco-ligne" />
                                    </div>
                                <?php
                                endfor;
                                ?>
                                <div class="clear"></div>
                                <div class="row p-5" style="background-color:rgba(0, 0, 0, 0.05);">
                                    <br>
                                    <div class="col-lg-12 col-md-12">
                                        <h3 class="blue txt-center mb-4"><strong>Votre sélection</strong></h3>
                                    </div>
                                    <div class="clear"></div>
                                    <br>
                                    <div class="col-lg-6 col-md-6 txt-center">
                                        <h4><strong>✅ Nouvelle prime annuelle 2024</strong></h4>
                                        <p>
                                            <span class="montants"><strong><?php echo $comparateur->getAssureur($_POST['assureurSelectedId']); ?></strong></span> -
                                            <span class="montants txt-green"><strong>CHF <?php echo number_format($_POST['assureurSelectedTotal'], 2, ".", "'"); ?></strong></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 txt-center">
                                        <h4><strong>Prime annuelle 2024 sans changer</strong></h4>
                                        <p>
                                            <span class="montants"><strong><?php echo $comparateur->getAssureur($_POST['assureur']); ?></strong></span> -
                                            <span class="montants txt-red"><strong>CHF <?php echo number_format($_POST['assureurActuelTotal'], 2, ".", "'"); ?></strong></span>
                                        </p>
                                    </div>
                                    <div class="clear"></div><br><br>
                                    <div class="col-lg-12 col-md-12 txt-center mt-4">
                                        <h2>
                                            <?php
                                            $difference = $_POST['assureurSelectedTotal'] - $_POST['assureurActuelTotal'];
                                            echo (($difference > 0) ? 'Surprime de <span class="montants differenceSuperieur">CHF ' . number_format($difference, 2, ".", "'") . '</span>' : '<span class="montants">Vous faites une economie de <span class="differenceInferieur">CHF ' . number_format(abs($difference), 2, ".", "'") . '</span>');
                                            ?>
                                        </h2>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <hr class="eco-ligne" />
                        <div class="row">
                            <div class="col-lg-12 col-md-12 txt-center">
                                <h3 class="blue"><strong>Informations complémentaires relatives à votre demande d'offre</strong></h3>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <h3 class="blue"><strong>Hospitalisation 🏥</strong></h3>
                                <br>
                                <label class="bold" id="lblDivision">Choix de la division hospitalière</label> <i class="fa fa-info masterTooltip" title="Texte division" data-type="html" data-content="data-division"></i><br />
                                <select name="division" id="division" required>
                                    <option value="">- Veuillez sélectionner -</option>
                                    <?php
                                    for ($i = 0; $i < count($divisions); $i++) :
                                    ?>
                                        <option value="<?php echo ($divisions[$i]['id']); ?>"><?php echo ($divisions[$i]['nom']); ?></option>
                                    <?php
                                    endfor;
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 required">
                                <h3 class="blue"><strong>Assurances complémentaires 🌱</strong></h3>
                                <h5>Quelles prestations sont importantes pour vous ?</h5>
                                <br>
                                <div class="check">
                                    <input type="checkbox" name="medecineDouce" id="medecineDouce">
                                    <label for="medecineDouce" class="cadre"></label>
                                    <label for="medecineDouce"><strong>🌱 - Médecine douce</strong><i class="fa fa-info masterTooltip" title="Texte médecine douce" data-type="html" data-content="data-medecineDouce"></i></label>
                                </div>
                                <br />
                                <div class="check">
                                    <input type="checkbox" name="prevoyanceSante" id="prevoyanceSante">
                                    <label for="prevoyanceSante" class="cadre"></label>
                                    <label for="prevoyanceSante"><strong>⚽️ - Fitness et sports</strong><i class="fa fa-info masterTooltip" title="Prévoyance santé" data-type="html" data-content="data-prevoyanceSante"></i></label>
                                </div>
                                <br />
                                <div class="check">
                                    <input type="checkbox" name="preventionSante" id="preventionSante">
                                    <label for="preventionSante" class="cadre"></label>
                                    <label for="preventionSante"><strong>🩺 - Prévention santé</strong><i class="fa fa-info masterTooltip" title="Prévention santé" data-type="html" data-content="data-preventionSante"></i></label>
                                </div>
                                <br />
                                <div class="check">
                                    <input type="checkbox" name="maternite" id="maternite">
                                    <label for="maternite" class="cadre"></label>
                                    <label for="maternite"><strong>🤰 - Maternité</strong> <i class="fa fa-info masterTooltip" title="Maternité" data-type="html" data-content="data-maternite"></i></label>
                                </div>
                                <br />
                                <div class="check">
                                    <input type="checkbox" name="urgencesEtranger" id="urgencesEtranger">
                                    <label for="urgencesEtranger" class="cadre"></label>
                                    <label for="urgencesEtranger"><strong>🚁 - Urgences à l'étranger</strong><i class="fa fa-info masterTooltip" title="Urgences à l'étranger" data-type="html" data-content="data-urgencesEtranger"></i></label>
                                </div>
                                <br />
                                <div class="check">
                                    <input type="checkbox" name="correctionsVue" id="correctionsVue">
                                    <label for="correctionsVue" class="cadre"></label>
                                    <label for="correctionsVue"><strong>👓 - Corrections de la vue</strong><i class="fa fa-info masterTooltip" title="Corrections de la vue" data-type="html" data-content="data-correctionsVue"></i></label>
                                </div>
                                <br />
                                <div class="check">
                                    <input type="checkbox" name="rechercheSauvetage" id="rechercheSauvetage">
                                    <label for="rechercheSauvetage" class="cadre"></label>
                                    <label for="rechercheSauvetage"><strong>🚑 - Recherches et sauvetage</strong><i class="fa fa-info masterTooltip" title="Recherches et sauvetage" data-type="html" data-content="data-recherchesSauvegarde"></i></label>
                                </div>
                                <br />
                                <div class="check">
                                    <input type="checkbox" name="orthodontie" id="orthodontie">
                                    <label for="orthodontie" class="cadre"></label>
                                    <label for="orthodontie"><strong>🦷 - Orthodontie</strong><i class="fa fa-info masterTooltip" title="Orthodontie" data-type="html" data-content="data-orthodontie"></i></label>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-12 col-md-12">
                            <hr class="eco-ligne" />
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <h3 class="blue"><strong>Vos coordonnées</strong></h3>
                            </div>
                            <div class="clear"></div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6">
                                    <label class="bold" id="lblPrenom" for="prenom">Prénom *</label><br />
                                    <input type="text" name="prenom" id="prenom" value="<?php echo $post_prenom; ?>" tabindex="201" class="client" <?php if ($i == 1) {
                                                                                                                                                        echo ("updateDestinataire()");
                                                                                                                                                    } ?>" />
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label class="bold" id="lblNom" for="nom">Nom *</label><br />
                                    <input type="text" name="nom" id="nom" value="<?php echo $post_nom; ?>" tabindex="202" class="client" <?php if ($i == 1) {
                                                                                                                                                echo ("updateDestinataire()");
                                                                                                                                            } ?>" /><br /><br />
                                </div>
                            </div>
                            <div class="clear"><br></div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6">
                                    <label class="bold" id="lblAdresse" for="adresse">Rue *</label><br />
                                    <input type="text" name="adresse" id="adresse" tabindex="203" class="client" required /><br /><br />
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <label class="bold" id="lblAdresseNo" for="adresseNo">N° *</label><br />
                                    <input type="text" name="adresseNo" maxlength="4" id="adresseNo" tabindex="204" class="client" style="width: 4rem;" required /><br /><br />
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6">
                                    <label class="bold" id="lblNpa" for="npa">NPA / Localité *</label><br />
                                    <input type="text" name="npa" id="adresseFirst" value="<?php echo $npaLocalite; ?>" tabindex="205" class="client" autocomplete="off" /><br /><br />

                                </div>
                            </div>

                            <div class="clear"></div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6">
                                    <label class="bold" id="lblTel" for="tel">Téléphone *</label><br />
                                    <input type="text" name="tel" id="tel" tabindex="206" class="client" /><br /><br />

                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <label class="bold" id="lblMobile" for="mobile">Mobile</label><br />
                                    <input type="text" name="mobile" id="mobile" tabindex="207" class="client" /><br /><br />
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="col-lg-6 col-md-6">
                                <label class="bold" id="lblEmail" for="email">E-mail</label><br />
                                <input type="text" name="email" id="email" tabindex="208" class="client" onblur="return checkEmail(this.id, this.value);" required /><br /><br />
                            </div>
                            <div class="col-lg-4 col-md-4"></div>
                            <div class="clear"></div>
                            <div class="row col-12">
                                <div class="col-lg-6 col-md-6">
                                    <label class="bold" id="lblLangue" for="langue">Langue de correspondance *</label> <i class="fa fa-info masterTooltip" title="Langue de correspondance" data-type="html" data-content="data-langueCorrespondance"></i><br />
                                    <select name="langue" id="langue" tabindex="209" required>
                                        <option value="">- Veuillez sélectionner -</option>
                                        <?php
                                        // Parcours les langues
                                        for ($j = 0; $j < count($langues); $j++) :
                                        ?>
                                            <option value="<?php echo ($langues[$j]['id']); ?>"><?php echo ($langues[$j]['name_fr']); ?></option>;
                                        <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <br />
                            <span id="error" class="error"></span> <br>
                            <div class="col-lg-12">
                                <p>* Champs obligatoires</p>
                            </div>
                            <div class="clear"></div>
                            <div class="col-lg-12 col-md-12">
                                <hr class="eco-ligne" />
                                <h3 class="blue"><strong>Processus de demande</strong></h3>
                                <p>Votre demande sera enregistrée sur les serveurs de données d'<strong>Economies.ch Sàrl</strong>, avec toute la confidentialité demandée par la LPD (Loi sur la protection des données). Ces données seront traitées en interne et votre offre sera directement établie par <strong>Economies.ch Sàrl</strong> à l’aide des données fournies par les assureurs maladie. Une fois terminée, votre demande pourra vous être transmise soit par mail ou alors directement par l’un de nos agents.</p>
                                <br>
                                <div class="check">
                                    <input type="checkbox" name="cg" id="cg" required>
                                    <label for="cg" class="cadre"></label>
                                    <label for="cg">Je valide les <a href="https://infoprime.ch/infos-utiles/" target="_blank"><b>conditions générales</b></a><i class="fa fa-info masterTooltip" title="Texte division" data-type="html" data-content="data-conditions"></i></label>
                                </div>
                                <div>
                                    <hr class="eco-ligne" />
                                    <?php foreach ($_POST as $key => $value) : ?>
                                        <input type="hidden" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
                                    <?php endforeach; ?>
                                    <input type="submit" value="Envoyer la demande" class="button-87" style="float:right;" />
                                    <div class="clear"></div>
                                    <div id="suggestions-container" class="autocomplete-suggestions-container"></div>
                                </div>
                            </div>


                            <div id="data-conditions" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Conditions générales</strong></h4>
                                <br>
                                <p>InfoPrime.ch veille au respect de vos données ainsi qu’à votre vie privée. C’est pour cela que nous mettons tout en œuvre pour protéger au mieux vos données.</p>
                                <h5><strong>Traitement des demandes</strong></h5>
                                <p>En tant que comparateur, nous collectons toutes les données qui sont nécessaires pour établir, dans le meilleur du possible, un comparatif d’assurance maladie de base. Vos données ne sont pas transmise aux compagnies d’assurance mais directement traitées par InfoPrime.ch. En acceptant nos conditions, vous autorisé InfoPrime.ch à transmettre vos données à ses partenaires à des fins de marketing.
                                    Toutes les informations collectées sont enregistrées dans nos bases de données afin d’être utilisées pour nos statistiques internes et peuvent être communiquées à des tiers partenaires de façon anonyme.
                                </p>
                                <h5><strong>Utilisation du comparateur</strong></h5>
                                <p>L’utilisation du comparateur a pour but une utilisation privée. Nous ne pouvons garantir l’exactitude des données affichées dans la mesure où elles pourraient être incorrectement transmise à InfoPrime.ch. Toute utilisation frauduleuse pourra être poursuivie pénalement.</p>
                                <h5><strong>Informations et contact</strong></h5>
                                <p>Pour toute information complémentaires, vous pouvez prendre contact avec nous par <a href="mailto:info@infoprime.ch">email.</a></p>
                            </div>

                            <div id="data-division" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Division hositalière</strong></h4>
                                <br>
                                <h5><strong>Division commune</strong></h5>
                                <p>Afin de couvrir d’éventuels frais supplémentaires en cas de soins dans un hôpital hors de son canton de résidence.</p>
                                <h5><strong>Division mi-privée</strong></h5>
                                <p>Donne le libre choix du médecin (chef de clinique par exemple), libre choix de l’hôpital ou clinique (attention aux listes restreintes d’hôpitaux dans certaines compagnies) et chambre à deux lits.</p>
                                <h5><strong>Division privée</strong></h5>
                                <p>Vous donne droit à une chambre individuelle en clinique ainsi que le libre choix du médecin. Certaines compagnies vous permettent d’aller dans n’importe qu’elle hôpital du monde entier.</p>
                            </div>
                            <div id="data-medecineDouce" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Médecine douce</strong></h4>
                                <p>Pour couvrir les coûts qui ne sont pas pris en charge par l’assurance de base comme par exemple l’ostéopathe.</p>
                            </div>
                            <div id="data-prevoyanceSante" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Promotion de la santé</strong></h4>
                                <p>Afin d’obtenir une contribution pour le sport (ex. fitness) ainsi que certaines autres activités vous maintenant en forme.</p>
                            </div>
                            <div id="data-preventionSante" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Prévention santé</strong></h4>
                                <p>Contributions pour différents types de prestations préventives telles que bilan de santé, examen gynécologique préventif, vaccins et autres.</p>
                            </div>
                            <div id="data-medicaments" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Médicaments</strong></h4>
                                <p>
                                    Couvre les coûts des médicaments non remboursés par l'assurance de base. Important : l'assurance complémentaire ne rembourse pas tous les médicaments non plus.
                                </p>
                            </div>
                            <div id="data-vacinations" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Vacinationss</strong></h4>
                                <p>
                                    Couvre le coût des vaccinations qui ne sont pas prises en charges par l'assurance de base.
                                </p>
                            </div>
                            <div id="data-maternite" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Matérnité</strong></h4>
                                <p>Afin de couvrir les coûts non pris en charge par la LAMal tels que les échographies supplémentaires, les accouchements en maison de naissance, la chambre individuelle, etc. en cas de grosse.</p>
                            </div>
                            <div id="data-urgencesEtranger" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Urgences à l'étranger</strong></h4>
                                <p>Afin de couvrir les suppléments pour soins à l’étranger, notamment pour les rapatriements, les frais de clinique ainsi que les coûts particuliers dans les pays hors de l’Union Européenne.</p>
                            </div>
                            <div id="data-correctionsVue" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Lunettes et lentilles</strong></h4>
                                <p>La LAMal ne donne plus de contribution pour les lunettes ou lentilles de contact dès la 19ème année. La prise en charge des verres peut se faire par un complément à l’assurance de base.</p>
                            </div>
                            <div id="data-recherchesSauvegarde" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Ambulance et sauvetage</strong></h4>
                                <p>La LAMal ne couvre que 50% des frais d’ambulance pour un maximum de CHF 500.- par année civile et 50% jusqu’à CHF 5000.- pour le sauvetage. Sachant qu’une intervention en hélicoptère coûte près de CHF 250.- par minutes, il est nécessaire de couvrir ce risque par une complément à votre assurance de base.</p>
                            </div>
                            <div id="data-orthodontie" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Orthodontie et soins dentaires</strong></h4>
                                <p>Il n’y a aucune contribution aux frais d’orthodontie ni pour les soins dentaires dans l’assurance de base. Il peut y avoir une contribution pour l’orthodontie en cas d’accident.</p>
                            </div>
                            <div id="data-langueCorrespondance" class="tooltip-content">
                                <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Langue de correspondance</strong></h4>
                                <p>Les assurances maladie peuvent vous transmettre des offres dans les langues proposées dans la liste.</p>
                            </div>

                        </div>
                        <br>
                    </div>
                    <br>
                    <?php get_footer(); ?>
                    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery-2.1.1.js"></script>
                    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery-ui.min.js"></script>
                    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery.autocomplete.min.js"></script>
                    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/fonctions.js"></script>
                    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/app.js"></script>
    </form>
</body>

</html>