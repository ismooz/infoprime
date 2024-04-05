            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'un type de demande de contact</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="nom" value="<?php echo(isset($contactType)?$contactType->getName():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\contactTypeEntity::INVALID_NAME, $erreurs))?' <span class="errors">Le type de demande de contact est invalide.</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\contactTypeEntity::INVALID_EXISTING_NAME, $erreurs))?' <span class="errors">Ce type existe déjà.</span>':''); ?>
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>