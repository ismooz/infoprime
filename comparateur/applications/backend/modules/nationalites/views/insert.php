            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'une nationalité</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name_de">Nom allemand</label>
                            <input type="text" name="name_de" id="name_de" />
                            <label for="name_en">Nom anglais</label>
                            <input type="text" name="name_en" id="name_en" />
                            <label for="name_fr">Nom français</label>
                            <input type="text" name="name_fr" id="name_fr" />
                            <label for="name_it">Nom italien</label>
                            <input type="text" name="name_it" id="name_it" class="input-default" /><br/><br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>