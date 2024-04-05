            <?php
            
                $db = \library\database\MyPDO::getInstance(DB_DSN, DB_USER, DB_PASS);
                $comparateur = new library\comparateur($db, $_POST);
                
                //var_dump($nationalites);
            
            ?>
            <div class="container-fluid economies-blue">
                <div class="container container-separation" id="assurance-selection">
                    <h2 class="txt-center">Demande une offre gratuite et sans engagement à <?php echo $comparateur->getAssureur($_POST['assureurSelectedId'])['name']; ?>.</h2>
                    <br/>
                    <h3>Votre sélection</h3>
                    <?php for($i=1;$i<=$_POST['nbAssures'];$i++): ?>
                    <fieldset class="col_4">
                        Année de naissance<br/>
                        <p><strong><?php echo $_POST['naissance-' . $i]; ?></strong></p>
                    </fieldset>
                    <fieldset class="col_4">
                        Modèle<br/>
                        <p><strong><?php echo $_POST['tarifType']; ?></strong></p>
                    </fieldset>
                    <fieldset class="col_4">
                        Franchise<br/>
                        <p><strong>CHF <?php echo $_POST['franchise-' . $i]; ?></strong></p>
                    </fieldset>
                    <fieldset class="col_4">
                        Couverture accident<br/>
                        <p><strong><?php echo $_POST['accident-' . $i]; ?></strong></p>
                    </fieldset>
                    <div class="clear"></div>
                    <br/>
                    <?php endfor; ?>
                    <fieldset class="col_2">
                        <h3>Prime annuelle courante</h3>
                        <?php echo $comparateur->getAssureur($_POST['assureur'])['name']; ?> - 
                        <p><strong>CHF <?php echo number_format($_POST['assureurActuelTotal'], 2, "." , "'"); ?></strong></p>
                    </fieldset>
                    <fieldset class="col_2">
                        <h3>Prime annelle séléctionnée</h3>
                        <p>
                            <?php echo $comparateur->getAssureur($_POST['assureurSelectedId'])['name']; ?> - 
                            <strong>CHF <?php echo number_format($_POST['assureurSelectedTotal'], 2, "." , "'"); ?></strong>
                        </p>
                    </fieldset>
                    <div class="clear"></div>
                    <br/>
                    <div class="txt-right">
                        <?php
                            $difference = $_POST['assureurSelectedTotal'] - $_POST['assureurActuelTotal'];
                            echo(($difference > 0)?'Prime supèrieur de <span class="differenceSuperieur">CHF ' . number_format($difference, 2, "." , "'"):'Prime inférieur de <span class="differenceInferieur">CHF ' . number_format($difference, 2, "." , "'"));
                        ?>
                    </div>
                </div>
            </div>
            <div class="container-fluid">    
                <div class="container">
                    <form action="/comparateur/comparateur/process/" method="post" id="form-fourth" onsubmit="return checkFourthSubmission();">
                        <h1 class="blue">Je souhaite aussi des offres pour</h1>
                        <label class="bold" id="lblDivision">Sélection de la division hospitalière</label><i class="fa fa-info masterTooltip" title="Texte division" data-type="html" data-content="data-division"></i><br/>
                        <select name="division" id="division" title="Choix de la division hospitalière">
                            <option value="-1">- Veuillez sélectionner -</option>
                            <option value="Division commune, Suisse entière">Division commune, Suisse entière</option>
                            <option value="Division semi-privée">Division semi-privée</option>
                            <option value="Division privée">Division privée</option>
                        </select>
                        <br/>
                        <br/>
                        <h3>Assurance complémentaire hospitalière</h3>
                        <p>Je voudrais les garanties suivantes</p>
                        <fieldset class="col_2">
                            <div class="slide">	
                                <input type="checkbox" id="medecineDouce" name="medecineDouce" />
                                <label class="button" for="medecineDouce"></label>    
                            </div>
                            <label for="medecineDouce">Médecine douce <i class="fa fa-info masterTooltip" title="Texte médecine douce" data-type="html" data-content="data-medecineDouce"></i></label>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="prevoyanceSante" name="prevoyanceSante" />
                                <label class="button" for="prevoyanceSante"></label>
                            </div>
                            <label for="prevoyanceSante">Prévoyance santé <i class="fa fa-info masterTooltip" title="Prévoyance santé" data-type="html" data-content="data-prevoyanceSante"></i></label>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="preventionSante" name="preventionSante" />
                                <label class="button" for="preventionSante"></label>
                            </div>                        
                            <label for="preventionSante">Prévention santé <i class="fa fa-info masterTooltip" title="Prévention santé" data-type="html" data-content="data-preventionSante"></i></label>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="maternite" name="maternite" />
                                <label class="button" for="maternite"></label>
                            </div>
                            <label for="maternite">Maternité <i class="fa fa-info masterTooltip" title="Maternité" data-type="html" data-content="data-maternite"></i></label>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="urgenceEtranger" name="urgencesEtranger" />
                                <label class="button" for="urgenceEtranger"></label>
                            </div>
                            <label for="urgenceEtranger">Urgences à l'étranger <i class="fa fa-info masterTooltip" title="Urgences à l'étranger" data-type="html" data-content="data-urgencesEtranger"></i></label>
                            <br/>
                        </fieldset>
                        <fieldset class="col_2">
                            <div class="slide">	
                                <input type="checkbox" id="correctionsVue" name="correctionsVue" />
                                <label class="button" for="correctionsVue"></label>
                            </div>                        
                            <label for="correctionsVue">Corrections de la vue <i class="fa fa-info masterTooltip" title="Corrections de la vue" data-type="html" data-content="data-correctionsVue"></i></label>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="rechercheSauvetage" name="rechercheSauvetage" />
                                <label class="button" for="rechercheSauvetage"></label>
                            </div>
                            <label for="rechercheSauvetage">Recherches et sauvetage <i class="fa fa-info masterTooltip" title="Recherches et sauvetage" data-type="html" data-content="data-recherchesSauvegarde"></i></label>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="transport" name="transport" />
                                <label class="button" for="transport"></label>
                            </div>                        
                            <label for="transport">Transport <i class="fa fa-info masterTooltip" title="Transport" data-type="html" data-content="data-transport"></i></label>
                            <br/>
                            <div class="slide">	
                                <input type="checkbox" id="orthodontie" name="orthodontie" />
                                <label class="button" for="orthodontie"></label>
                            </div>
                            <label for="orthodontie">Orthodontie <i class="fa fa-info masterTooltip" title="Orthodontie" data-type="html" data-content="data-orthodontie"></i></label>
                        </fieldset>
                        <div class="clear"></div>
                        <br/>                        
                        <h3 class="blue">Indications relatives à la demande d'offre</h3><br/>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="bold" id="lblFormule">Formule d'appel</label><br/><br/>
                                <div class="radio">
                                    <input type="radio" name="formule" id="madame" value="Madame" />
                                    <label for="madame" class="button"></label>
                                </div>
                                <label for="madame" class="radioLabel" id="lblMadame">Madame</label>
                                <div class="radio">
                                    <input type="radio" name="formule" id="monsieur" value="Monsieur" />
                                    <label for="monsieur" class="button"></label>
                                </div>
                                <label for="monsieur" class="radioLabel" id="lblMonsieur">Monsieur</label>
                            </div>
                        </div>
                        <br/>
                        <fieldset>
                            <label class="bold" id="lblNom">Nom</label><br/>
                            <input type="text" name="nom" id="nom" class="client" title="Nom de l'assuré" /><br/><br/>
                            <label class="bold" id="lblPrenom">Prénom</label><br/>
                            <input type="text" name="prenom" id="prenom" class="client" title="Prénom de l'assuré" /><br/><br/>
                            <label class="bold" id="lblAdresse">Adresse</label><br/>
                            <input type="text" name="adresse" id="adresse" class="client" title="Adresse de l'assuré" /><br/><br/>
                            <label class="bold" id="lblNpa">Numéro postal</label><br/>
                            <input type="text" name="npa" id="npa" class="client" title="Numéro postal de l'assuré" /><br/><br/>
                            <label class="bold" id="lblVille">Ville</label><br/>
                            <input type="text" name="ville" id="ville" class="client" title="Ville de l'assuré" /><br/><br/>
                            <label class="bold" id="lblTel">Téléphone</label><br/>
                            <input type="text" name="tel" id="tel" class="client" title="Téléphone de l'assuré" /><br/><br/>
                            <label class="bold" id="lblEmail">Email</label><br/>
                            <input type="text" name="email" id="email" class="client" title="Adresse email de l'assuré" /><br/><br/>
                            <label class="bold" id="lblNationalite">Nationalité</label><br/>
                            <select name="nationalite" id="nationalite" title="Nationalité de l'assuré">
                                <option value="-1">-- Veuillez sélectionner</option>
<?php
    // Parcours les nationalités
    foreach($nationalites as $nationalite):
?>
                                <option value="<?php echo($nationalite->getId()); ?>"><?php echo($nationalite->getNameFr()); ?></option>;                 
<?php
    endforeach;
?>
                            </select><br/><br/>
                            <label class="bold" id="lblLangue">Langue de correspondance</label><i class="fa fa-info masterTooltip" title="Texte langue de correspondance" data-type="html" data-content="data-langueCorrespondance"></i><br/>
                            <select name="langue" id="langue" title="Langue de correspondance de l'assuré">
                                <option value="-1">-- Veuillez sélectionner --</option>
<?php
    // Parcours les nationalités
    foreach($langues as $langue):
?>
                                <option value="<?php echo($langue->getId()); ?>"><?php echo($langue->getNameFr()); ?></option>;                 
<?php
    endforeach;
?>
                            </select>
                            <br/><br/>
                            <label class="bold" id="lblDateNaissance">Date de naissance</label><br/>
                            <input type="text" name="dateNaissance" id="datepicker" class="" title="Date de naissance de l'assuré" />
                        </fieldset>                    
                        <hr class="blue" />
                        <h3 class="blue">Processus de demande</h3>
                        <p>
                            Vos données sont enregistrées auprès de Syntesis.ch, puis transmises à Assura, 
                            qui les traite de manière autonome et vous fait parvenir l'offre souhaitée par e-mail. 
                            Vous pouvez demander d'autres offres par la suite (protection des données chez Syntesis.ch).
                        </p>
                        <hr class="blue" />
                        <?php 
                            foreach($_POST as $key=>$value):
                        ?>
                        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
                        <?php endforeach; ?>
                        <input type="submit" value="Envoyer la demande" class="btn btn-default" />
                        <span id="error" class="error"></span>
                    </form>
                </div>
                <div class="panel-footer"></div>
            </div>
            <div id="data-division" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Sélection de la division hositalière</h3>
                <h4>Division commune Suisse entière</h4>
                <p>Couvre les éventuels frais supplémentaires de soins réçus en division commune en dehors du canton de résidence.</p>
                <h4>Division semi-privée</h4>
                <p>Droit à une chambre à deux lits et au libre choix du médecin.</p>
                <h4>Division privée</h4>
                <p>Droit à une chambre individuelle et au libre choix du médecin</p>
            </div>
            <div id="data-medecineDouce" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Médecine douce</h3>
                <p>
                    Couvre les coûts non pris en charge par l'assurance de base. Celle-ci ne participe qu'aux traitement d'acuponcture, de médecine anthroposophique, d'homéopathie,
                    de thérapie neurale, de pytothérapie et de médecine chinoise traditionnelle.
                </p>
            </div>
            <div id="data-prevoyanceSante" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Prévoyance santé</h3>
                <p>
                    Contributions aux activités de romotion de la santé, par ex. centre fitness, abonnements pour la piscine, etc.
                    L'assurance de base ne prend aucun coût en charge.
                </p>
            </div>
            <div id="data-preventionSante" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Prévention santé</h3>
                <p>
                    Contributions au prestations destinées à prévenir l'apparition d'une maladie, telles que les checkup médicaux.
                    L'assurance de base prend en charge diverses vaccinations préventives par exemple. 
                </p>
            </div>
            <div id="data-medicaments" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Médicaments</h3>
                <p>
                    Couvre les coûts des médicaments non remboursés par l'assurance de base. Important : l'assurance complémentaire ne rembourse pas tous les médicaments non plus.
                </p>
            </div>
            <div id="data-vacinations" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Vacinationss</h3>
                <p>
                    Couvre le coût des vaccinations qui ne sont pas prises en charges par l'assurance de base.
                </p>
            </div>
            <div id="data-maternite" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Matérnité</h3>
                <p>
                    Couvre les couts non pris en charge par l'assurance de base. Celle-ci rembourse, entre autres,
                    le coût de sept visites de contrôle de de deux échographies en cas de grossesse.
                </p>
            </div>
            <div id="data-urgencesEtranger" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Urgences à l'étranger</h3>
                <p>
                    Contributions aux prestations ambulatoires et stationnaires nécessaires d'urgence lors d'un séjour à l'étranger.
                    l'assurance de base rembourse au maximum le double du coût que le même traitement coûterait en Suisse. La couverture de l'assurance de base suffit pour l'Europe, mais dans certains pays,
                    en particulier aus USA, au Canada, en Australie et au Japon, il est recommandé d'avoir une assurance supplémentaire.
               </p>
            </div>
            <div id="data-correctionsVue" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Corrections de la vue</h3>
                <p>
                    L'assurance de base offre pour les enfants des prestations pour les corrections de la vue. Les adultes obtiennent une prise en charge des coûts au prorata par l'assurance de base
                    uniquement lorsque surviennent des maladies particulières ou suite à une opération des yeux.
               </p>
            </div>
            <div id="data-recherchesSauvegarde" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Recherches et sauvetage</h3>
                <p>
                    L'assurance de base paie 50% des frais de sauvetage à hauteur de max. 5000 CHF par année civile, limités au territoire suisse.
                    Les frais de recherche des personnes disparues dont la santé est supposée être en danger sont pris en charge par l'assurance de base
                    à 50 %, à la hauteur de max. 5000 CHF par année civile. 
               </p>
            </div>
            <div id="data-transport" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Transport</h3>
                <p>
                    Couvre les coûts de transport non couverts par l'assurance de base. L'assurance de base paie seulement 50 % des frais de transport, au maximum 500 CHF par année civile.
                    Important : le transport doit être indispensable du point de vue médical.
               </p>
            </div>
            <div id="data-orthodontie" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Orthodontie</h3>
                <p>
                    Couvre le coût des traitements pour la correction du positionnement des dents, L'assurance de base ne prend aucun coût en charge.
               </p>
            </div>
            <div id="data-langueCorrespondance" class="tooltip-content">
                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Langue de correspondance</h3>
                <p>
                    La caisse maladie sélectionnée ne peut vous transmetre des offres que dans la langue ci-dessous.
               </p>
            </div>