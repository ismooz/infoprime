            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'un utilisateur</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="login">Nom d'utilisateur *</label>
                            <input type="text" name="login" id="login" value="<?php echo(isset($utilisateur)?$utilisateur->getLogin():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_LOGIN, $erreurs))?' <span class="errors">Le nom d\'utilisateur est invalide.</span>':''); ?>
                            <label for="password">Mot de passe *</label>
                            <input type="text" name="password" id="password" value="<?php echo(isset($utilisateur)?$utilisateur->getPassword():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_PASSWORD, $erreurs))?' <span class="errors">Le mot de passe est invalide.</span>':''); ?>
                            <label for="passwordValidate">Mot de passe de validation *</label>
                            <input type="text" name="passwordValidate" id="passwordValidate" value="<?php echo(isset($utilisateur)?$utilisateur->getPasswordValidate():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_PASSWORD_VALIDATE, $erreurs))?' <span class="errors">Le mot de passe des validation est invalide.</span>':''); ?>
                            <label for="groupeId">Groupe d'utilisateur</label>
                            <select name="groupeId" id="groupeId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($utilisateursGroupes as $utilisateurGroupe):
        if(isset($utilisateur) && $utilisateur->getUtilisateurGroupeId() == $utilisateurGroupe->getId()):
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
                            <label>Etat</label>
                            <div class="slide">	
                                <input type="checkbox" id="state" name="state"<?php echo(isset($utilisateur)?$utilisateur->getState()?' checked="checked"':'':' checked="checked"'); ?> />    
                                <label class="button" for="state"></label>
                            </div>                        
                            <br/>
                            <br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_EXISTING_LOGIN, $erreurs))?' <span class="errors">L\'utilisateur existe déjà.</span>':''); ?>
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>