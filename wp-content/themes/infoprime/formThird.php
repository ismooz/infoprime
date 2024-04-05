<?php
/* Template Name : formThird-new */

include ABSPATH . '/comparateur/library/database/MyPDO.class.php';
include ABSPATH . '/comparateur/library/comparateur.class.php';

$db = library\database\MyPDO::getInstance('mysql:host=mysql.economies.ch;dbname=medt_WP14675', 'medt_ismael', 'IsmaeL_1983');
$comparateur = new \library\comparateur($_POST);

$result = $comparateur->queryTotal();
//echo $result;
$stmt = $db->query($result);
$total = $stmt->fetchAll(\PDO::FETCH_ASSOC);
$prime_actuelle = $comparateur->getCurrentPrime();

get_header();

$naissance = $_POST["naissance"];
$npaLocalite = $_POST["npaLocalite"];
$region = $_POST["idRegion"];

?>
<!doctype html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/jquery-ui.structure.min.css" />
    <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/jquery-ui.theme.min.css" />
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/styles.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!-- formThird.php -->
    <div id="main-content-comparateur">
        <div class="container row">
            <div class="col-lg-12 col-md-12 cadre" style="">
                <br>
                <h1 class="txt-center">Comparatif des primes d'assurance<font color="red"> 2024</font>
                </h1>
                <br>
                <div class="form-maladie">

                    <div class="row primes d-none d-sm-flex py-4">
                        <!-- Utilisation de d-sm-flex au lieu de d-sm-block pour un meilleur contrôle de la grille -->
                        <div class="col-sm-12 text-center py-4">
                            <!-- Remplacement du style inline par la classe mb-3 de Bootstrap pour l'espacement du bas -->
                            <h3>Votre prime en <b>2024</b> selon votre caisse actuelle à <b><?php echo $npaLocalite; ?></b></h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <p><i id="button-primeActuelle" class="fa fa-plus-square" onclick="toggleDiv(this, 'detailBase');"></i><a href="#" onclick="return false;" data-id="<?php echo ($prime_actuelle['assureurId']); ?>" data-montant="&economies=0" class="modal-box"><strong><?php echo $comparateur->getAssureur($_POST['assureur']); ?></strong></a>
                                <?php echo ($prime_actuelle['personneTotal'] == 0 ? '<br>L\'assurance n\'étant pas dans le canton ou n\'éxistant plus en 2024, le comparatif ne peut être effectué.' : ''); ?><br /><span class="tarif"><?php echo ($comparateur->getTarifName($_POST['assureur'], $prime_actuelle['tarif'], $prime_actuelle['tarif_type'])); ?></span></p>
                        </div>
                        <?php if ($_POST['nbAssures'] == 1) : ?>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <p>Options</p>
                                <p>CHF <?php echo number_format($_POST['franchise-1'], 0, ".", "'"); ?> .- / <?php echo ucfirst($_POST['accident-1']); ?> accident</p>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <p>Prime mensuelle</p>
                            <p><span class="mensuel"><strong>CHF <?php echo number_format($prime_actuelle['personneTotal'], 2, ".", "'"); ?></strong></span></p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 text-end">
                            <!-- Utilisation de text-end au lieu de txt-right pour l'alignement du texte -->
                            <p>Prime / année</p>
                            <p><span class="annuel">CHF <?php echo number_format($prime_actuelle['personneTotal'] * 12, 2, ".", "'"); ?></span></p>
                        </div>
                    </div>

                    <div class="row prime-phone d-block d-sm-none" style="background-color:#fff">
                        <div class="col-12 py-4">
                            <h4>Votre prime en <b>2024</b> selon votre caisse actuelle à <b><?php echo $npaLocalite; ?></b></h4>
                        </div>
                        <div class="col-12">
                            <p class="assureur"><strong><?php echo $comparateur->getAssureur($_POST['assureur']); ?></strong><br><?php echo ($comparateur->getTarifName($_POST['assureur'], $prime_actuelle['tarif'], $prime_actuelle['tarif_type'])); ?></p>
                        </div>
                        <div class="col-12">
                            <p>Prime mensuelle</p>
                            <p><span class="mensuel"><strong>CHF <?php echo number_format($prime_actuelle['personneTotal'], 2, ".", "'"); ?></strong></span></p>
                        </div>
                        <br>

                        <div class="col-12">
                            <p>Prime / année</p>
                            <p><span class="annuel">CHF <?php echo number_format($prime_actuelle['personneTotal'] * 12, 2, ".", "'"); ?></span></p>
                        </div>
                    </div>
                    <div class="d-none d-sm-block">
                        <br>
                        <div class="detail" id="detailBase">
                            <?php
                            $counterPersonnes = 1;
                            for ($i = 0; $i < $_POST['nbAssures']; $i++) :
                            ?>
                                <div class="row personne">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <p>Personne <?php echo ($counterPersonnes); ?></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <p>Options</p>
                                        <p>CHF <?php echo ($_POST['franchise-' . $counterPersonnes]); ?> .- / <?php echo (ucfirst($_POST['accident-' . $counterPersonnes])); ?> accident</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <p>Prime mensuelle</p>
                                        <p><span class="mensuel"><strong>CHF <?php echo number_format($prime_actuelle['personne_' . $counterPersonnes], 2, ".", "'"); ?></strong></span></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 txt-right">
                                        <p>Prime / année</p>
                                        <p><span class="annuel">CHF <?php echo number_format((($prime_actuelle['personne_' . $counterPersonnes]) * 12), 2, ".", "'"); ?></span></p>
                                    </div>
                                </div>
                            <?php
                                $counterPersonnes++;
                            endfor;
                            ?>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row d-none d-sm-block">
                        <div class="col-lg-12 col-md-12">
                            <h5><strong>Affichage des résultats</strong></h5>
                            <div class="radio">
                                <input type="radio" name="affichage" id="vueStandard" onclick="toggleAllDiv('standard');" <?php echo ($_POST['affichageResultats'] === 'vueStandard' ? ' checked="checked"' : '') ?> />
                                <label for="vueStandard">Vue standard</label>&nbsp;&nbsp;
                                <input type="radio" name="affichage" id="vueDetaillee" onclick="toggleAllDiv('detaillee');" <?php echo ($_POST['affichageResultats'] === 'vueDetaillee' ? ' checked="checked"' : '') ?> />
                                <label for="vueDetaillee">Vue détaillée</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <br>
                    </div>
                    <?php
                    $counterAssureur = 1;
                    foreach ($total as $donnees) :
                        if ($counterAssureur % 2 == 0) {
                            $color = '#fff';
                        } else {
                            $color = 'rgba(0, 0, 0, 0.05)';
                            $text_color = '#fff';
                        }
                    ?>
                        <div class="primes hidden-xs" style="margin-top: 2rem; padding: 1.5rem;">
                            <div class="row" style="margin-bottom: 1.5rem;">
                                <div class="col-lg-6 col-md-6 col-sm-6 mt-1">
                                    <p class="assureur"><i id="button-<?php echo ($counterAssureur); ?>" class="fa fa-plus-square" onclick="toggleDiv(this, 'detail-<?php echo ($counterAssureur); ?>');"></i><a href="#" data-id="<?php echo ($donnees['assureurId']); ?>" data-montant="<?php echo ((($donnees['personneTotal']) * 12) - (($prime_actuelle['personneTotal']) * 12)); ?>" class="modal-box"><strong><?php echo strtoupper($comparateur->getAssureur($donnees['assureurId'])); ?></strong></a><br /><span class="tarif"><?php echo ($comparateur->getTarifName($donnees['assureurId'], $donnees['tarif'], $donnees['tarif_type'])); ?></span></p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 mt-1">
                                    <p class="txt-left">Prime mensuelle<br><span class="mensuel"><strong>CHF <?php echo number_format($donnees['personneTotal'], 2, ".", "'"); ?></strong>
                                        </span>
                                        <!-- <br>
                                Prime / année<br><span class="annuel">CHF <?php echo number_format((($donnees['personneTotal']) * 12), 2, ".", "'"); ?></span></p> -->
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 mt-1"><?php $eco = number_format((($donnees['personneTotal']) * 12) - (($prime_actuelle['personneTotal']) * 12), 2, ".", "'");
                                                                                echo ($eco > 0) ? '<span class="depenses">Suplément de prime de<br><strong>CHF ' . $eco . '</strong></span>' : '<span class="economies">Potentiel d\'économie<br><strong>CHF ' . str_replace('-', '', $eco) . '</strong></span>' ?>
                                </div>
                            </div>

                            <div class="row" style="padding: 0 1.5rem 0 1.5rem;">
                                <div class=col-lg-12>
                                    <hr>
                                    <button type="button" style="float:right;" class="button-87" onclick="document.getElementById('<?php echo 'form-' . $counterAssureur; ?>').submit();">Demander une offre <i class="fa fa-arrow-right" style="color: white;"></i></button></p>
                                    <form id="form-<?php echo $counterAssureur; ?>" action="https://infoprime.ch/offre-maladie/donnees/" method="post" style="display:none">
                                        <input type="hidden" name="assureurSelectedId" value="<?php echo $donnees['assureurId'] ?>" />
                                        <input type="hidden" name="assureurSelectedTotal" value="<?php echo (($donnees['personneTotal']) * 12); ?>" />
                                        <input type="hidden" name="tarif" value="<?php echo $donnees['tarif']; ?>" />
                                        <input type="hidden" name="tarifType" value="<?php echo $donnees['tarif_type']; ?>" />
                                        <input type="hidden" name="assureurActuelTotal" value="<?php echo (($prime_actuelle['personneTotal']) * 12) ?>" />
                                        <?php foreach ($_POST as $key => $value) : ?>
                                            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
                                        <?php endforeach; ?>
                                    </form>
                                </div>
                            </div>

                            <div class="detail" style="margin-top: 1.5rem;" id="detail-<?php echo ($counterAssureur); ?>">
                                <?php
                                $counterPersonnes = 1;
                                for ($i = 0; $i < $_POST['nbAssures']; $i++) :
                                ?>
                                    <div class="row personne hidden-xs">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <p>Personne <?php echo ($counterPersonnes); ?></p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <p>Options</p>
                                            <p>CHF <?php echo ($_POST['franchise-' . $counterPersonnes]); ?> .- / <?php echo (ucfirst($_POST['accident-' . $counterPersonnes])); ?> accident</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <p>Prime mensuelle</p>
                                            <p><span class="mensuel">CHF <strong><?php echo number_format(($donnees['personne_' . $counterPersonnes]), 2, ".", "'"); ?></strong></span></p>
                                        </div>
                                        <!-- <div class="col-lg-3 col-md-3 col-sm-3 txt-left">
                                            <p>Prime / année</p>
                                            <p><span class="annuel">CHF <?php echo number_format((($donnees['personne_' . $counterPersonnes]) * 12), 2, ".", "'"); ?></span></p>
                                        </div> -->
                                        <div class="clearfix"></div>
                                    </div>
                                <?php
                                    $counterPersonnes++;
                                endfor;
                                ?>
                            </div>

                        </div>
                    <?php
                        $counterAssureur++;
                    endforeach;
                    ?>
                    <br>
                    <br>
                    <?php
                    $counterAssureur = 0;
                    foreach ($total as $donnees) :
                        if ($counterAssureur % 2 == 0) {
                            $color = '#fff';
                        } else {
                            $color = '#ddd';
                        }
                    ?>
                        <div class="d-block d-sm-none prime-phone row">

                            <div class="col-12">
                                <p class="assureur"><strong><?php echo strtoupper($comparateur->getAssureur($donnees['assureurId'])); ?></strong><br><?php echo ($comparateur->getTarifName($donnees['assureurId'], $donnees['tarif'], $donnees['tarif_type'])); ?></p>
                            </div>

                            <div class="col-6 col-offset-6" style="text-align: right; background-color: #EBF4F1; border-radius: 3px; margin-top: 1rem;">
                                <p>Prime mensuelle</p>
                                <p><span class="mensuel"><strong>CHF <?php echo number_format(($donnees['personneTotal']), 2, ".", "'"); ?></strong></span></p>
                            </div>


                            <!-- <div class="col-6 col-offset-6" style="text-align: right;">
                                <p>Potentiel d'économie</p>
                                <p><?php $eco = number_format((($donnees['personneTotal']) * 12) - (($prime_actuelle['personneTotal']) * 12), 2, ".", "'");
                                    echo ($eco > 0) ? '<span class="txt-red"><strong>CHF ' . number_format(abs($eco), 2, ".", "'") . '</strong></span>' : '<span class="txt-green"><strong>CHF ' . number_format(abs($eco), 2, ".", "'") . '</strong></span>' ?></p>
                            </div> -->
                            <div class="clear"></div>
                            <br />
                            <div class="divButton">
                                <button class="button-87" onclick="document.getElementById('<?php echo 'form-' . $counterAssureur; ?>').submit();">Demander une offre <i class="fa fa-arrow-right" style="color: white;"></i></button>
                                <form id="form-<?php echo $counterAssureur; ?>" action="https://infoprime.ch/offre-maladie/donnees/" method="post" style="display:none">
                                    <input type="hidden" name="assureurSelectedId" value="<?php echo $donnees['assureurId'] ?>" />
                                    <input type="hidden" name="assureurSelectedTotal" value="<?php echo (($donnees['personneTotal']) * 12); ?>" />
                                    <input type="hidden" name="tarif" value="<?php echo $donnees['tarif']; ?>" />
                                    <input type="hidden" name="tarifType" value="<?php echo $donnees['tarif_type']; ?>" />
                                    <input type="hidden" name="assureurActuelTotal" value="<?php echo (($prime_actuelle['personneTotal']) * 12) ?>" />
                                    <?php foreach ($_POST as $key => $value) : ?>
                                        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
                                    <?php endforeach; ?>
                                </form>
                            </div>
                        </div>
                    <?php
                        $counterAssureur++;
                    endforeach;
                    ?>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php get_footer(); ?>
    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery.autocomplete.min.js"></script>
    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/infoprime-modal.js"></script>
    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/fonctions.js"></script>
    <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/app.js"></script>
</body>

</html>
<?php

if ($_POST['affichageResultats'] === 'vueDetaillee') {
    echo ('<script type="text/javascript">toggleAllRow("detaillee");</script>');
}

?>