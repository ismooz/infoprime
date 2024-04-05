            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'une demande de contact</div>
                    <div class="panel-body">
                        <form action="" method="post" id="contact">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" value="<?php echo($contact->getNom()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\contactStatusEntity::INVALID_NAME, $erreurs))?' <span class="errors">Le nom du contact est invalide.)</span>':''); ?>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo($contact->getEmail()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\contactStatusEntity::INVALID_EMAIL, $erreurs))?' <span class="errors">L\'adresse email du contact est invalide.)</span>':''); ?>
                            <label for="commentaire">Commentaire</label>
                            <textarea name="commentaire" id="commentaire"><?php echo($contact->getCommentaire()); ?></textarea>
                            <?php echo((isset($erreurs) && in_array(library\entities\contactStatusEntity::INVALID_COMMENTAIRE, $erreurs))?' <span class="errors">Le commentaire du contact est invalide.)</span>':''); ?>
                            <label for="etatId">Etat de la demande de contact</label>
                            <select name="etatId" id="etatId">
                                <option>- Veuillez sélectionner -</option>
<?php
    foreach($contactsEtats as $contactEtat):
        if($contactEtat->getId() == $contact->getEtatId()):
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
                            <?php echo((isset($erreurs) && in_array(library\entities\contactStatusEntity::INVALID_ETAT_ID, $erreurs))?' <span class="errors">L\'état du contact est invalide.)</span>':''); ?>
                            <label for="typeId">Type de contact</label>
                            <select name="typeId" id="typeId">
                                <option>- Veuillez sélectionner -</option>
<?php
    foreach($contactsTypes as $contactType):
        if($contactType->getId() == $contact->getTypeId()):
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
                            <?php echo((isset($erreurs) && in_array(library\entities\contactStatusEntity::INVALID_TYPE_ID, $erreurs))?' <span class="errors">Le type du contact est invalide.)</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($contact->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />                        
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <p>Date de création : <?php echo($contact->getDateCreation()->format('d/m/Y à H\hi')); ?></p>
                        <p>Date de modification : <?php echo($contact->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>