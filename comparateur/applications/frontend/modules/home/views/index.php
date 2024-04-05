<?php
    if(!$user->isAuthenticated()):
?>
            <div class="container-fluid economies-blue">
                <div class="container container-separation">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="txt-center">
                                <p class="economie-round"><span class="fa fa-3x fa-car"></span></p>
                                <p class="economies">Assurance Voiture</p>
                                <br/>
                                <br/>
                                <p><a href="" class="btn btn-economie">Plus d'info</a></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="txt-center">
                                <p class="economie-round"><span class="fa fa-3x fa-home"></span></p>
                                <p class="economies">Assurance Ménage</p>
                                <br/>
                                <br/>
                                <p><a href="" class="btn btn-economie">Plus d'info</a></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="txt-center">
                                <p class="economie-round"><span class="fa fa-3x fa-heart"></span></p>
                                <p class="economies">Assurance Maladie</p>
                                <br/>
                                <br/>
                                <p><a href="" class="btn btn-economie">Plus d'info</a></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="txt-center">
                                <p class="economie-round"><span class="fa fa-3x fa-life-ring"></span></p>
                                <p class="economies">Assurance Vie</p>
                                <br/>
                                <br/>
                                <p><a href="" class="btn btn-economie">Plus d'info</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
    else:
?>
            <div class="container-fluid economies-blue">
                <div class="container">
                    <div class="row">
                        <h3 class="txt-white"><strong>Mes coordonnées</strong></h3>
                            <form action="" method="post" class="coordonnees" id="coordonnees">
                                <div class="col-md-4 col-sm-4">
                                    <label for="nom">Nom :</label>
                                    <input type="text" name="nom" id="nom" value="Vazquez" />
                                    <label for="adresse">Adresse :</label>
                                    <input type="text" name="adresse" id="adresse" value="Chemin de Renens 24" />
                                    <label for="telephone">Téléphone :</label>
                                    <input type="text" name="telephone" id="telephone" value="079 206 68 88" />
                                    <label for="email">Email :</label>
                                    <input type="text" name="email" id="email" value="luis@microdowntown.com" />
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <label for="prenom">Prénom :</label>
                                    <input type="text" name="prenom" id="prenom" value="Luis" />
                                    <label for="npa">Numéro postal :</label>
                                    <input type="text" name="npa" id="npa" value="1004" />
                                    <label for="mobile">Mobile :</label>
                                    <input type="text" name="mobile" id="mobile" value="079 206 68 88" />
                                    <label for="iban">IBAN :</label>
                                    <input type="text" name="iban" id="iban" value="5465846546" />
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <label for="dateNaissance">Né le :</label>
                                    <input type="text" name="dateNaissance" id="dateNaissance" value="20/08/1969" />
                                    <label for="localite">Localité :</label>
                                    <input type="text" name="localite" id="localite" value="Lausanne" />
                                </div>
                                <div class="clear"></div>
                            </form>
                            <br/>
                            <button class="btn btn-sm btn-default" onclick="document.getElementById('coordonnees').setAttribute('class', 'coordonneesEdit');this.innerHTML = 'Sauvegarder';">Editer</button>
                            <div class="clear"></div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="txt-center">
                                    <p><a href=""><img src="/comparateur/web/images/assuranceVoiture.png" alt="" class="vignette" /></a></p>
                                    <p class="label label-primary">Assurance Voiture</p>
                                    <br/>
                                    <br/>
                                    <p><a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a></p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="txt-center">
                                    <p><img src="/comparateur/web/images/assuranceMenage.png" alt="" class="vignette" /></p>
                                    <p class="label label-primary">Assurance Ménage</p>
                                    <br/>
                                    <br/>
                                    <p><a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a></p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="txt-center">
                                    <p><a href=""><img src="/comparateur/web/images/assuranceMaladie.png" alt="" class="vignette" /></a></p>
                                    <p class="label label-primary">Assurance Maladie</p>
                                    <br/>
                                    <br/>
                                    <p><a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a></p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="txt-center">
                                    <p><img src="/comparateur/web/images/assuranceVie.png" alt="" class="vignette" /></p>
                                    <p class="label label-primary">Assurance Vie</p>
                                    <br/>
                                    <br/>
                                    <p><a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">Mes polices actuelles</div>
                                <div class="panel-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Branche</th>
                                                <th>Type</th>
                                                <th>Compagnie</th>
                                                <th>N° de police</th>
                                                <th>Début du contrat</th>
                                                <th>Fin du contrat</th>
                                                <th>Résiliation entre le</th>
                                                <th>Prime</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Véhicule</td>
                                                <td>Voiture Peugeot 308</td>
                                                <td>Allianz</td>
                                                <td>121.121.123</td>
                                                <td>01.01.2015</td>
                                                <td>01.01.2020</td>
                                                <td>09.2019 - 12.2019</td>
                                                <td>CHF 1'872.00</td>
                                                <td><boutton class="btn btn-default">Afficher la police</boutton></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer"></div>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
<?php
    endIf;
?>
            <div class="container-fluid economies-default">
                <div class="container container-separation">
                    <div class="row">
                        <div class="col-md-6">
                            <h3><strong>Assurance maladie de base</strong></h3>
                            <p>
                                L'assurance obligatoire des soins, communément appelée assurance de base, couvre les frais résultant d'une maladie, 
                                d'un accident ou d'une maternité. C'est grâce à cette assurance basée sur le principe de la mutualité et de la solidarité 
                                que chaque personne assurée peut avoir accès aux soins de base et avoir ainsi la garantie d'un état de santé le meilleur possible.                            
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h3><strong>Compararer vos assurances maladies</strong></h3>
                            <p>Comparez les primes vite et bien et payez moins d'assurance maladie, tous les mois</p>
                            <form action="/comparateur/comparateur/formSecond/" method="post" id="form-first" onsubmit="return checkFirstSubmission();">
                                <fieldset class="col-md-5">
                                    <label id="label_naissance" for="naissance" class="bold">Année de naissance</label><br/>
                                    <input type="text" name="dateNaissance" id="dateNaissance" class="naissance" maxlength="4" placeholder="Année" class="petit txt-center" onblur="calculAge(this.value, 'age');" />
                                    <span id="age"></span>
                                </fieldset>
                                <fieldset class="col-md-5">
                                    <label id="label_npa" for="npa" class="bold">Numéro postal</label><br/>
                                    <input type="text" name="adresse" id="adresse" placeholder="NPA ou localité" />
                                    <input type="hidden" id="region" name="idRegion" value="" />
                                    <div class="autocomplete-suggestions-container" id="suggestions-container"></div>
                                    <div class="clear"></div>
                                </fieldset>
                                <fieldset class="col-md-2">
                                    <input type="submit" id="submit" value="Valider" />
                                </fieldset>
                                <div class="clear"></div>
                                <fieldset class="col-md-12">
                                    <div id="error" class="error txt-center"></div>
                                </fieldset>
                            </form>                  
                        </div>
                    </div>
                </div>
            </div>