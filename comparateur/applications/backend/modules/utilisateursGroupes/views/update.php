            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'un groupe d'utilisateurs</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name" value="<?php echo($utilisateurGroupe->getName()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\utilisateurGroupeEntity::INVALID_NAME, $erreurs))?' <span class="errors">Le groupe d\'utilisateurs est invalide.)</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($utilisateurGroupe->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($utilisateurGroupe->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($utilisateurGroupe->getDateModification()->getTimestamp()); ?>" />                        
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <br/>
                        <p>
                            Date de création : <?php echo($utilisateurGroupe->getDateCreation()->format('d/m/Y à H\hi')); ?>
                            <br/>
                            Date de modification : <?php echo($utilisateurGroupe->getDateModification()->format('d/m/Y à H\hi')); ?>
                        </p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>