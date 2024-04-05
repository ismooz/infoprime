            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'un conseiller</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" title="Insérer un nom" />
                            <?php echo((isset($erreurs) && in_array(library\entities\conseillerEntity::INVALID_NOM, $erreurs))?' <span class="errors">Le nom est invalide.</span>':''); ?>
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" id="prenom" title="Insérer un prénom" />
                            <?php echo((isset($erreurs) && in_array(library\entities\conseillerEntity::INVALID_PRENOM, $erreurs))?' <span class="errors">Le pérnom est invalide.</span>':''); ?>
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" title="Insérer une adresse" />
                            <?php echo((isset($erreurs) && in_array(library\entities\conseillerEntity::INVALID_ADRESSE, $erreurs))?' <span class="errors">L\'adresse est invalide.</span>':''); ?>
                            <label for="npa">Numéro postal</label>
                            <input type="text" name="npa" id="npa" title="Insérer un numéro postal" />
                            <?php echo((isset($erreurs) && in_array(library\entities\conseillerEntity::INVALID_NPA, $erreurs))?' <span class="errors">Le numéro postal est invalide.</span>':''); ?>
                            <label for="ville">ville</label>
                            <input type="text" name="ville" id="ville" title="Unsérer une ville" />
                            <?php echo((isset($erreurs) && in_array(library\entities\conseillerEntity::INVALID_VILLE, $erreurs))?' <span class="errors">La ville est invalide.</span>':''); ?>
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