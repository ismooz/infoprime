<?php
/* Template Name: infosAssureurs */

include ABSPATH . '/comparateur/library/database/MyPDO.class.php';
$db = library\database\MyPDO::getInstance('mysql:host=mysql.economies.ch;dbname=medt_WP14675', 'medt_ismael', 'IsmaeL_1983');

// Assureur
$sqlAssureurs = "SELECT * FROM assureurs WHERE id=" . $_GET['id'];
$assureurs = $db->query($sqlAssureurs)->fetch(\PDO::FETCH_ASSOC);

// Assureur chiffres
$sqlAssureurChiffres2013 = "SELECT * FROM assureurs_chiffres WHERE assureurId=" . $_GET['id'] . " AND exercice=2013";
$assureurChiffres2013 = $db->query($sqlAssureurChiffres2013)->fetch(\PDO::FETCH_ASSOC);

// Assureur chiffres
$sqlAssureurChiffres2014 = "SELECT * FROM assureurs_chiffres WHERE assureurId=" . $_GET['id'] . " AND exercice=2014";
$assureurChiffres2014 = $db->query($sqlAssureurChiffres2014)->fetch(\PDO::FETCH_ASSOC);

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/jquery-ui.structure.min.css" />
        <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/jquery-ui.theme.min.css" />
        <link rel="stylesheet" type="text/css" href="https://infoprime.ch/comparateur/web/css/styles.css" />
        <meta charset="utf-8" />
    </head>
    <body>
<!-- infosAssureurs.php -->
        <h3>Coordonnées de la compagnie d'assurance <span class=""><?php echo($assureurs['name']); ?></span></h3>
<?php
        echo('<h5 class="txt-blue"><strong>' . $assureurs['name'] . '</strong></h5>');
        if($assureurs['cp'] !== ''){
            echo($assureurs['cp']);
            echo('<br/>');
        }
        echo('Adresse :<br/>');
        echo($assureurs['adresse']);
        echo('<br/>');
        echo($assureurs['npa'] . ' ' . $assureurs['localite']);
        echo('<br/>');
        echo('<br/>');
        echo('Tel : <a href="tel://' . $assureurs['tel'] . '">' . $assureurs['tel'] . '</a>');
        echo('<br/>');
        echo('Fax : ' . $assureurs['fax']);
        echo('<br/>');
        echo('Mail : <a href="mailto://' . $assureurs['email'] . '">' . $assureurs['email'] . '</a>');
        echo('<br/>');
        echo('Site : <a href="http://' . $assureurs['site'] . '" target="_blank">' . $assureurs['site'] . '</a>');

?>

        <hr>
        <p><strong><?php echo($_GET['economies'] > 0?'Possibilité de dépense jusqu\'a : CHF <span class="txt-red">' . number_format($_GET['economies'], 2, ".", "'") . '</span>':'Possibilité d\'épargner jusqu\'a : CHF <span class="txt-green">' . number_format(abs($_GET['economies']), 2, ".", "'") . '</span>'); ?></strong></p>
        <br>
        <div class="text-center">
          <button type="button" class="button-87 float-center" onclick="document.getElementById('form-1').submit();">Demander une offre</button>
          <br>
        </div>
		<script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery-2.1.1.js"></script>
        <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/infoprime-modal.js"></script>
        <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/fonctions.js"></script>
        <script type="text/javascript" src="https://infoprime.ch/comparateur/web/js/app.js"></script>
    </body>
</html>
