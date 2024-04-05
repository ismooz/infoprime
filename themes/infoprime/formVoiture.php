<?php
/* Template Name: formVoiture */

include_once ABSPATH . '/comparateur/library/database/MyPDO.class.php';
//include_once 'library/database/MyPDO.class.php';

try{
    $db = \library\database\MyPDO::getInstance('mysql:host=h2mysql1;dbname=lbnf_WP14675', 'lbnf_ismael', 'IsmaeL_1983');
    //$db = \library\database\MyPDO::getInstance('mysql:host=localhost;dbname=voiture', 'root', '');
    $marques = $db->query('SELECT * FROM voitures_marques')->fetchAll(\PDO::FETCH_ASSOC);
    $nationalites = $db->query('SELECT * FROM nationalites')->fetchAll(\PDO::FETCH_ASSOC);
    $permis = $db->query('SELECT * FROM permis')->fetchAll(\PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo($ex->getMessage());
}

get_header();

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://economies.ch/voitures/web/library/bootstrap-3.3.5/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="https://economies.ch/voitures/web/library/font-awesome-4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="https://economies.ch/voitures/web/library/jquery-ui-1.11.4/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="https://economies.ch/voitures/web/library/jquery-ui-1.11.4/jquery-ui.theme.min.css" />
        <link rel="stylesheet" type="text/css" href="https://economies.ch/voitures/web/css/styles.css" />
        <meta charset="UTF-8">
        <title>Voiture</title>
    </head>
    <body>
<!-- formVoiture.php -->
        <div class="container" style="padding:30px 0 30px 0;">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3><strong>Demande d'offre véhicule à moteur</strong></h3>
                </div>
                <div class="clearfix"></div>
            </div>
            <hr/>
            <form action="https://economies.ch/accueil/offre-vehicule-moteur/confirmation-offre-vehicule-a-moteur/" method="post" onsubmit="return checkVoiture();">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Type de contact</label><br/>
                            <select class="form-control" name="type" id="type" onchange="switchType();">
                                <option value="Particulier">Particulier</option>
                                <option value="Entreprise">Entreprise</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 text-right"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                        <div class="form-group">
                            <label class="control-label" for="contact" id="lblContact">Demande faite par un :</label><br/>
                            <select class="form-control" name="contact" id="contact" onchange="setDisplay('agent')">
                                <option value="Client">Client</option>
                                <option value="Agent">Agent</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="agent" style="display:none">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                            <div class="form-group">
                                <label class="control-label" for="nomAgent" id="lblNomAgent">Nom de l'agent</label><br/>
                                <input class="form-control" type="text" name="nomAgent" id="nomAgent" />
                            </div>
                        </div>
                        <div class="clearfix"></div>                    
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4><strong>Preneur d'assurance</strong></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>                
                <div id="particulier">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblNom" for="nom">Nom</label><br/>
                                <input class="form-control" type="text" name="nom" id="nom" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblPrenom" for="prenom">Prénom</label><br/>
                                <input class="form-control" type="text" name="prenom" id="prenom" />
                            </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblAdresse" for="adresse">Adresse</label><br/>
                                <input class="form-control" type="text" name="adresse" id="adresse" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group ui-widget">
                                <label class="control-label" id="lblNpaLocalite" for="npaLocalite">Npa/Localité</label><br/>
                                <input class="form-control region" type="text" name="npaLocalite" id="npaLocalite" />
                            </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblTelephone" for="telephone">Téléphone</label><br/>
                                <input class="form-control" type="text" name="telephone" id="telephone" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblDateNaissance" for="dateNaissance">Date de naissance</label><br/>
                                <input class="form-control datepicker" type="text" name="dateNaissance" id="dateNaissance" />
                            </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblNationalite" for="nationalite">Nationalité</label><br/>
                                <select class="form-control" name="nationalite" id="nationalite" onchange="verifierNationalite(this, 'permis');">
                                    <option value="-1">- Veuillez sélectionner -</option>
                                    <optgroup label="Courants">
                                        <option value="Suisse">Suisse</option>
                                    </optgroup>
                                    <optgroup label="Autres">
<?php
foreach($nationalites as $nationalite):
    if($nationalite['id'] !== '98'):
?>
                                        <option value="<?php echo($nationalite['name_fr']); ?>"><?php echo($nationalite['name_fr']); ?></option>
<?php
    endif;
endforeach;
?>
                                    </optgroup>
                               </select>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblPermis" for="permis">Permis d'établissment</label><br/>
                                <select class="form-control" name="permis" id="permis" disabled="disabled">
                                    <option value="-1">- Veuillez sélectionner -</option>
<?php
foreach($permis as $livret):
?>
                                    <option value="<?php echo($livret['nom']); ?>"><?php echo($livret['name']); ?></option>
<?php
endforeach;
?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblDatePermis" for="datePermis">Date du permis de conduire</label>
                                <input class="form-control datepicker" type="text" name="datePermis" id="datePermis" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="clearfix"></div>
                    </div>                    
                </div>
                <div id="entreprise">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblNomEntreprise" for="nomEntreprise">Nom d'entreprise</label><br/>
                                <input class="form-control" type="text" name="nomEntreprise" id="nomEntreprise" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblDateCreationEntreprise" for="dateCreationEntreprise">Date de création</label><br/>
                                <input class="form-control datepicker" type="text" name="dateCreationEntreprise" id="dateCreationEntreprise" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblAdresseEntreprise" for="adresseEntreprise">Adresse</label><br/>
                                <input class="form-control" type="text" name="adresseEntreprise" id="adresseEntreprise" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">                           
                            <div class="form-group ui-widget">
                                <label class="control-label" id="lblNpaLocaliteEntreprise" for="npaLocaliteEntreprise">Npa/Localité</label><br/>
                                <input class="form-control region" type="text" name="npaLocaliteEntreprise" id="npaLocaliteEntreprise" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblTelephoneEntreprise" for="telephoneEntreprise">Téléphone</label><br/>
                                <input class="form-control" type="text" name="telephoneEntreprise" id="telephoneEntreprise" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblEmailEntreprise" for="emailEntreprise">Email</label><br/>
                                <input class="form-control" type="text" name="emailEntreprise" id="emailEntreprise" onblur="return verifierEmail(this.id, this.value);" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4><strong>Conducteur habituel</strong></h4>
                        <p>
                            (Si différent du preneur d'assurance)&nbsp;&nbsp;&nbsp;<input type="radio" name="preneur" value="oui" checked="checked" onchange="setDisplay('preneurForm');">&nbsp;&nbsp;<label for="preneur">Preneur d'assurance</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="preneur" id="preneur" value="non" onchange="setDisplay('preneurForm');" />&nbsp;&nbsp;<label for="autre">Autre</label><br/>
                            <small>Nom, prénom, adresse, date de naissance, date permis conduire, nationalité.</small>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="preneurForm">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblNomPreneur" for="nomPreneur">Nom</label><br/>
                                <input class="form-control" type="text" name="nomPreneur" id="nomPreneur" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblPrenomPreneur" for="prenomPreneur">Prénom</label><br/>
                                <input class="form-control" type="text" name="prenomPreneur" id="prenomPreneur" />
                            </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblAdressePreneur" for="adressePreneur">Adresse</label><br/>
                                <input class="form-control" type="text" name="adressePreneur" id="adressePreneur" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group ui-widget">
                                <label class="control-label" id="lblNpaLocalitePreneur" for="npaLocalitePreneur">Npa/Localité</label><br/>
                                <input class="form-control region" type="text" name="npaLocalitePreneur" id="npaLocalitePreneur" />
                            </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblTelephonePreneur" for="telephonePreneur">Téléphone</label><br/>
                                <input class="form-control" type="text" name="telephonePreneur" id="telephonePreneur" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblDateNaissancePreneur" for="dateNaissance">Date de naissance</label><br/>
                                <input class="form-control datepicker" type="text" name="dateNaissancePreneur" id="dateNaissancePreneur" />
                            </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblNationalitePreneur" for="nationalitePreneur">Nationalité</label><br/>
                                <select class="form-control" name="nationalitePreneur" id="nationalitePreneur" onchange="verifierNationalite(this, 'permisPreneur');">
                                    <option value="-1">- Veuillez sélectionner -</option>
                                    <optgroup label="Courants">
                                        <option value="Suisse">Suisse</option>
                                    </optgroup>
                                    <optgroup label="Autres">
<?php
foreach($nationalites as $nationalite):
    if($nationalite['id'] !== '98'):
?>
                                        <option value="<?php echo($nationalite['name_fr']); ?>"><?php echo($nationalite['name_fr']); ?></option>
<?php
    endif;
endforeach;
?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblPermisPreneur" for="permisPreneur">Permis d'établissment</label><br/>
                                <select class="form-control" name="permisPreneur" id="permisPreneur" disabled="disabled">
                                    <option value="-1">- Veuillez sélectionner -</option>
<?php
foreach($permis as $livret):
?>
                                    <option value="<?php echo($livret['name']); ?>"><?php echo($livret['name']); ?></option>
<?php
endforeach;
?>
                                </select>
                            </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" id="lblDatePermisPreneur" for="datePermisPreneur">Date du permis de conduire</label>
                                <input class="form-control datepicker" type="text" name="datePermisPreneur" id="datePermisPreneur" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4><strong>Véhicule</strong></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblTypeVehicule" for="typeVehicule">Type de véhicule</label><br/>
                            <select class="form-control" name="typeVehicule" id="typeVehicule">
                                <option value="-1">- Veuillez sélectionner -</option>
                                <option value="Voiture de tourisme">Voiture de tourisme</option>
                                <option value="Camion">Camion</option>
                                <option value="Moto/Scooter">Moto/Scooter</option>
                                <option value="Remorque">Remorque</option>
                                <option value="Utilitaire">Utilitaire</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblMarque" for="marque">Marque</label><br/>
                            <select class="form-control" name="marque" id="marque">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
foreach($marques as $marque):
?>
                                <option value="<?php echo($marque['nom']); ?>"><?php echo($marque['nom']); ?></option>
<?php
endforeach;
?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblModel" for="model">Model</label><br/>
                            <input class="form-control" type="text" name="model" id="model">                    
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" class="control-label" id="lblCylindree" for="cylindree">Cylindrée</label><br/>
                            <input class="form-control" class="form-control" type="text" name="cylindree" id="cylindree" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblKmAnnuel" for="kmAnnuel">Kilométres annuels</label><br/>
                            <input class="form-control" type="text" name="kmAnnuel" id="kmAnnuel" />
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblKmCompteur" for="kmCompteur">Kilométres au compteur</label><br/>
                            <input class="form-control" type="text" name="kmCompteur" id="kmCompteur" />                  
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblNbPortes" for="nbPortes">Nombre de portes</label><br/>
                            <input class="form-control" type="text" name="nbPortes" id="nbPortes" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblMatricule" for="matricule">N° de matricule</label><br/>
                            <input class="form-control" type="text" name="matricule" id="matricule" />
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblMiseCirculation" for="miseCirculation">Première mise en circulation</label><br/>
                            <input class="form-control datepicker" type="text" name="miseCirculation" id="miseCirculation" />                  
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>  
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblPrixCatalogue" for="prixCatalogue">Prix catalogue</label><br/>
                            <input class="form-control" type="text" name="prixCatalogue" id="prixCatalogue" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="lblReceptionType" for="receptionType">Récéption par type</label><br/>
                            <input class="form-control" type="text" name="receptionType" id="receptionType" />
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4"></div>
                    <div class="clearfix"></div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h5 id="lblBoiteVitesse"><strong>Boite à vitesse</strong></h5>
                        <input type="radio" name="boiteVitesse" id="manuelle" value="manuelle" checked="checked" />&nbsp;&nbsp;<label for="manuelle">Boite manuelle</label><br/>
                        <input type="radio" name="boiteVitesse" id="automatique" value="automatique" />&nbsp;&nbsp;<label for="automatique">Boite automatique</label><br/>
                        <input type="radio" name="boiteVitesse" id="semiAutomatique" value="semiAutomatique" />&nbsp;&nbsp;<label for="semiAutomatique">Boite semi-automatique</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h5 id="lblCarburant"><strong>Carburant</strong></h5>
                        <input type="radio" name="carburant" id="essence" value="essence" checked="checked" />&nbsp;&nbsp;<label for="essence">Essence</label><br/>
                        <input type="radio" name="carburant" id="diesel" value="diesel" />&nbsp;&nbsp;<label for="diesel">Diesel</label><br/>
                        <input type="radio" name="carburant" id="electrique" value="electrique" />&nbsp;&nbsp;<label for="electrique">Electrique</label><br/>
                        <input type="radio" name="carburant" id="autre" value="autre" />&nbsp;&nbsp;<label for="autre">Autre</label>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h5 id="lblParking"><strong>Parking</strong></h5>
                        <input type="radio" name="parking" id="domicile" value="domicile" checked="checked" />&nbsp;&nbsp;<label for="manuelle">Parking à domicile</label><br/>
                        <input type="radio" name="parking" id="travaille" value="travaille" />&nbsp;&nbsp;<label for="automatique">Parking au travail</label><br/>
                        <input type="radio" name="parking" id="tous" value="tous" />&nbsp;&nbsp;<label for="semiAutomatique">Parking aux deux emplacements</label>                    
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4><strong>Couvertures souhaitées</strong></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>            
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <input type="checkbox" name="responsabiliteCivile" id="responsabiliteCivile" onchange="selectAssurance(this);" />&nbsp;&nbsp;<label id="lblResponsabiliteCivile" for="responsabiliteCivile">Responsabilité Civile</label><br/> 
                            <select class="form-control" name="franchiseResponsabiliteCivile" id="franchiseResponsabiliteCivile" disabled="disabled">
                                <option value="-1">- Veuillez sélectionner -</option>
                                <option value="Franchise à 0.-">Franchise à 0.-</option>
                                <option value="Franchise à 500.-">Franchise à 500.-</option>
                                <option value="Franchise à 1000 .-">Franchise à 1000 .-</option>
                            </select>               
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <input type="checkbox" name="cascoPartielle" id="cascoPartielle" onchange="selectAssurance(this);" />&nbsp;&nbsp;<label id="lblCascoPartielle" for="cascoPartielle">Casco Partielle</label><br/>
                            <select class="form-control" name="franchiseCascoPartielle" id="franchiseCascoPartielle" disabled="disabled">
                                <option value="-1">- Veuillez sélectionner -</option>
                                <option value="Franchise à 0.-">Franchise à 0.-</option>
                                <option value="Franchise à 500.-">Franchise à 500.-</option>
                                <option value="Franchise à 1000 .-">Franchise à 1000 .-</option>
                            </select>               
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group">
                            <input type="checkbox" name="cascoComplete" id="cascoComplete" onchange="selectAssurance(this);" />&nbsp;&nbsp;<label id="lblCascoComplete" for="cascoComplete">Casco Complète</label><br/>
                            <select class="form-control" name="franchiseCascoComplete" id="franchiseCascoComplete" disabled="disabled">
                                <option value="-1">- Veuillez sélectionner -</option>
                                <option value="Franchise à 0.-">Franchise à 0.-</option>
                                <option value="Franchise à 500.-">Franchise à 500.-</option>
                                <option value="Franchise à 1000 .-">Franchise à 1000 .-</option>
                            </select>               
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>                                 
                <hr/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4><strong>Couvertures complémentaires</strong></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="checkbox" name="protectionBonus" id="protectionBonus" />&nbsp;&nbsp;<label for="protectionBonus">Protection Bonus</label>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="checkbox" name="fauteGrave" id="fauteGrave" />&nbsp;&nbsp;<label for="fauteGrave">Protection faute grave</label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="checkbox" name="cascoParking" id="cascoParking" onchange="setDisabled('franchiseCascoParking');setDisplay('franchiseCascoParking')" />&nbsp;&nbsp;<label id="lblCascoParking" for="cascoParking">Casco Parking</label>&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <select class="form-control" name="franchiseCascoParking" id="franchiseCascoParking" disabled="disabled" style="display:none">
                            <option value="-1">- Veuillez sélectionner -</option>
                            <option value="Franchise à 0.-">Franchise à 0.-</option>
                            <option value="Franchise à 200.-">Franchise à 200.-</option>
                            <option value="Franchise à 300 .-">Franchise à 300 .-</option>
                        </select>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="checkbox" name="vol" id="vol" onchange="setDisabled('volMontant');setDisplay('volMontant')" />&nbsp;&nbsp;<label for="vol">Vol</label>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <select class="form-control" name="volMontant" id="volMontant" disabled="disabled" style="display:none">
                            <option value="-1">- Veuillez sélectionner -</option>
                            <option value="2000.-">2000.-</option>
                            <option value="3000.-">3000.-</option>
                            <option value="5000.-">5000.-</option>
                        </select>                    
                    </div>
                </div>                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="checkbox" name="brisGlace" id="brisGlace" />&nbsp;&nbsp;<label for="brisGlace">Bris de glace</label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="checkbox" name="protectionOccupants" id="protectionOccupants" />&nbsp;&nbsp;<label for="protectionOccupants">Protection occupants</label>
                    </div>
                    <div class="clearfix"></div>
                </div>                
                <hr/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4><strong>Informations complémentaires obligatoires</strong></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>             
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label id="lblSinistre">Sinistre au cours des 3 dernières années</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <input type="radio" name="sinistre" value="oui" id="sinistre" onchange="setDisabled('infoSinistre')" />&nbsp;&nbsp;<label>Oui</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="sinistre" value="non" checked="checked" onchange="setDisabled('infoSinistre')" />&nbsp;&nbsp;<label>Non</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="infoSinistre"><small>Si oui (Quand / Type de sinistre)</small></label><br/>
                        <textarea class="form-control" name="infoSinistre" id="infoSinistre" disabled="disabled"></textarea>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label id="lblRetrait">Retrait de permis au cours des 5 dernières années</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <input type="radio" name="retrait" value="oui" id="retrait" onchange="setDisabled('infoRetrait')" />&nbsp;&nbsp;<label>Oui</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="retrait" value="non"  onchange="setDisabled('infoRetrait')" checked="checked" />&nbsp;&nbsp;<label>Non</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="infoRetrait"><small>Si oui (Quand / Durée / Motif du retrait)</small></label><br/>
                        <textarea class="form-control" name="infoRetrait" id="infoRetrait" disabled="disabled"></textarea>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="submit" id="submit" value="Envoyer" class="btn btn-primary" />
                        <br/>
                        <br/>
                        <span id="error" class="error">Une erreur s'est produite, veuillez vérifier les champs en surbrillance.</span>
                    </div>
                    <div class="clearfix"></div>
                </div>            
            </form>
        </div>
        <script type="text/javascript" src="https://economies.ch/voitures/web/library/jquery-2.1.4/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="https://economies.ch/voitures/web/library/jquery-ui-1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://economies.ch/voitures/web/js/fonction.js"></script>
        <script type="text/javascript" src="https://economies.ch/voitures/web/js/app.js"></script>
    </body>
</html>
<?php
get_footer();
?>
