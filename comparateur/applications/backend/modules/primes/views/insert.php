            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'une prime</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="assureurId">Assureur</label>
                            <select name="assureurId" id="assureurId">
                                <option value="-1">- Veuillez sélectionner</option>
<?php
    foreach($assureurs as $assureur):
        if(isset($prime) && $pime->getAssureurId() == $assureur->getId()):
?>
                                <option value="<?php echo($assureur->getId()); ?>" selected="selected"><?php echo(ucfirst(strtolower($assureur->getName()))); ?></option>
<?php
        else:
?>
                                <option value="<?php echo($assureur->getId()); ?>"><?php echo(ucfirst(strtolower($assureur->getName()))); ?></option>
<?php
        endif;
    endforeach;
?>
                            </select>
                            <label for="canton">Canton</label>
                            <input type="text" name="canton" id="canton" title="Insérer un canton" />
                            <label for="exercice">Exercice</label>
                            <input type="text" name="exercice" id="exercice" />
                            <label for="enquete">Enquête</label>
                            <input type="text" name="enquete" id="enquete" title="Insérer une enquête" />
                            <label for="enquete">region</label>
                            <input type="text" name="region" id="region" title="Insérer une région" />
                            <label for="classeAge">Classe d'age</label>
                            <input type="text" name="classeAge" id="classeAge" title="Insérer une classe d'age" />
                            <label for="accident">Accident</label>
                            <input type="text" name="accident" id="accident" title="Insérer un accident" />
                            <label for="tarif">Tarif</label>
                            <input type="text" name="tarif" id="tarif" title="Insérer un tarif" />
                            <label for="tarifType">Tarif Type</label>
                            <input type="text" name="tarifType" id="tarifType" title="Insérer un tarif type" />
                            <label for="groupeAge">Groupe d'age</label>
                            <input type="text" name="groupeAge" id="groupeAge" title="Insérer un groupe d'age" />
                            <label for="etatFranchise">Etat de la franchise</label>
                            <input type="text" name="etatFranchise" id="etatFranchise" title="Insérer un état de la franchise" />
                            <label for="franchise">Franchise</label>
                            <input type="text" name="franchise" id="franchise" title="Insérer une fanchise" />
                            <label for="prime">Prime</label>
                            <input type="text" name="prime" id="prime" title="Insérer une prime" />
                            <label for="sorte">Sorte</label>
                            <input type="text" name="sorte" id="sorte" title="Insérer une sorte" />
                            <label for="estBaseP">Base P</label>
                            <input type="text" name="estBaseP" id="estBaseP" title="Insérer une base P" />
                            <label for="estBaseF">Base F</label>
                            <input type="text" name="estBaseF" id="estBaseF" title="Insérer une Base F " />
                            <label for="nomTarif">Nom tarif</label>
                            <input type="text" name="nomTarif" id="nomTarif" title="Insérer un nom de tarif" /><br/><br/>
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>