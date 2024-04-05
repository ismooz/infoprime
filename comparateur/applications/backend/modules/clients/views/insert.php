            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'un client</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="civiliteId">Civilité</label>
                            <select name="civiliteId" id="civiliteId" title="Sélectionner une civilité.">
                                <option value="-1">- Veuillez sélectionner -</option>
                                <option value="1"<?php echo(isset($client) && $client->getCiviliteId() == 1?'selected="selected"':''); ?>>Madame</option>
                                <option value="2"<?php echo(isset($client) && $client->getCiviliteId() == 2?'selected="selected"':''); ?>>Monsieur</option>
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_CIVILITE_ID, $erreurs))?' <span class="errors">La civilité est invalide.</span>':''); ?>
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" value="<?php echo(isset($client)?$client->getNom():''); ?>" title="Insérer un nom." />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_NOM, $erreurs))?' <span class="errors">Le nom est invalide.</span>':''); ?>
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" id="prenom" value="<?php echo(isset($client)?$client->getPrenom():''); ?>" title="Insérer un prénom" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_PRENOM, $erreurs))?' <span class="errors">Le prénom est invalide.</span>':''); ?>
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" value="<?php echo(isset($client)?$client->getAdresse():''); ?>" title="Insérer une adresse" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_ADRESSE, $erreurs))?' <span class="errors">L\'adresse est invalide.</span>':''); ?>
                            <label for="npa">Numéro postal</label>
                            <input type="text" name="npa" id="npa" value="<?php echo(isset($client)?$client->getNpa():''); ?>" title="Insérer un numéro postal" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_NPA, $erreurs))?' <span class="errors">Le numéro postal est invalide.</span>':''); ?>
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" value="<?php echo(isset($client)?$client->getVille():''); ?>" title="Insérer une ville" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_VILLE, $erreurs))?' <span class="errors">La ville est invalide.</span>':''); ?>
                            <label for="telephone">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" value="<?php echo(isset($client)?$client->getTelephone():''); ?>" title="Insérer un téléphone" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_TELEPONE, $erreurs))?' <span class="errors">Le téléphone est invalide.</span>':''); ?>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo(isset($client)?$client->getEmail():''); ?>" title="Insérer une adresse email" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientEntity::INVALID_EMAIL, $erreurs))?' <span class="errors">L\'adresse email est invalide.</span>':''); ?>
                            <label for="langueCorrespondanceId">Langue de correspondance</label>
                            <select name="langueCorrespondanceId" id="langueCorrespondanceId" title="Sélectionner une langue de correspondance">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($langues as $langue):
        if(isset($client) && $client->getLangueCorrespondanceId() == $langue->getId()):
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
                            <select name="nationaliteId" id="nationaliteId" title="Sélectionner une nationalité">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($nationalites as $nationalite):
        if(isset($client) && $client->getNationaliteId() == $nationalite->getId()):
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
                            <input type="text" name="dateNaissance" id="datepicker" value="<?php echo(isset($client)?$client->getDateNaissance()->format('d/m/Y'):''); ?>" title="Insérer une date de naissance" />
                            <label for="statusId">Status</label>
                            <select name="statusId" id="statusId" title="Sélectionner un status">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($clientsStatus as $clientStatus):
        if(isset($client) && $client->getStatusId() == $clientStatus->getId()):
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
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>