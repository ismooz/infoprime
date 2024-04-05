            <div class="container-fluid">
                <div class="container">
                    <h3>Assurance de base et assuré(s)</h3>
                    <form action="/comparateur/comparateur/formThird/" method="post" class="form-maladie" onsubmit="return checkSecondSubmission();">
                        <fieldset>
                            <h3 class="blue">Données concernant l'assurance maladie de base</h3>
                            <br/>
                            <fieldset class="col_2">
                                <label>Code postal de votre domicile</label><br/>
                                <p class="localite"><?php echo($adresse); ?></p>
                            </fieldset>
                            <fieldset class="col_2">
                                <label id="labelAssureur">Caisse maladie actuelle</label><br/>
                                <select name="assureur" id="assureur">
                                    <option value="-1">- Veuillez sélectionner -</option>
<?php
    // Parcours la liste des assureurs
    foreach($assureurs as $assureur):
?>
                                    <option value="<?php echo $assureur->getId(); ?>"><?php echo ucfirst(strtolower($assureur->getName())); ?></option>
<?php
    endforeach;
?>
                                </select>
                            </fieldset>
                            <div class="clear"></div>
                        </fieldset>
                        <hr class="blue" />
                        <h3 class="blue">Données personnelles</h3>
                        <div class="clear"></div>
                        <div id="form-group">
                            <div id="form-group-1">
                                <h4 id="form-group-title-1" class="blue">Personne n° 1</h4>
                                <fieldset class="col_3">
                                    <label id="form-group-label-1" for="form-group-input-1">Année de naissance</label><i class="fa fa-info" title="Texte année de naissance" data-type="html" data-content="data-naissance"></i><br/>
                                    <input type="text" name="naissance-1" id="form-group-input-1" value="<?php echo $dateNaissance; ?>"  maxlength="4" class="petit txt-center" onblur="checkNaissance(this);"><br/>
                                </fieldset>
                                <fieldset class="col_3">
                                    <label id="form-group-label2-1" for="form-group-select-1">Franchise</label><i class="fa fa-info" title="Text franchise" data-type="html" data-content="data-franchise"></i><br/>
                                    <select name="franchise-1" id="form-group-select-1">
                                        <option value="">- Veuillez sélectionner -</option>
                                    </select>
                                </fieldset>
                                <fieldset class="col_3">
                                    <legend id="form-group-legend-1">Couverture accident <i class="fa fa-info tooltip" title="text couverture accident" data-type="html" data-content="data-accident"></i></legend>
                                    <div class="radio">
                                        <input type="radio" id="form-group-radio-avec-1" name="accident-1" value="avec" checked="checked" />
                                        <label id="form-group-label3-1" for="form-group-radio-avec-1" class="button"></label>
                                    </div> 
                                    <label id="form-group-label4-1" for="form-group-radio-avec-1" class="radioLabel">Avec</label>
                                    <div class="radio">
                                        <input type="radio" id="form-group-radio-sans-1" name="accident-1" value="sans" checked="checked" />
                                        <label id="form-group-label5-1" for="form-group-radio-sans-1" class="button"></label>
                                    </div>
                                    <label id="form-group-label6-1" for="form-group-radio-sans-1" class="radioLabel">Sans</label>                                    
                                </fieldset>
                                <div class="clear"></div>
                                <span id="form-group-error-1" class="error-input"></span>
                            </div>
                        </div>
                        <div id="data-naissance" class="tooltip-content">
                            <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Né(e) en</h3>
                            <p>
                                Pour établir votre comparatif peronnel, nous avons besoin de connaître votre année de naissance, car les caisses maladies appliquent
                                des primes différentes selon la tranche d'âge.<br/><br/> 
                                Il existe 3 tanches d'âge définies par la loi (LAMal) dans l'assurance de base.
                                <br/>
                                <ul class="list-default">
                                    <li><strong>Enfants</strong> (Jusqu'a 18ans)</li>
                                    <li><strong>Jeunes adultes</strong> (De 18ans révolus jusqu'a 25ans)</li>
                                    <li><strong>Adultes</strong> (A partir de 25ans révolus)</li>
                                </ul>                                
                            </p>
                        </div>                                    
                        <div id="data-franchise" class="tooltip-content">
                            <h3><i clasS="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Franchise</h3>
                            <p>Les assurés doivent participer aux coûts des prestations payées par leur caisse maladie. Cette participation financière se compose d'un montant fixé à l'avance, appelé franchise, et d'une quote-part de 10 %. La franchise n'est à payer qu'une fois par année civile.</p> 
                            <p>Seuls les niveaux de franchise proposés par la caisse maladie actuelle seront affichées dans la sélection.</p>
                        </div>
                        <div id="data-accident" class="tooltip-content">
                            <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Couverture accident</h3>
                            <p>
                                Toute personne employée au minimum <strong>8 heures par semaine</strong> auprès du même employeur est automatiquement assuré contre les accidents par son employeur (couvertur LAA);
                                Les salariés peuvent donc <strong>sans hésitation renoncer à souscrire la couverture accident</strong> auprès de leur caisse maladie
                            </p>
                            <p>Les personnes sans emploi ou exercant une activité indépendante tout comme les enfants doivent être assurés contre les accidents auprès d'une caisse maladie ou d'une assurance accident d'une compagnie privée.</p>
                        </div>
                        <div id="data-models" class="tooltip-content">
                            <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Modèles comparés</h3>
                            <h4>Assurance de base standard</h4>
                            <p>
                                L'assurance de base standard est l'assurance obligatoire des soins (AOS) proposée par toutes les caisses maladie.
                                Les prestations fournies sont identiques auprès de toutes les caisses maladie et incluent le libre choix du médecin.
                            </p>
                            <h4>Modèles d'assurance alternatifs</h4>
                            <p>
                                Les modèles d'assurance alternatifs comprennent, entre autres, les modèles HMO, Médecin de famille et Telmed.
                                Les assurés bénéficient alors d'un rabais allant jusqu'à 25% sur leurs primes par rapport à l'assurance de base standard.
                            </p>
                        </div>                        
                        <br/>
                        <h5>Ajouter / Supprimer une personne</h5>
                        <button id="button-add" class="btn btn-default btn-theme-default">+</button> <button id="button-remove" class="btn btn-default btn-theme-default">-</button>                      
                        <br/>
                        <hr class="blue" />
                        <fieldset>
                            <h3 class="blue">Sélection de modèle et affichage</h3>
                            <br/>
                            <h4 id="modelesCompares">Modèles comparés<i class="fa fa-info" title="Text modèles comparés" data-type="html" data-content="data-models"></i></h4>
                            <fieldset class="col_2">
                                <div class="slide">	
                                    <input type="checkbox" id="standard" name="standard" checked="checked" />
                                    <label class="button" for="standard"></label>
                                </div>  
                                <label for="standard">Standard</label>
                                <br/>
                                <div class="slide">	
                                    <input type="checkbox" id="medecinFamille" name="medecinFamille" checked="checked" />
                                    <label class="button" for="medecinFamille"></label>
                                </div>  
                                <label for="medecinFamille">Medecin de famille</label>
                                <br/>
                                <div class="slide">	
                                    <input type="checkbox" id="hmo" name="hmo" checked="checked" />
                                    <label class="button" for="hmo"></label>
                                </div>
                                <label for="hmo">HMO</label>
                            </fieldset>
                            <fieldset class="col_2">
                                <div class="slide">	
                                    <input type="checkbox" id="telmed" name="telmed" checked="checked" />
                                    <label class="button" for="telmed"></label>
                                </div>  
                                <label for="telmed">Telmed</label>
                                <br/>
                                <div class="slide">	
                                    <input type="checkbox" id="autre" name="autre" checked="checked" />
                                    <label class="button" for="autre"></label>
                                </div>
                                <label for="autre">Autre</label>
                            </fieldset>
                            <div class="clear"></div>
                            <p>Si vous le souhaitez, sélectionnez votre modèle d'assurance à la page suivante (résultats).</p>
                            <br/>
                            <h4>Affichage des résultats<i class="fa fa-info masterTooltip" title="Texte affichage" data-type="html" data-content="data-affichage"></i></h4>
                            <div id="data-affichage" class="tooltip-content">
                                <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Affichage des résultats</h3>
                                <p>
                                    <h3>Vue standard :</h3>
                                    <ul>
                                        <li>
                                           Votre caisse maladie actuelle : <br/>
                                           les primes, les modèles d'assurance alternatifs, la satisfaction client.
                                       </li>
                                       <li>
                                           l'assurance de base standard la moins chère et la plus chère.
                                       </li>
                                       <li>
                                           si sélectionné, le modèle d'assurance alternatif le moins cher.
                                       </li>
                                       <li>
                                           les primes des caisses ayant le plus haut et le plus bas taux de satisfaction.
                                       </li>
                                       <li>
                                           les primes des caisses maladie dont les frais de gestion sont les plus faibles (catégories nationale et régionale).
                                       </li>
                                       <li>
                                           et tour les produits pour lesquels il est possible de demander une offre via economies.ch
                                       </li>
                                    </ul>
                                    <h3>Vue détaillée</h3>
                                    <ul>
                                        <li>tous les produits et le taux de satisfaction de toutes les caisses.</li>
                                    </ul>
                                </p>
                            </div>
                            <div class="radio">
                                <input type="radio" id="vueStandard" name="affichageResultats" value="vueStandard" checked="checked" />
                                <label for="vueStandard" class="button"></label>
                            </div>
                            <label for="vueStandard" class="radioLabel">Vue standard</label>
                            <div class="radio">
                                <input type="radio" id="vueDetaillee" name="affichageResultats" value="vueDetaillee" /> 
                                <label for="vueDetaillee" class="button"></label>
                            </div>
                            <label for="vueDetaillee" class="radioLabel">Vue détaillée</label>
                        </fieldset>
                        <hr class="blue" />
                        <input type="hidden" id="nbAssures" name="nbAssures" value="1" />
                        <input type="hidden" name="idRegion" value="<?php echo $idRegion; ?>" />
                        <div class="col_2">
                            <input type="submit" value="Afficher les résultats" class="button" />
                        </div>
                        <div class="col_2">
                            <span id="error" class="error">test</span>
                        </div>                        
                        <div class="clear"></div>
                        <br/> 
                    </form>
                </div>                
            </div>