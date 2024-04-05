            <div class="box box-default box-theme-default">
                <div class="box-header">Mot de passe oublié</div>
                <div class="box-body">
                    <form action="" method="post" id="forgot">
                        <label for="login">Nom d'utilisateur</label>
                        <input type="text" name="login" id="login" title="Insérer votre nom d'utilisateur." />
                        <?php echo(isset($erreurs) && in_array(library\entities\userEntity::INVALID_LOGIN, $erreurs)?'<span class="errors">Le nom d\'utilisateur est incorrect.</span>':''); ?>
                        <br/>
                        <br/>
                        <input type="submit" value="Envoyer" class="btn btn-default btn-theme-default" />
                    </form>
                </div>
                <div class="box-footer"></div>
            </div>