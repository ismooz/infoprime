            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Insertion d'une police</div>
                    <div class="panel-body">
                        <form action="" method="post" id="form-default">
                            <label for="name_de">Assurance</label>
                            <select name="assureurId" id="assureurId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($assureurs as $assureur):
        if(isset($police) && $police->getAssureurId() == $assureur->getId()):
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
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_ASSUREUR_ID, $erreurs))?' <span class="errors">l\'assurance est invalide.</span>':''); ?>
                            <label for="conseillerId">Conseiller</label>
                            <select name="conseillerId" id="conseillerId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($conseillers as $conseiller):
        if(isset($police) && $police->getConseillerId() == $conseiller->getId()):
?>
                                <option value="<?php echo($conseiller->getId()); ?>" selected="selected"><?php echo(ucfirst(strtolower($conseiller->getNom())) . ' ' . ucfirst(strtolower($conseiller->getPrenom()))); ?></option>
<?php
        else:
?>
                                <option value="<?php echo($conseiller->getId()); ?>"><?php echo(ucfirst(strtolower($conseiller->getNom())). ' ' . ucfirst(strtolower($conseiller->getPrenom()))); ?></option>                            
<?php
        endif;
    endforeach;
?>
                            </select>
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_COMNSEILLER_ID, $erreurs))?' <span class="errors">Le conseiller est invalide.</span>':''); ?>
                            <label for="policeTypeId">Type de police</label>
                            <select name="policeTypeId" id="policeTypeId">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    foreach($policesTypes as $policeType):
        if(isset($police) && $police->getPoliceTypeId() == $policeType->getId()):
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
                            <input type="text" name="police" id="police" value="<?php echo(isset($police)?$police->getPolice():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_POLICE_NO, $erreurs))?' <span class="errors">le numéro de police est invalide.</span>':''); ?>
                            <label for="prime">Prime annuelle</label>
                            <input type="text" name="prime" id="prime" value="<?php echo(isset($police)?$police->getPrime():''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_PRIME, $erreurs))?' <span class="errors">la prime est invalide.</span>':''); ?>
                            <label for="dateDebut">Date de début</label>
                            <input type="text" name="dateDebut" id="dateDebut" value="<?php echo(isset($police) && ($police->getDateDebut() instanceOf \DateTime == true)?$police->getDateDebut()->format('d/m/Y'):''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_DATE_DEBUT, $erreurs))?' <span class="errors">la date de début est invalide.</span>':''); ?>
                            <label for="dateFin">Date de fin</label>
                            <input type="text" name="dateFin" id="dateFin" value="<?php echo(isset($police) && ($police->getDateFin() instanceof \DateTime == true)?$police->getDateFin()->format('d/m/Y'):''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_DATE_FIN, $erreurs))?' <span class="errors">la date de fin est invalide.</span>':''); ?>
                            <label for="dateResiliation">Date de résiliation</label>
                            <input type="text" name="dateResiliation" id="dateResiliation" value="<?php echo(isset($police) && ($police->getDateResiliation() instanceof \DateTime == true)?$police->getDateResiliation()->format('d/m/Y'):''); ?>" />
                            <?php echo((isset($erreurs) && in_array(library\entities\policeEntity::INVALID_DATE_RESILIATION, $erreurs))?' <span class="errors">la date de résiliation est invalide.</span>':''); ?>
                            <input type="hidden" name="dateCreation" value="<?php $dateCreation = new \DateTime;echo($dateCreation->getTimestamp()); ?>" />
                            <input type="hidden" name="dateModification" value="<?php $dateModification = new \DateTime;echo($dateModification->getTimestamp()) ?>" />
                            <br/>
                            <br/>
                            <input type="submit" value="Enregistrer" class="btn btn-default btn-theme-default" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>