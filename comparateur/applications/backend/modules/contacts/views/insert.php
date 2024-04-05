            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'une demande de contact</div>
                    <div class="panel-body">
                        <form action="" method="post" id="contact">
                            <label for="nom">Nom<?php echo((isset($erreurs) && in_array(library\entities\contactEntity::INVALID_NOM, $erreurs))?' <span class="errors">Le nom est invalide.</span>':''); ?></label>
                            <input type="text" name="nom" id="nom" value="<?php echo(isset($contact)?$contact->getNom():''); ?>" />
                            <label for="email">Email<?php echo((isset($erreurs) && in_array(library\entities\contactEntity::INVALID_EMAIL, $erreurs))?' <span class="errors">L\'adresse email est invalide.</span>':''); ?></label>
                            <input type="text" name="email" id="email" value="<?php echo(isset($contact)?$contact->getEmail():''); ?>" />
                            <label for="commentaire">Commentaire<?php echo((isset($erreurs) && in_array(library\entities\contactEntity::INVALID_COMMENTAIRE, $erreurs))?' <span class="errors">Le commentaire est invalide.</span>':''); ?></label>
                            <textarea name="commentaire" id="commentaire" /><?php echo(isset($contact)?$contact->getCommentaire():''); ?></textarea>
                            <label for="etatId">Etat de la demande de contact</label>
                            <select name="etatId" id="etatId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($contactsEtats as $contactEtat):
        if(isset($contact) && $contactEtat->getId() == $contact->getEtatId()):
?>
                                <option value="<?php echo($contactEtat->getId()); ?>" selected="selected"><?php echo($contactEtat->getName()); ?></option>
<?php
        else:
?>
                                <option value="<?php echo($contactEtat->getId()); ?>"><?php echo($contactEtat->getName()); ?></option>
<?php
        endif;
    endforeach;
?>
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\contactEntity::INVALID_ETAT_ID, $erreurs))?' <span class="errors">L\'état de la demande de contact est invalide.</span>':''); ?>
                            <label for="typeId">Type de contact</label>
                            <select name="typeId" id="typeId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($contactsTypes as $contactType):
        if(isset($contact) && $contactType->getId() == $contact->getTypeId()):
?>
                                <option value="<?php echo($contactType->getId()); ?>" selected="selected"><?php echo($contactType->getName()); ?></option>
<?php
        else:
?>
                                <option value="<?php echo($contactType->getId()); ?>"><?php echo($contactType->getName()); ?></option>
<?php
        endif;
    endforeach;
?>
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\contactEntity::INVALID_TYPE_ID, $erreurs))?' <span class="errors">Le type de demande de contact est invalide.</span>':''); ?>
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