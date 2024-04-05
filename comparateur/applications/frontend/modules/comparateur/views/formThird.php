            <?php               
            
                $db = \library\database\MyPDO::getInstance(DB_DSN, DB_USER, DB_PASS);
            
                // Vérifie que le formaulraire soit posté
                if(!isset($_POST['assureur'])){
                    die('La page ne doit pas être ouverture directement');
                }
                //var_dump($_POST);                
                $comparateur = new library\comparateur($_POST);
                
                $result = $comparateur->queryTotal();
                //echo($result);
                $stmt = $db->query($result);
                $total = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                //var_dump($total);
                
                // Calcul de la prime de l'assureur actuelle
                $prime_actuelle = $comparateur->getCurrentPrime();
                //var_dump($prime_actuelle);
                
            ?>
            <div class="container-fluid">
                <div class="container">
                    <h1 class="txt-center">Tableau comparatif</h1>
                    <p class="txt-center">Ce comparatif est valable pour les primes 2015.</p>
                    <div class="panel panel-default">                      
                        <div class="panel-body">
                            <h3>Votre prime actuelle</h3>
                            <div class="primeActuelle">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Caisse maladie</th>
                                            <th>Modèle</th>
                                            <th>Accident</th>
                                            <th>Mensuelle</th>
                                            <th>Annuelle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i id="button-primeActuelle" class="fa fa-plus-square" onclick="toggleRow('buton-primeActuelle', 'actuelle');"></i><strong><?php echo $comparateur->getAssureur($_POST['assureur']); ?></strong><br/><small>(<?php echo($prime_actuelle['tarif']); ?>)</small></td>
                                            <td class="txt-center"><?php echo $prime_actuelle['tarif_type']; ?></td>
                                            <td class="txt-center">-</td>
                                            <td class="txt-right">CHF <?php echo number_format($prime_actuelle['PersonneTotal'], 2, "." , "'"); ?></td>
                                            <td class="txt-right">CHF <?php echo number_format($prime_actuelle['PersonneTotal'] * 12, 2, "." , "'"); ?></td>
                                        </tr>
                                        <tr id="tr-personne-actuelle-1" class="personne">
                                            <td>Personne 1</td>
                                            <td class="txt-center">-</td>
                                            <td class="txt-center"><?php echo ($prime_actuelle['Accident_1'] == 'MIT-UNF')?'Avec':'Sans'; ?></td>
                                            <td class="txt-right">CHF <?php echo number_format($prime_actuelle['Personne_1'], 2, "." , "'"); ?></td>
                                            <td class="txt-right annuel">CHF <?php echo number_format(($prime_actuelle['Personne_1'] * 12), 2, "." , "'"); ?></td>
                                        </tr>
                                        <?php
                                                $counterPersonnes = 2;
                                                for($i=0;$i<($_POST['nbAssures']-1);$i++):           
                                        ?>
                                        <tr id="tr-personne-actuelle-<?php echo $counterPersonnes; ?>" class="personne">
                                            <td>Personne <?php echo $counterPersonnes; ?></td>
                                            <td class="txt-center">-</td>
                                            <td class="txt-center"><?php echo ($prime_actuelle['Accident_' . $counterPersonnes] == 'MIT-UNF')?'Avec':'Sans'; ?></td>
                                            <td class="txt-right">CHF <?php echo number_format($prime_actuelle['Personne_' . $counterPersonnes], 2, "." , "'"); ?></td>
                                            <td class="txt-right annuel">CHF <?php echo number_format(($prime_actuelle['Personne_' . $counterPersonnes] * 12), 2, "." , "'"); ?></td>
                                        </tr>
                                        <?php
                                                    $counterPersonnes++;
                                                endfor;
                                        ?>                                
                                    </tbody>                         
                                </table>
                            </div>
                            <br/>
                            <div class="col_2">
                                <label><strong>Affichage des résultats</strong></label>
                                <br/>
                                <br/>
                                <div class="radio">
                                    <input type="radio" name="affichage" id="vueStandard" checked="checked" onclick="toggleAllRow('standard');" /> 
                                    <label for="vueStandard" class="button"></label> 
                                </div>
                                <label for="vueStandard" class="radioLabel">Vue standard</label>
                                <div class="radio">
                                    <input type="radio" name="affichage" id="vueDetaillee" onclick="toggleAllRow('detaillee');" />
                                    <label for="vueDetaillee" class="button"></label>
                                </div>
                                <label for="vueDetaillee" class="radioLabel">Vue détaillée</label>
                            </div>
                            <div class="col_2 txt-right">
                                <label><strong>Trier par</strong></label>
                                <br/>
                                <br/>
                                <select onchange="document.getElementById('tri').submit();">
                                    <option value="1">Prix croissants</option>
                                    <option value="2">Prix décroissants</option>
                                    <option value="3">Caisse maladie A-Z</option>
                                    <option value="4">Caisse maladie Z-A</option>
                                </select>
                                <form id="tri" action="?page=form-third" method="post">
                                    <?php 

                                        foreach($_POST as $key=>$value){ 
                                            if($key === 'tri'){
                                    ?>
                                    <input type="hidden" name="<?php echo $key ?>" value="<?php echo $value; ?>" />
                                    <?php
                                            } else {
                                    ?>
                                    <input type="hidden" name="<?php echo $key ?>" value="<?php echo $value; ?>" />
                                    <?php 

                                            }
                                        }

                                    ?>
                                </form>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                            <br/>
                            <h3>Comparatif des primes</h3>                                     
                            <table class="table-default" id="primes">
                                <thead>
                                    <tr>
                                        <th>Caisse maladie</th>
                                        <th>Modèle</th>
                                        <th>Accident</th>
                                        <th>Mensuelle</th>
                                        <th>Annuelle</th>
                                        <th>Economie potentiel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody
                                    <?php
                                        $counterAssureur = 0;
                                        foreach($total as $donnees):        
                                    ?>
                                    <tr>
                                        <td><i id="button-<?php echo($counterAssureur); ?>" class="fa fa-plus-square" onclick="toggleRow('button-' + <?php echo($counterAssureur); ?>, <?php echo $counterAssureur ?>);"></i><strong><?php echo $comparateur->getAssureur($donnees['assureurId']); ?></strong><br/><small>(<?php echo($donnees['tarif']); ?>)</small></td>
                                        <td class="txt-center"><?php echo($donnees['tarif_type']); ?></td>
                                        <td class="txt-center">-</td>
                                        <td class="txt-right"><?php echo number_format($donnees['PersonneTotal'], 2, "." , "'"); ?></td>
                                        <td class="txt-right annuel"><?php echo number_format(($donnees['PersonneTotal'] * 12), 2, "." , "'"); ?></td>
                                        <td class="txt-right economies"><?php echo number_format(($donnees['PersonneTotal'] * 12) - ($prime_actuelle['PersonneTotal'] * 12), 2, "." , "'"); ?></td>
                                        <td class="txt-center">
                                            <button class="btn btn-small btn-default btn-theme-default" onclick="document.getElementById('<?php echo 'form-' . $counterAssureur; ?>').submit();">Demande d'offre</button>
                                            <form id="form-<?php echo $counterAssureur; ?>" action="/comparateur/comparateur/formFourth/" method="post">
                                                <input type="hidden" name="assureurSelectedId" value="<?php echo $donnees['assureurId'] ?>" />
                                                <input type="hidden" name="assureurSelectedTotal" value="<?php echo($donnees['PersonneTotal'] * 12); ?>" />
                                                <input type="hidden" name="tarifType" value="<?php echo $donnees['tarif_type']; ?>" />
                                                <input type="hidden" name="assureurActuelTotal" value="<?php echo ($prime_actuelle['PersonneTotal'] * 12) ?>" />
                                                <?php foreach($_POST as $key=>$value): ?>
                                                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
                                                <?php endforeach; ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr id="tr-personne-<?php echo $counterAssureur; ?>-1" class="personne">
                                        <td>Personne 1</td>
                                        <td class="txt-center">-</td>
                                        <td class="txt-center"><?php echo ($donnees['Accident_1'] == 'MIT-UNF')?'Avec':'Sans'; ?></td>
                                        <td class="txt-right"><?php echo number_format($donnees['Personne_1'], 2, "." , "'"); ?></td>
                                        <td class="txt-right annuel"><?php echo number_format(($donnees['Personne_1'] * 12), 2, "." , "'"); ?></td>
                                        <td class="txt-right economies"><?php echo number_format(($donnees['Personne_1'] * 12) - ($prime_actuelle['Personne_1'] * 12), 2, "." , "'"); ?></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                            $counterPersonnes = 2;
                                            for($i=0;$i<($_POST['nbAssures']-1);$i++):           
                                    ?>
                                    <tr id="tr-personne-<?php echo $counterAssureur; ?>-<?php echo $counterPersonnes; ?>" class="personne">
                                        <td>Personne <?php echo $counterPersonnes; ?></td>
                                        <td class="txt-center">-</td>
                                        <td class="txt-center"><?php echo ($donnees['Accident_' . $counterPersonnes] == 'MIT-UNF')?'Avec':'Sans'; ?></td>
                                        <td class="txt-right"><?php echo number_format($donnees['Personne_' . $counterPersonnes], 2, "." , "'"); ?></td>
                                        <td class="txt-right annuel"><?php echo number_format(($donnees['Personne_' . $counterPersonnes] * 12), 2, "." , "'"); ?></td>
                                        <td class="txt-right economies"><?php echo number_format(($donnees['Personne_' . $counterPersonnes] * 12) - ($prime_actuelle['Personne_' . $counterPersonnes] * 12), 2, ".", "'"); ?></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                                $counterPersonnes++;
                                            endfor;
                                            $counterAssureur++;
                                        endforeach;
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Caisse maladie</th>
                                        <th>Modèle</th>
                                        <th>Accident</th>
                                        <th>Mensuelle</th>
                                        <th>Annuelle</th>
                                        <th>Economie potentiel</th>
                                        <th>Action</th>                                
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>