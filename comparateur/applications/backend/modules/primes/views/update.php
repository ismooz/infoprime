            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'une prime</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="assureurId">Assureur</label>
                            <select name="assureurId" id="assureurId">
                                <option value="-1">- Veuillez sélectionner</option>
<?php
    foreach($assureurs as $assureur):
        if(isset($prime) && $prime->getAssureurId() == $assureur->getId()):
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
                            <input type="text" name="canton" id="canton" value="<?php echo($prime->getCanton()); ?>" />
                            <label for="exercice">Exercice</label>
                            <input type="text" name="exercice" id="exercice" value="<?php echo($prime->getExercice()); ?>" />
                            <label for="enquete">Enquête</label>
                            <input type="text" name="enquete" id="enquete" value="<?php echo($prime->getEnquete()); ?>" />
                            <label for="region">Région</label>
                            <input type="text" name="region" id="region" value="<?php echo($prime->getRegion()); ?>" />
                            <label for="classeAge">Classe d'age</label>
                            <input type="text" name="classeAge" id="classeAge" value="<?php echo($prime->getClasseAge()); ?>" />
                            <label for="accident">Accident</label>
                            <input type="text" name="accident" id="accident" value="<?php echo($prime->getAccident()); ?>" />
                            <label for="tarif">Tarif</label>
                            <input type="text" name="tarif" id="tarif" value="<?php echo($prime->getTarif()); ?>" />
                            <label for="tarifType">Tarif type</label>
                            <input type="text" name="tarifType" id="tarifType" value="<?php echo($prime->getTarifType()); ?>" />
                            <label for="groupeAge">Groupe d'age</label>
                            <input type="text" name="groupeAge" id="groupeAge" value="<?php echo($prime->getGroupeAge()); ?>" />
                            <label for="etatFranchise">Etat de la franchise</label>
                            <input type="text" name="etatFranchise" id="etatFranchise" value="<?php echo($prime->getEtatFranchise()); ?>" />
                            <label for="franchise">Franchise</label>
                            <input type="text" name="franchise" id="franchise" value="<?php echo($prime->getFranchise()); ?>" />
                            <label for="prime">Prime</label>
                            <input type="text" name="prime" id="prime" value="<?php echo($prime->getPrime()); ?>" />
                            <label for="sorte">Sorte</label>
                            <input type="text" name="sorte" id="sorte" value="<?php echo($prime->getSorte()); ?>" />
                            <label for="estBaseP">Base P</label>
                            <input type="text" name="estBaseP" id="estBaseP" value="<?php echo($prime->getEstBaseP()); ?>" />
                            <label for="estBaseF">Base F</label>
                            <input type="text" name="estBaseF" id="estBaseF" value="<?php echo($prime->getEstBaseF()); ?>" />
                            <label for="estBaseP">Nom du tarif</label>
                            <input type="text" name="nomTarif" id="nomTarif" value="<?php echo($prime->getNomTarif()); ?>" />
                            <br/>
                            <br/>
                            <input type="hidden" name="id" value="<?php echo($prime->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo($prime->getDateCreation()->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo($prime->getDateModification()->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                        <p>Date de création : <?php echo($prime->getDateCreation()->format('d/m/Y à H\hi')); ?></p>
                        <p>Date de modification : <?php echo($prime->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>