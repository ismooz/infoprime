<?php
/* Template Name: formSecond */

include ABSPATH . '/comparateur/library/database/MyPDO.class.php';
$db = library\database\MyPDO::getInstance('mysql:host=h2mysql1;dbname=lbnf_WP14675', 'lbnf_luis', 'Syntesis_1004');
$stmt = $db->query('SELECT id, name FROM assureurs ORDER BY name');
$assureurs = $stmt->fetchAll(\pdo::FETCH_ASSOC);

get_header();


?>
<!doctype html>

<?php unset($_POST); ?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="http://www.syntesis.ch/comparateur/web/css/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="http://www.syntesis.ch/comparateur/web/css/jquery-ui.structure.min.css" />
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="http://www.syntesis.ch/comparateur/web/css/styles.css" /> 
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
	
        <div id="main-content-comparateur">
            <div class="container"><div><h1>Comparatif des primes d'assurance maladie</h1></div>
				<div><h3>L'assurance maladie de base couvre les mêmes prestations dans toutes les caisses maladie. Alors pourquoi payer plus cher pour la même chose ?</h3></div>
				<br>
                <div class="col-lg-12 col-md-12 row" style="background-color:#f6f6f6;border:1px solid #999">
                    <br>
					<h2 class="txt-center">Comparez, économisez !</h2>
                    <br>
                    <form action="http://www.syntesis.ch/offre-maladie/comparateur/" method="post" id="form-second" class="form-maladie" onsubmit="return checkSecondSubmission();">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="blue"><strong>1. Données concernant votre région et l'assurance maladie de base</h3></strong>
                            </div>
							<br>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label id="lblAdresseFirst">Votre code postal</label><br/>
                                <input type="text" name="npaLocalite" id="adresseFirst">
                                <div id="suggestions-container" class="autocomplete-suggestions-container"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label id="labelAssureur" for="assureur">Caisse maladie actuelle</label><br/>
                                <select name="assureur" id="assureur">
                                    <option value="-1">- Veuillez sélectionner -</option>
                                    <option value="0">Autre-6</option>
                                    <option value="1">Nouveau en suisse</option>
<?php
// Parcours la liste des assureurs
for($i=0;$i<count($assureurs);$i++):
?>
                                    <option value="<?php echo $assureurs[$i]['id']; ?>"><?php echo ucfirst(strtolower($assureurs[$i]['name'])); ?></option>
<?php
endfor;
?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <!--
                                <label>Type</label><br/>
                                <select name="type">
                                    <option>- Veuillez sélectionner -</option>
                                </select>
                                -->
                            </div>
                            <div class="clear"></div>
                        </div>
                        <hr class="eco-ligne" />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="blue"><strong>2. Vos données personnelles</h3></strong>
										<br>
                                    </div>
                                    <div id="form-group">
                                        <div id="form-group-1">
                                            <div class="col-lg-12">
                                                <h4 id="form-group-title-1" class="blue">Personne n° 1</h4>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label id="form-group-label-1" for="form-group-input-1">Né(e) en</label><i class="fa fa-info masterTooltip" title="Texte année de naissance" data-type="html" data-content="data-naissance"></i><br/>
                                                <input type="text" name="naissance-1" id="form-group-input-1"  maxlength="4" class="petit txt-center" onkeyup="checkNaissance(this);" autocomplete="off"><br/>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label id="form-group-label2-1" for="form-group-select-1">Franchise</label><i class="fa fa-info masterTooltip" title="Text franchise" data-type="html" data-content="data-franchise"></i><br/>
                                                <select name="franchise-1" id="form-group-select-1" disabled="disabled">
                                                    <option value="">- Veuillez sélectionner -</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label id="form-group-legend-1">Accidents <i class="fa fa-info masterTooltip" title="text couverture accident" data-type="html" data-content="data-accident"></i></label><br/>
                                                <div class="radio">
                                                    <input type="radio" id="form-group-radio-avec-1" name="accident-1" value="avec" />
                                                    <label id="form-group-label4-1" for="form-group-radio-avec-1">Avec</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" id="form-group-radio-sans-1" name="accident-1" value="sans" />
                                                    <label id="form-group-label5-1" for="form-group-radio-sans-1">Sans</label>                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span id="form-group-error-1" class="error-input"></span>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Ajouter / Supprimer une personne</h5>
                                <button type="button" id="button-add" class="btn btn-primary">+</button> <button type="button" id="button-remove" class="btn btn-primary">-</button>                      
                                <br/>
                                <hr class="eco-ligne" />
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <h3 class="blue"><strong>3. Choix du modèle d'assurance à afficher</h3></strong>
                                        <br/>
                                        <h4 id="modelesCompares">Modèles d'assurance à comparer<i class="fa fa-info masterTooltip" title="Text modèles comparés" data-type="html" data-content="data-models"></i></h4>
                                        <div class="check">
                                            <input type="checkbox" name="standard" id="standard" checked="checked">
                                            <label for="standard" class="cadre"></label>
                                            <label><strong>Standard</strong></label>
                                        </div>
                                        <br/>
                                        <div class="check">
                                            <input type="checkbox" name="medecinFamille" id="medecinFamille" checked="checked">
                                            <label for="medecinFamille" class="cadre"></label>
                                            <label><strong>Médecin de famille</strong></label>
                                        </div>
                                        <br/>
                                        <div class="check">
                                            <input type="checkbox" name="hmo" id="hmo" checked="checked">
                                            <label for="hmo" class="cadre"></label>
                                            <label><strong>HMO</strong></label>
                                        </div>
                                        <br/>
                                        <div class="check">
                                            <input type="checkbox" name="telmed" id="telmed" checked="checked">
                                            <label for="telmed" class="cadre"></label>
                                            <label><strong>Callmed/Telmed</strong></label>
                                        </div>
                                        <br/>
                                        <div class="check">
                                            <input type="checkbox" name="autre" id="autre" checked="checked">
                                            <label for="autre" class="cadre"></label>
                                            <label><strong>Autres</strong></label>
                                        </div>
                                        <div class="clear"></div>
                                        <br>                                     
                                    </div>
                                    <div class="col-lg-12">
                                       <br><h4>Affichage des résultats</h4>
                                        <div class="radio">
                                            <input type="radio" id="vueStandard" name="affichageResultats" value="vueStandard" checked="checked" /><label for="vueStandard">Vue standard</label>
                                            <input type="radio" id="vueDetaillee" name="affichageResultats" value="vueDetaillee" /><label for="vueDetaillee">Vue détaillée</label></br>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr class="eco-ligne" />
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="hidden" id="region" name="idRegion" />
                                        <input type="hidden" id="nbAssures" name="nbAssures" value="1" />
                                        <input type="submit" value="Afficher le comparatif" class="et_pb_more_button et_pb_button" />
									</div>
                                    <div class="col-lg-9">
                                        <span id="error" class="error"></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>                
            </div>
            <br>
        </div>
        <div id="data-franchise" class="tooltip-content">
            <h4><i clasS="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Franchise</strong></h4>
            <p>La franchise est la participation première de l’assuré avant que la caisse maladie n’octroi de prestation. Au delà de la franchise, une quote-part de 10% est demandée mais pour un maximum de CHF 700.- par année pour les adultes et jeunes adultes et maximum CHF 350.- pour les enfants.</p>
        </div>
        <div id="data-accident" class="tooltip-content">
            <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Accidents</strong></h4>
            <p>
                Si vous travaillez plus de <strong>8 heures par semaine</strong> auprès du même employeur, vous êtes automatiquement assuré par le biais de votre employeur pour la couverture des accidents professionnels et non-professionnels. En tant que salarié, vous pouvez donc ôter la couverture accident de votre assurance de base.<br/><br/>
                Pour les indépendants, les personnes sans emploi (par ex. au RI - Revenu d’insertion), les enfants, les étudiants ainsi que les femmes au foyer doivent être assurés contre les accidents auprès de leur caisse maladie ou d’un assureur accident privé.
            </p>
        </div>
        <div id="data-models" class="tooltip-content">
            <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Modèles d’assurance à comparer</strong></h4>
            <h4>L’assurance de base standard</h4>
            <p>Le modèle de base est l’assurance standard qui est proposée par toute les caisses maladie. Ce modèle n’a pas de restriction quant au choix du médecin. Par conséquent il coûte aussi lus cher.</p>
            <h4>Les modèles alternatifs</h4>
            <p>La plus part des assurances maladie proposent des modèles alternatifs à l’assurance de base afin d’en réduire le coût qui peut aller jusqu’à 25%. Les assurés se voient donc contraints de soit passer par un médecin de famille, par un centre d’appel ou par un un réseau de soin tel que HMO.</p>
        </div>  
        <div id="data-naissance" class="tooltip-content">
            <h4><i class="fa fa-info"></i><strong>&nbsp;&nbsp;&nbsp;Né(e) en</strong></h4>
            <p>
                Afin de nous permettre de vous proposer un comparatif d’assurance maladie correct, nous devons connaître votre année de naissance. Les caisses maladie ont un tarif différent selon les classe d’âge.
                <br/>
                Actuellement la LAMal prévoit 3 classe d’âge :
                <br/>
                <ul class="list-default">
                    <li><strong>Enfants</strong> (0 à 18 ans révolus)</li>
                    <li><strong>Jeunes adultes</strong> (De 19 à 25 ans révolus)</li>
                    <li><strong>Adultes</strong> (Dès 26 ans révolus)</li>
                </ul>                                
            </p>
        </div>
		<script type="text/javascript">
			document.getElementById('form-second').reset();
			alert(document.getElementById('nbAssures').value)
		</script>
		
        <?php get_footer(); ?>
        <script type="text/javascript" src="http://www.syntesis.ch/comparateur/web/js/jquery-2.1.1.js"></script>
        <script type="text/javascript" src="http://www.syntesis.ch/comparateur/web/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://www.syntesis.ch/comparateur/web/js/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="http://www.syntesis.ch/comparateur/web/js/fonctions.js"></script>
        <script type="text/javascript" src="http://www.syntesis.ch/comparateur/web/js/app.js"></script>
    </body>
</html>
