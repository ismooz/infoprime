            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insértion d'un assureur</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name" value="<?php echo(isset($assureur)?$assureur->getName():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\assureurEntity::INVALID_NAME, $erreurs))?' <span class="errors">Le nom de l\'assureur est invalide.</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\assureurEntity::INVALID_EXISTING_NAME, $erreurs))?' <span class="errors">L\'assureur existe déjà.</span>':''); ?>
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>