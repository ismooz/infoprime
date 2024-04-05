            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Modification d'une police</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="assureurId">Assurance</label>
                            <select name="assureurId" id="assureurId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($assureurs as $assureur):
        if($police->getAssureurId() == $assureur->getId()):
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
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_ASSUREUR_ID, $erreurs))?' <span class="errors">L\'assureur est invalide.</span>':''); ?>
                            <label for="conseillerId">Conseiller</label>
                            <select name="conseillerId" id="conseillerId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($conseillers as $conseiller):
        if($police->getConseillerId() == $conseiller->getId()):
?>
                                <option value="<?php echo($conseiller->getId()); ?>" selected="selected"><?php echo(ucfirst(strtolower($conseiller->getNom())). ' ' . ucfirst(strtolower($conseiller->getPrenom()))); ?></option>
<?php
        else:
?>
                                <option value="<?php echo($conseiller->getId()); ?>"><?php echo(ucfirst(strtolower($conseiller->getNom())) . ' ' . ucfirst(strtolower($conseiller->getPrenom()))); ?></option>                            
<?php
        endif;
    endforeach;
?>
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_AGENT_ID, $erreurs))?' <span class="errors">Le courtier est invalide.</span>':''); ?>
                            <label for="policeTypeId">Type de police</label>
                            <select name="policeTypeId" id="policeTypeId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($policesTypes as $policeType):
        if($police->getPoliceTypeId() == $policeType->getId()):
?>
                                <option value="<?php echo($policeType->getId()); ?>" selected="selected"><?php echo('Assurance ' . strtolower($policeType->getName())); ?></option>
<?php
        else:
?>
                                <option value="<?php echo($policeType->getId()); ?>"><?php echo('Assurance ' . strtolower($policeType->getName())); ?></option>                            
<?php
        endif;
    endforeach;
?>
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_POLICE_TYPE_ID, $erreurs))?' <span class="errors">Le type de police est invalide.</span>':''); ?>
                            <label for="police">Numéro de police</label>
                            <input type="text" name="police" id="police" value="<?php echo($police->getPolice()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_POLICE_NO, $erreurs))?' <span class="errors">La police est invalide.</span>':''); ?>
                            <label for="prime">Prime annuelle</label>
                            <input type="text" name="prime" id="prime" value="<?php echo($police->getPrime()); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_POLICE_NO, $erreurs))?' <span class="errors">La prime est invalide.</span>':''); ?>
                            <label for="dateDebut">date de début</label>
                            <input type="text" name="dateDebut" id="dateDebut" value="<?php echo($police->getDateDebut()->format('d/m/Y')); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_DATE_DEBUT, $erreurs))?' <span class="errors">La date de début est invalide.</span>':''); ?>
                            <label for="dateFin">Date de fin</label>
                            <input type="text" name="dateFin" id="dateFin" value="<?php echo($police->getDateFin()->format('d/m/Y')); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_DATE_FIN, $erreurs))?' <span class="errors">La date de fin est invalide.</span>':''); ?>
                            <label for="dateResiliation">Date de résiliation</label>
                            <input type="text" name="dateResiliation" id="dateResiliation" value="<?php echo($police->getDateResiliation()->format('d/m/Y')); ?>" /><br/><br/>
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_DATE_RESILIATION, $erreurs))?' <span class="errors">La langue en allemand est invalide.</span>':''); ?>
                            <input type="hidden" name="id" value="<?php echo($police->getId()); ?>" />
                            <input type="hidden" name="dateCreation" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php echo((new \DateTime)->getTimestamp()); ?>" />
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                        <p>Date de création : <?php echo($police->getDateCreation()->format('d/m/Y à H\hi')); ?></p>
                        <p>Date de modification : <?php echo($police->getDateModification()->format('d/m/Y à H\hi')); ?></p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>