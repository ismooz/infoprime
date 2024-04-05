            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'un client</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="civiliteId">Civilité</label>
                            <select name="civiliteId" id="civiliteId">
                                <option value="-1">- Veuillez sélectionner -</option>
                                <option value="1"<?php echo(isset($client) && $client->getCiviliteId() == 1?' selected="selected"':'') ?>>Madame</option>
                                <option value="2"<?php echo(isset($client) && $client->getCiviliteId() == 2?' selected="selected"':'') ?>>Monsieur</option>
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_CIVILITE_ID, $erreurs))?' <span class="errors">La civilité est invalide.</span>':''); ?>
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" value="<?php echo($client->getNom()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_NOM, $erreurs))?' <span class="errors">Le nom est invalide.</span>':''); ?>
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" id="prenom" value="<?php echo($client->getPrenom()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_PRENOM, $erreurs))?' <span class="errors">Le prénom est invalide.</span>':''); ?>
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" value="<?php echo($client->getAdresse()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_ADRESSE, $erreurs))?' <span class="errors">L\'adresse est invalide.</span>':''); ?>
                            <label for="npa">Numéro postal</label>
                            <input type="text" name="npa" id="npa" value="<?php echo($client->getNpa()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_NPA, $erreurs))?' <span class="errors">Le numéro postale est invalide.</span>':''); ?>
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" value="<?php echo($client->getVille()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_VILLE, $erreurs))?' <span class="errors">La ville est invalide.</span>':''); ?>
                            <label for="telephone">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" value="<?php echo($client->getTelephone()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_TELEPONE, $erreurs))?' <span class="errors">Le téléphone est invalide.</span>':''); ?>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo($client->getEmail()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_EMAIL, $erreurs))?' <span class="errors">L\'email est invalide.</span>':''); ?>
                            <label for="langueCorrespondanceId">Langue de correspondance</label>
                            <select name="langueCorrespondanceId" id="langueCorrespondanceId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php

foreach($langues as $langue):
    if($langue->getId() == $client->getLangueCorrespondanceId()):
?>
                                <option value="<?php echo($langue->getId()); ?>" selected="selected"><?php echo($langue->getNameFr()); ?></option>
<?php
    else:
?>
                                <option value="<?php echo($langue->getId()); ?>"><?php echo($langue->getNameFr()); ?></option>                            
<?php
    endif;
endforeach;
?>                            
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_LANGUE_CORRESPONDANCE_ID, $erreurs))?' <span class="errors">La langue de correspondance est invalide.</span>':''); ?>
                            <label for="nationaliteId">Nationalité</label>
                            <select name="nationaliteId" id="nationaliteId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php

foreach($nationalites as $nationalite):
    if($nationalite->getId() == $client->getNationaliteId()):
?>
                                <option value="<?php echo($nationalite->getId()); ?>" selected="selected"><?php echo($nationalite->getNameFr()); ?></option>
<?php
    else:
?>
                                <option value="<?php echo($nationalite->getId()); ?>"><?php echo($nationalite->getNameFr()); ?></option>                            
<?php
    endif;
endforeach;
?>                            
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_NATIONALITE_ID, $erreurs))?' <span class="errors">La nationalité est invalide.</span>':''); ?>
                            <label for="dateNaissance">Date de naissance (24/12/2000)</label>
                            <input type="text" name="dateNaissance" id="datepicker" value="<?php echo($client->getDateNaissance()->format('d/m/Y')); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_DATE_NAISSANCE, $erreurs))?' <span class="errors">La date de naissance est invalide.</span>':''); ?>
                            <label for="statusId">Status</label>
                            <select name="statusId" id="statusId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($clientsStatus as $clientStatus):
        if(isset($clientStatus) && $clientStatus->getId() == $client->getStatusId()):
?>
                                <option value="<?php echo($clientStatus->getId()); ?>" selected="selected"><?php echo($clientStatus->getName()); ?></option>
<?php
        else:
?>
                                <option value="<?php echo($clientStatus->getId()); ?>"><?php echo($clientStatus->getName()); ?></option>
<?php
        endif;
    endforeach;
?>                            
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_STATUS_ID, $erreurs))?' <span class="errors">Le status est invalide.</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($client->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($client->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($client->getDateModification()->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <br/>
                        <p>
                            Date de création : <?php echo($client->getDateCreation()->format('d/m/Y à H\hi')); ?>
                            <br/>
                            Date de modification : <?php echo($client->getDateModification()->format('d/m/Y à H\hi')); ?>
                        </p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>