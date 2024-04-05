<?php
//var_dump($_SERVER);
?>
<!doctype html>
<html>
    <head>
        <!--<link rel="stylesheet" type="text/css" href="/comparateur/web/css/reset.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="/comparateur/web/css/base.css" />-->
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/library/bootstrap-3.3.4/css/bootstrap.min.css" />
        <!--<link rel="stylesheet" type="text/css" href="/comparateur/web/library/bootstrap-3.3.4/css/bootstrap-theme.min.css" />-->
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/jquery-ui.structure.min.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/jquery-ui.theme.min.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/styles.css" /> 
        <meta charset="utf-8" />
        <?php
            // Vérifie si un titre est définit
            if(isset($title)){
                echo('<title>Syntesis - ' . $title . '</title>' . "\r\n");
            }else{
                echo('<title>Syntesis</title>' . "\r\n");
            }
        ?>
    </head>
    <body>
<?php
// Vérifie si l'utilisateur a un message flash
if($user->hasFlash()){
    echo '<p class="flash">' . $user->getFlash() . '</p>';
}
?>
        <div class="container-fluid navbar-economies">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-default" role="banner">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="/comparateur/"><img src="/comparateur/web/images/Logo-Syntesis-2015-300x82.png" alt="Economies" width="157" heigth="43" /></a>
                        </div>            
                        <div class="collapse navbar-collapse" id="navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="/comparateur/">Accueil<span class="sr-only">(current)</span></a></li>
<?php
    // Vérifie que l'utilisateur soit authentifié
    if($user->isAuthenticated()):
?>
                                <li><a href="/comparateur/comparateur/profil/">Mes assurances</a></li>
                                <li><a href="/comparateur/comparateur/comparaisons/">Mes demandes</a></li>
<?php
    else:
?>
                                <li><a href="/comparateur/home/inscription/">Inscription</a></li>
<?php
    endIf;
?>
                                <li><a href="/comparateur/home/infos/">Infos utiles</a></li>
                                <li><a href="/comparateur/home/contact/">Contact</a></li>
<?php
    // Vérifie que l'utilisateur soit authentifié
    if($user->isAuthenticated()):
?>                               
                                <li class="right"><a href="/comparateur/home/deconnexion/">Déconnexion</a></li>
<?php
    endif;
?>
                                <li><a href=""><span class="fa fa-search"></span></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="slider">
            
        </div>
<?php    
// Affiche le contenu de la page
echo $content;
?>
        <div class="container-fluid economies-black">
            <div class="container">
                <footer>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            © <a href="http://www.syntesis.ch" target="_blank">Syntesis Management SA</a> - Tous droits réservés
                        </div>
                        <div class="col-md-6 col-sm-6 hidden-xs txt-center">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href=""><span class="fa fa-facebook"></span></a></li>
                                <li><a href=""><span class="fa fa-twitter"></span></a></li>
                                <li><a href=""><span class="fa fa-rss"></span></a></li>
                            </ul>                 
                        </div>  
                    </div>
                </footer>
            </div>
        </div>
        <script type="text/javascript" src="/comparateur/web/js/jquery-2.1.1.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/fonctions.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/app.js"></script>
    </body>
</html>