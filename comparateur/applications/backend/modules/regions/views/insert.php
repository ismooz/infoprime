            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insértion d'une région</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="npa">NPA</label>
                            <input type="text" name="npa" id="npa" />
                            <label for="localite">Localité</label>
                            <input type="text" name="localite" id="localite" />
                            <label for="canton">Canton</label>
                            <input type="text" name="canton" id="canton" />
                            <label for="region">Région</label>
                            <input type="text" name="region" id="region" />
                            <label for="no_ofs">Numéro OFS</label>
                            <input type="text" name="no_ofs" id="no_ofs" />
                            <label for="commune">Commune</label>
                            <input type="text" name="commune" id="commune" />
                            <label for="district">District</label>
                            <input type="text" name="district" id="district" /><br/><br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <inout type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>