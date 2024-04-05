            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'un état demande de contact</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name" value="<?php echo(isset($contactEtat)?$contactEtat->getName():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientStatusEntity::INVALID_NAME, $erreurs))?' <span class="errors">L\'état demande de contact est invalide.</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientStatusEntity::INVALID_EXISTING_NAME, $erreurs))?' <span class="errors">Le nom de l\'état existe déjà.</span>':''); ?>
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>