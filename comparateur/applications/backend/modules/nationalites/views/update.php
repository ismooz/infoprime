            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'une nationalité</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name_de">Nom allemand</label>
                            <input type="text" name="name_de" id="name_de" value="<?php echo($nationalite->getNameDe()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\nationaliteEntity::INVALID_NAME_DE, $erreurs))?' <span class="errors">La nationalité (Allemand) est invalide.</span>':''); ?>
                            <label for="name_en">Nom anglais</label>
                            <input type="text" name="name_en" id="name_en" value="<?php echo($nationalite->getNameEn()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\nationaliteEntity::INVALID_NAME_EN, $erreurs))?' <span class="errors">La nationalité (Anglais) est invalide.</span>':''); ?>
                            <label for="name_fr">Nom français</label>
                            <input type="text" name="name_fr" id="name_fr" value="<?php echo($nationalite->getNameFr()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\nationaliteEntity::INVALID_NAME_FR, $erreurs))?' <span class="errors">La nationalité (Français) est invalide.</span>':''); ?>
                            <label for="name_it">Nom italien</label>
                            <input type="text" name="name_it" id="name_it" value="<?php echo($nationalite->getNameIt()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\nationaliteEntity::INVALID_NAME_IT, $erreurs))?' <span class="errors">La nationalité (Italien) est invalide.</span>':''); ?>
                            <br/><br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <p>Date de création : <?php echo($nationalite->getDateCreation()->format('d/m/Y à H\hi')); ?></p>
                        <p>Date de modification : <?php echo($nationalite->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>