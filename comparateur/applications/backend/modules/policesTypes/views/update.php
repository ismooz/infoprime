            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'un type de police</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="nom" value="<?php echo($policeType->getName()); ?>" title="Insérer un nom" />
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($policeType->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                        <p>Date de création : <?php echo($policeType->getDateCreation()->format('d/m/Y à H\hi')); ?></p>
                        <p>Date de modification : <?php echo($policeType->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>