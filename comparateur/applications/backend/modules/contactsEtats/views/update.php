            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'un état demande de contact</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name" value="<?php echo($contactEtat->getName()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\contactEtatEntity::INVALID_NAME, $erreurs))?' <span class="errors">L\'état demande de contact est invalide.)</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($contactEtat->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($contactEtat->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($contactEtat->getDateModification()->getTimestamp()); ?>" />                        
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <br/>
                        <p>
                            Date de création : <?php echo($contactEtat->getDateCreation()->format('d/m/Y à H\hi')); ?>
                            <br/>
                            Date de modification : <?php echo($contactEtat->getDateModification()->format('d/m/Y à H\hi')); ?>
                        </p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>