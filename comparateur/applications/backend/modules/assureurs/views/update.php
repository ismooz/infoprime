            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'un assureur</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name_de" value="<?php echo($assureur->getName()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\assureurEntity::INVALID_NAME, $erreurs))?' <span class="errors">L\'assureur est invalide.</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($assureur->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($assureur->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($assureur->getDateModification()->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <p>Date de création : <?php echo($assureur->getDateCreation()->format('d/m/Y à H\hi')); ?></p>
                        <p>Date de modification : <?php echo($assureur->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>