            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insértion d'une langue</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name_de">Nom allemand</label>
                            <input type="text" name="name_de" id="name_de" value="<?php echo(isset($langue)?$langue->getNameDe():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\langueEntity::INVALID_NAME_DE, $erreurs))?' <span class="errors">La langue en allemand est invalide.</span>':''); ?>
                            <label for="name_en">Nom anglais</label>
                            <input type="text" name="name_en" id="name_en" value="<?php echo(isset($langue)?$langue->getNameEn():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\langueEntity::INVALID_NAME_EN, $erreurs))?' <span class="errors">La langue en anglais est invalide.</span>':''); ?>
                            <label for="name_fr">Nom français</label>
                            <input type="text" name="name_fr" id="name_fr" value="<?php echo(isset($langue)?$langue->getNameFr():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\langueEntity::INVALID_NAME_FR, $erreurs))?' <span class="errors">La langue en français est invalide.</span>':''); ?>
                            <label for="name_it">Nom italien</label>
                            <input type="text" name="name_it" id="name_it" value="<?php echo(isset($langue)?$langue->getNameIt():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\langueEntity::INVALID_NAME_IT, $erreurs))?' <span class="errors">La langue en italien est invalide.</span>':''); ?>
                            <br/>
                            <br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>