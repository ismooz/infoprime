            <div class="box box-default box-theme-default">
                <div class="box-header">Options générales</div>
                <div class="box-body">
                    <form action="" method="post" class="form-maladie" />
                        <label for="nbPersonnes">Nombre de personnes</label>
                        <br/>
                        <select name="nbPersonnes" id="nbPersonnes" title="Sélectionner le nombre de personnes possible pour le comparateur">
                            <option value="-1">- Veuillez sélectionner -</option>
<?php
    // Parcours les personnes
    for($i=1;$i<=20;$i++){
        if($options['nbPersonnes'] == $i){
            echo("\t\t\t\t" . '<option value="' . $i . '" selected="selected">' . (($i===1)?$i . ' personne':$i . ' personnes') . '</option>' . "\r\n");
        } else {
            echo("\t\t\t\t" . '<option value="' . $i . '">' . (($i===1)?$i . ' personne':$i . ' personnes') . '</option>' . "\r\n");
        }
    }
?>
                        </select>
                        <br/>
                        <br/>
                        <h3>Correspondance</h3>
                        <input type="checkbox" name="" id="" /><label for="">Enregistrer dans la base de données</label>
                        <br/>
                        <br/>
                        <h3>Enregistrements<i class="fa fa-info" title="Enregistrements" data-content="data-enregistrements"></i></h3>
                        <label for="nbEnregistrements">Nombre d'enregistrements par page</label>
                        <br/>
                        <br/>
                        <select name="nbEnregistrements" id="nbEnregistrements" title="Sélectionnez le nombre d'enregistrements par page">
                            <option value="-1"<?php //echo(($options['nbEnregistrements'] == -1)?'selected="selected"':''); ?>>- Veuillez sélectionner -</option>
                            <option value="10"<?php //echo(($options['nbEnregistrements'] == 10)?'selected="selected"':''); ?>>10 enregistrements par page</option>
                            <option value="25"<?php //echo(($options['nbEnregistrements'] == 25)?'selected="selected"':''); ?>>25 enregistrements par page</option>
                            <option value="50"<?php //echo(($options['nbEnregistrements'] == 50)?'selected="selected"':''); ?>>50 enregistrements par page</option>
                            <option value="75"<?php //echo(($options['nbEnregistrements'] == 75)?'selected="selected"':''); ?>>75 enregistrements par page</option>
                            <option value="100"<?php //echo(($options['nbEnregistrements'] == 100)?'selected="selected""':''); ?>>100 enregistrements par page</option>
                        </select>
                        <br/>
                        <br/>
                        <h3>Journalisation<i class="fa fa-info" title="Journalisation" data-content="data-journalisation"></i></h3>
                        <input type="checkbox" name="journalApplication" id="journalApplication" <?php //echo(($options['journalApplication'] == 1)?' checked="checked"':''); ?>/><label for="journalApplication">Journal d'application</label>
                        <br/>
                        <input type="checkbox" name="journalOffres" id="journalOffres" <?php //echo(($options['journalOffres'] == 1)?' checked="checked"':''); ?>/><label for="journalOffres">Journal des demandes d'offre</label>
                        <br/>
                        <input type="checkbox" name="journalSecurite" id="journalSecurite" <?php //echo(($options['journalAcces'] == 1)?' checked="checked"':''); ?>/><label for="journalSecurite">Journal de sécurité</label>
                        <br/>
                        <br/>
                        <h3>Maintenance<i class="fa fa-info" title="Maintenance" data-content="data-maintenance"></i></h3>
                        <input type="checkbox" name="estEnMaintenance" id="estEnMaintenance"<?php //echo(($options['estEnMaintenance'] == 1)?' checked="checked"':''); ?>/><label for="estEnMaintenance">Définir l'application en maintenance</label>
                        <br/>
                        <br/>
                        <input type="submit" class="btn btn-default btn-theme-default" value="Enregistrer" />
                    </form>
                </div>
                <div class="box-footer"></div>
                <div id="data-enregistrements" class="tooltip-content">
                    <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Enregistrements</h3>
                    <p>
                        Enregistrements
                    </p>
                </div>
                <div id="data-journalisation" class="tooltip-content">
                    <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Journalisation</h3>
                    <p>
                        La journalisation (en anglais logging) est l'action de relever dans un journal (en anglais log) tous les évènements qui se produisent dans un système informatique pendant son fonctionnement.<br/><br/>
                        La journalisation permet d'effectuer des analyses diverses, généralement statistiques ; de faire des hypothèses sur les dysfonctionnements ou les pertes de performance d'un système.<br/><br/>
                        L'accès aux journaux peut contrevenir à certaines exigences de confidentialité, voire de sécurité.
                    </p>
                </div>
                <div id="data-maintenance" class="tooltip-content">
                    <h3><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Maintenance</h3>
                    <p>
                        La maintenance est une action qui va vous permettre d'intérdire l'accès à l'application lors d'une opération de maintenance de l'application.
                    </p>
                </div>
            </div>