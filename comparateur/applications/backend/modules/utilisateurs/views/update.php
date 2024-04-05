            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'un utilisateur</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="login">Nom d'utilisateur</label>
                            <input type="text" name="login" id="login" value="<?php echo($utilisateur->getLogin()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_LOGIN, $erreurs))?' <span class="errors">(Le nom d\'utilisateur est invalide.)</span>':''); ?>
                            <label for="password">Mot de passe</label>
                            <input type="text" name="password" id="password" value="<?php echo($utilisateur->getPassword()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_PASSWORD, $erreurs))?' <span class="errors">Le mot de passe est invalide.</span>':''); ?>
                            <label for="passwordValidate">Mot de passe de validation</label>
                            <input type="text" name="passwordValidate" id="passwordValidate" value="<?php echo($utilisateur->getPasswordValidate()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_PASSWORD_VALIDATE, $erreurs))?' <span class="errors">Le mot de passe de validation est invalide.</span>':''); ?>
                            <label for="groupeId">Groupe d'utilisateur</label>
                            <select name="groupeId" id="groupeId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($utilisateursGroupes as $utilisateurGroupe):
        if($utilisateur->getUtilisateurGroupeId() == $utilisateurGroupe->getId()):
?>
                                <option value="<?php echo($utilisateurGroupe->getId()); ?>" selected="selected"><?php echo($utilisateurGroupe->getName()); ?></option>
<?php
        else:
?>
                                <option value="<?php echo($utilisateurGroupe->getId()); ?>"><?php echo($utilisateurGroupe->getName()); ?></option>
<?php
        endif;
    endforeach;
?>
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_GROUPE_ID, $erreurs))?' <span class="errors">Le groupe d\'utilisateur est invalide.</span>':''); ?>
                            <label>Activation</label>
                            <div class="slide">	
                                <input type="checkbox" id="state" name="state"<?php echo($utilisateur->getState()?' checked="checked"':''); ?> />    
                                <label class="button" for="state"></label>
                            </div>                        
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($utilisateur->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($utilisateur->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($utilisateur->getDateModification()->getTimestamp()); ?>" />                        
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <br/>
                        <p>
                            Date de création : <?php echo($utilisateur->getDateCreation()->format('d/m/Y à H\hi')); ?>
                            <br/>
                            Date de modification : <?php echo($utilisateur->getDateModification()->format('d/m/Y à H\hi')); ?>
                        </p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>