            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'une langue</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name_de">Nom allemand</label>
                            <input type="text" name="name_de" id="name_de" value="<?php echo($langue->getNameDe()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\langueEntity::INVALID_NAME_DE, $erreurs))?' <span class="errors">La langue en allemand est invalide.</span>':''); ?>
                            <label for="name_en">Nom anglais</label>
                            <input type="text" name="name_en" id="name_en" value="<?php echo($langue->getNameEn()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\langueEntity::INVALID_NAME_EN, $erreurs))?' <span class="errors">La langue en anglais est invalide.</span>':''); ?>
                            <label for="name_fr">Nom français</label>
                            <input type="text" name="name_fr" id="name_fr" value="<?php echo($langue->getNameFr()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\langueEntity::INVALID_NAME_FR, $erreurs))?' <span class="errors">La langue en français est invalide.</span>':''); ?>
                            <label for="name_it">Nom italien</label>
                            <input type="text" name="name_it" id="name_it" value="<?php echo($langue->getNameIt()); ?>" /><br/><br/>
                            <?php echo((isset($erreurs) && in_array(library\entities\langueEntity::INVALID_NAME_IT, $erreurs))?' <span class="errors">La langue en italien est invalide.</span>':''); ?>
                            <input type="hidden" name="id" value="<?php echo($langue->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($langue->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($langue->getDateModification()->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <p>Date de création : <?php echo($langue->getDateCreation()->format('d/m/Y à H\hi')); ?></p>
                        <p>Date de modification : <?php echo($langue->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>