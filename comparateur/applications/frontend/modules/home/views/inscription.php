            <div class="container-fluid economies-blue">
                <div class="container">
                    <div class="row">
                        <h3 class="txt-white">Inscription</h3>
                        <form id="inscription" action="" method="post" enctype="multipart/form-data">
                            <fieldset class="col-md-12 col-ms-12">
                                <label for="login">Nom d'utilisateur</label>
                                <input type="text" name="login" id="login" value="<?php echo(isset($userEntity)?$userEntity->getLogin():''); ?>" title="Insérer votre nom d'utilisateur." />
                                <?php echo((isset($erreursUser) && in_array(library\entities\utilisateurEntity::INVALID_LOGIN, $erreursUser))?' <span class="errors">Le nom d\'utilisateur est invalide.</span>':''); ?>
                                <label for="password">Mot de passe</label>
                                <input type="password" name="password" id="password" value="<?php echo(isset($userEntity)?$userEntity->getPassword():''); ?>" title="Insérer votre mot de passe." />
                                <?php echo((isset($erreursUser) && in_array(library\entities\utilisateurEntity::INVALID_PASSWORD, $erreursUser))?' <span class="errors">Le mot de passe est invalide.</span>':''); ?>
                                <label for="passwordValidate">Vérification du mot de passe</label>
                                <input type="password" name="passwordValidate" id="passwordValidate" value="<?php echo(isset($userEntity)?$userEntity->getPasswordValidate():''); ?>" title="Insérer votre mot de passe (pour vérification)." />
                                <?php echo((isset($erreursUser) && in_array(library\entities\utilisateurEntity::INVALID_PASSWORD_VALIDATE, $erreursUser))?' <span class="errors">Le mot de passe de vérification est invalide.</span>':''); ?>
                                <hr class="white"/>
                            </fieldset>
                            <fieldset class="col-md-3 col-sm-3">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" value="<?php echo(isset($clientEntity)?$clientEntity->getNom():''); ?>" title="Insérer votre nom." />
                                <?php echo((isset($erreursClient) && in_array(library\entities\clientEntity::INVALID_NOM, $erreursClient))?' <span class="errors">Le nom est invalide.</span>':''); ?>
                                <label for="adresse">Adresse</label>
                                <input type="text" name="adresse" id="adresse" value="<?php echo(isset($clientEntity)?$clientEntity->getAdresse():''); ?>" title="Insérer votre adresse." />
                                <?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_ADRESSE, $erreursClient)?'<span class="errors">L\'adresse est invalide.</span>':''); ?>
                                <label for="telephone">Téléphone</label>
                                <input type="text" name="telephone" id="telephone" value="<?php echo(isset($clientEntity)?$clientEntity->getTelephone():''); ?>" title="Insérer votre téléphone." />
                                <?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_TELEPONE, $erreursClient)?'<span class="errors">Le téléphone est invalide.</span>':''); ?>                                        
                            </fieldset>
                            <fieldset class="col-md-3 col-sm-3">
                                <label for="prenom">Prénom</label>
                                <input type="text" name="prenom" id="prenom" value="<?php echo(isset($clientEntity)?$clientEntity->getPrenom():''); ?>" title="Insérer votre prénom." />
                                <?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_PRENOM, $erreursClient)?'<span class="errors">Le prénom est invalide.</span>':''); ?>
                                <label for="npa">Numéro postal</label>
                                <input type="text" name="npa" id="npa" value="<?php echo(isset($clientEntity)?$clientEntity->getNpa():''); ?>" title="Insérer votre numéro postal." />
                                <?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_NPA, $erreursClient)?'<span class="errors">Le numéro postal est invalide.</span>':''); ?>
                                <label for="image">Image</label>
                                <input type="file" accept="image/png, image/jpg, image/gif" name="image" id="image" value="<?php echo(isset($clientEntity)?$clientEntity->getImage():''); ?>" title="Insérer votre image." />
                                <?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_IMAGE, $erreursClient)?'<span class="errors">L\'image est invalide.</span>':''); ?>                                        
                            </fieldset>
                            <fieldset class="col-md-3 col-sm-3">
                                <label for="datepicker">Date de naissance</label>
                                <input type="text" name="dateNaissance" id="datepicker" value="<?php echo(isset($clientEntity)?$clientEntity->getDateNaissance()->format('d/m/Y'):''); ?>" title="Insérer votre date de naissance." />
                                <?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_DATE_NAISSANCE, $erreursClient)?'<span class="errors">La date de naissance est invalide.</span>':''); ?>                                      
                                <label for="ville">Ville</label>
                                <input type="text" name="ville" id="ville" value="<?php echo(isset($clientEntity)?$clientEntity->getVille():''); ?>" title="Insérer votre ville." />
                                <?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_VILLE, $erreursClient)?'<span class="errors">La ville est invalide.</span>':''); ?>
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="<?php echo(isset($clientEntity)?$clientEntity->getEmail():''); ?>" title="Insérer votre email." />
                                <?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_EMAIL, $erreursClient)?'<span class="errors">L\'email est invalide.</span>':''); ?>

                            </fieldset>
                            <fieldset class="col-md-3 col-sm-3">
                                <label for="langueCorrespondanceId">Langue de correspondance</label>
                                <select name="langueCorrespondanceId" id="langueCorrespondanceId" title="Sélectionner votre langue de correspondance.">
                                    <option value="-1">- Veuillez sélectionner -</option>
<?php
// Parcours les langues
foreach($langues as $langue):
    if(isset($clientEntity) && $clientEntity->getLangueCorrespondanceId() == $langue->getId()):
?>
                                    <option value="<?php echo($langue->getId()); ?>" selected="selected"><?php echo($langue->getNameFr()); ?></option>
<?php
    else:
?>
                                    <option value="<?php echo($langue->getId()); ?>"><?php echo($langue->getNameFr()); ?></option>
<?php
    endIf;
endforeach;
?>
                                </select><?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_LANGUE_CORRESPONDANCE_ID, $erreursClient)?'<span class="errors">La langue de correspondance est invalide.</span>':''); ?>
                                <label for="nationaliteId">Nationalité</label>
                                <select name="nationaliteId" id="nationaliteId" title="Sélectionner votre mationalité.">
                                    <option value="-1">- Veuillez sélectionner -</option>
<?php
// Parcours les langues
foreach($nationalites as $nationalite):
    if(isset($clientEntity) && $clientEntity->getNationaliteId() == $nationalite->getId()):
?>
                                    <option value="<?php echo($nationalite->getId()); ?>" selected="selected"><?php echo($nationalite->getNameFr()); ?></option>
<?php
    else:
?>
                                    <option value="<?php echo($nationalite->getId()); ?>"><?php echo($nationalite->getNameFr()); ?></option>
<?php
    endIf;
endforeach;
?>
                                </select><?php echo(isset($erreursClient) && in_array(\library\entities\clientEntity::INVALID_NATIONALITE_ID, $erreursClient)?'<span class="errors">La nationalité est invalide.</span>':''); ?>
                                <input type="submit" value="Envoyer" class="btn btn-default btn-theme-default" />
                            </fieldset>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
            </div>