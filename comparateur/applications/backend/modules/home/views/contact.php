            <div class="box box-default box-theme-default">
                <div class="box-header">Formulaire de contact</div>
                <div class="box-body">
                    <form action="" method="post" id="contact">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" value="<?php echo(isset($contactEntity)?$contactEntity->getNom():''); ?>" title="Insérer votre nom." />
                        <?php echo((isset($erreurs) && in_array(library\entities\contactEntity::INVALID_NOM, $erreurs))?' <span class="errors">Le nom est invalide.</span>':''); ?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo(isset($contactEntity)?$contactEntity->getEmail():''); ?>" title="Insérer votre adresse email." />
                        <?php echo((isset($erreurs) && in_array(library\entities\contactEntity::INVALID_EMAIL, $erreurs))?' <span class="errors">L\'email est invalide.</span>':''); ?>
                        <label for="commentaire">Commentaire</label>
                        <textarea name="commentaire" id="commentaire" title="Insérer votre commentaire."><?php echo(isset($contactEntity)?$contactEntity->getCommentaire():''); ?></textarea>
                        <?php echo((isset($erreurs) && in_array(library\entities\contactEntity::INVALID_COMMENTAIRE, $erreurs))?' <span class="errors">Le commentaire est invalide.</span>':''); ?>
                        <br/>
                        <br/>
                        <input type="submit" value="Envoyer" class="btn btn-default btn-theme-default" />
                    </form>
                </div>
                <div class="box-footer"></div>
            </div>