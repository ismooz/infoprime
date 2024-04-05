            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Mot de passe oublié</div>
                    <div class="panel-body">
                        <form action="" method="post" id="forgot">
                            <label for="login">Nom d'utilisateur</label>
                            <input type="text" name="login" id="login" value="<?php echo(isset($userEntity)?$userEntity->getLogin():''); ?>" title="Insérer votre nom d'utilisateur." />
                            <?php echo(isset($erreurs) && in_array(library\entities\utilisateurEntity::INVALID_LOGIN, $erreurs)?'<span class="erreur">Le nom d\'utilisateur est incorrect.</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="submit" value="Envoyer" class="btn btn-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>