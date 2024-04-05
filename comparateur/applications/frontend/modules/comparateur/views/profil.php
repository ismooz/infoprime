            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Votre profil</div>
                    <div class="panel-body">
<?php
$db = \library\database\MyPDO::getInstance(DB_DSN, DB_USER, DB_PASS);

$sqlClient = 'SELECT * FROM clients WHERE userId=' . $_SESSION['userId'];
$stmtClient = $db->query($sqlClient);
$client = $stmtClient->fetch(\PDO::FETCH_ASSOC);
//var_dump($client);
//echo($_SESSION['userId']);
?>
                        <img src="<?php echo($client['image']); ?>" alt="profil" class="portrait" />
                        <form action="#" method="post" class="form-maladie">
                            <label>Civilité</label>
                            <br/>
                            <br/>
                            <div class="radio">
                                <input type="radio" name="formule" id="madame" value="Madame"<?php echo(($client['civiliteId'] == 1)?' checked="checked"':''); ?> />
                                <label for="madame" class="button"></label>
                            </div>
                            &nbsp;
                            <label for="madame" class="radioLabel" id="lblMadame">Madame</label>
                            &nbsp;
                            <div class="radio">
                                <input type="radio" name="formule" id="monsieur" value="Monsieur"<?php echo(($client['civiliteId'] == 2)?' checked="checked"':''); ?> />
                                <label for="monsieur" class="button"></label>
                            </div>
                            &nbsp;
                            <label for="monsieur" class="radioLabel" id="lblMonsieur">Monsieur</label>
                            <br/>
                            <br/>
                            <label for="nom">Nom</label>
                            <br/>
                            <input type="text" name="nom" id="nom" class="client" value="<?php echo($client['nom']); ?>" title="Insérer votre nom" />
                            <br/>
                            <br/>
                            <label for="prenom">Prénom</label>
                            <br/>
                            <input type="text" name="prenom" id="prenom" class="client" value="<?php echo($client['prenom']); ?>" title="Insérer votre prénom" />
                            <br/>
                            <br/>
                            <label for="adresse">Adresse</label>
                            <br/>
                            <input type="text" name="adresse" id="adresse" class="client" value="<?php echo($client['adresse']); ?>" title="Insérer votre adresse" />
                            <br/>
                            <br/>
                            <label for="npa">Numéro postal</label>
                            <br/>
                            <input type="text" name="npa" id="npa" class="client" value="<?php echo($client['npa']); ?>" title="Insérer votre numéro postal" />
                            <br/>
                            <br/>
                            <label for="ville">Ville</label>
                            <br/>
                            <input type="text" name="ville"id="ville" class="client" value="<?php echo($client['ville']); ?>" title="Insérer votre ville" />
                            <br/>
                            <br/>
                            <label for="tel">Téléphone</label>
                            <br/>
                            <input type="text" name="tel" id="tel" class="client" value="<?php echo($client['telephone']); ?>" title="Insérer votre numéro de téléphone" />
                            <br/>
                            <br/>
                            <label for="email">Email</label>
                            <br/>
                            <input type="text" name="email" id="email" class="client" value="<?php echo($client['email']); ?>" title="Insérer votre adresse email" />
                            <br/>
                            <br/>
                            <label for="nationalite">Nationalité</label>
                            <br/>
                            <select name="nationalite" id="nationalite" title="Sélectionner votre nationalité">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    // Sélectionne toutes les nationalités
    $sqlNationalites = 'SELECT id, name_fr FROM nationalites';
    $stmtNationalites = $db->query($sqlNationalites);
    // Parcours toutes les nationalités
    while($row = $stmtNationalites->fetch(\PDO::FETCH_ASSOC)){
        if($row['id'] == $client['nationaliteId']){
            echo("\t\t\t\t" . '<option value="' . $row['id'] . '" selected="selected">' . $row['name_fr'] . '</option>' . "\r\n");
        } else {
            echo("\t\t\t\t" . '<option value="' . $row['id'] . '">' . $row['name_fr'] . '</option>' . "\r\n");
        }
    }
?>
                            </select>
                            <br/>
                            <br/>
                            <label>Langue de correspondance</label>
                            <br/>
                            <select name="langue" id="langue" title="Sélectionner votre langue de correspondance">
                                <option value="-1">- Veuillez sélectionner -</option>
<?php
    // Sélectionne toutes les langues
    $sqlLangues = 'SELECT id, name_fr FROM langues';
    $stmtLangues = $db->query($sqlLangues);
    // Parcours toutes les langues
    while($row = $stmtLangues->fetch(\PDO::FETCH_ASSOC)){
        if($row['id'] == $client['langueCorrespondanceId']){
            echo("\t\t\t\t" . '<option value="' . $row['id'] . '" selected="selected">' . $row['name_fr'] . '</option>' . "\r\n");
        }else{
            echo("\t\t\t\t" . '<option value="' . $row['id'] . '">' . $row['name_fr'] . '</option>' . "\r\n");
        }
    }                                                                    
?>
                            </select>
                            <br/>
                            <br/>
                            <label id="lblDateNaissance">Date de naissance</label>
                            <br/>
                            <input type="text" name="dateNaissance" id="datepicker" value="<?php echo($client['dateNaissance']); ?>" title="Insérer votre date de naissance" />
                            <br/>
                            <br/>
                            <input type="submit" class="btn btn-default btn-theme-default" value="Enregistrer" />
                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>