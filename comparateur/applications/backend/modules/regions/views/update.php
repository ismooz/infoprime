            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'une région</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="npa">NPA</label>
                            <input type="text" name="npa" id="npa" value="<?php echo($region->getNpa()); ?>" />
                            <label for="localite">Localité</label>
                            <input type="text" name="localite" id="localite" value="<?php echo($region->getLocalite()); ?>" />
                            <label for="canton">Canton</label>
                            <input type="text" name="canton" id="canton" value="<?php echo($region->getCanton()); ?>" />
                            <label for="region">Région</label>
                            <input type="text" name="region" id="region" value="<?php echo($region->getRegion()); ?>" />
                            <label for="no_ofs">Numéro OFS</label>
                            <input type="text" name="no_ofs" id="no_ofs" value="<?php echo($region->getNoOfs()); ?>" />
                            <label for="commune">Commune</label>
                            <input type="text" name="commune" id="commune" value="<?php echo($region->getCommune()); ?>" />
                            <label for="district">District</label>
                            <input type="text" name="district" id="district" value="<?php echo($region->getDistrict()); ?>" /><br/><br/>
                            <input type="hidden" name="id" value="<?php echo($region->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($region->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($region->getDateModification()->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                        <p>Date de création : <?php echo($region->getDateCreation()->format('d/m/Y à H\hi')); ?></p>
                        <p>Date de modification : <?php echo($region->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>