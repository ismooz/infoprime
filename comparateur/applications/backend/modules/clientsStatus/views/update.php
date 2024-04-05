            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'un status client</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name" value="<?php echo($clientStatus->getName()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\clientStatusEntity::INVALID_NAME, $erreurs))?' <span class="errors">Le nom du status client est invalide.)</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($clientStatus->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($clientStatus->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($clientStatus->getDateModification()->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <br/>
                        <p>
                            Date de création : <?php echo($clientStatus->getDateCreation()->format('d/m/Y à H\hi')); ?>
                            <br/>
                            Date de modification : <?php echo($clientStatus->getDateModification()->format('d/m/Y à H\hi')); ?>
                        </p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>