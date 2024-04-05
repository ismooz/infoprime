            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'un conseiller</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" value="<?php echo($conseiller->getNom()); ?>" title="Insérer un nom" />
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" id="prenom" value="<?php echo($conseiller->getPrenom()); ?>" title="Insérer un prénom" />
                            <label for="adresse">Adresse</label>
                            <input type="text" name="adresse" id="adresse" value="<?php echo($conseiller->getAdresse()); ?>" title="Insérer une adresse" />
                            <label for="npa">Numéro postal</label>
                            <input type="text" name="npa" id="npa" value="<?php echo($conseiller->getNpa()); ?>" title="Insérer un numéro postal" />
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" value="<?php echo($conseiller->getVille()); ?>" title="Insérer une ville" />
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($conseiller->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($conseiller->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($conseiller->getDateModification()->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                        <p>Date de création : <?php echo($conseiller->getDateCreation()->format('d/m/Y à H\hi')) ?></p>
                        <p>Date de modification : <?php echo($conseiller->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>