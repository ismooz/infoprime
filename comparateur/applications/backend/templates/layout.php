<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/library/bootstrap-3.3.4/css/bootstrap.min.css" />       
        <!-- <link rel="stylesheet" type="text/css" href="/comparateur/web/library/bootstrap-3.3.4/css/bootstrap-theme.min.css" /> -->       
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/jquery-ui.structure.min.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/jquery-ui.theme.min.css" />        
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/jquery.jqplot.min.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/library/easypiechart/jquery.easy-pie-chart.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/library/morris.js-0.5.1/morris.js-0.5.1/morris.css" />
        <link rel="stylesheet" type="text/css" href="/comparateur/web/css/styles.css" /> 
        <meta charset="utf-8" />
        <?php
            // Vérifie si une variable de titre à été définie
            if(isset($title)){
                echo('<title>Syntesis - ' . $title . '</title>' . "\r\n");
            }else{
                echo('<title>Syntesis</title>' . "\r\n");
            }
        ?>
    </head>
    <body>
        <div class="container">
<?php
// Vérifie si un message flash à été définit
if($user->hasFlash()){
    echo '<p class="flash">', $user->getFlash(), '</p>';
}
// Vérifie que l'utilisateur soit identifié
if($user->isAuthenticated()):
?>
            <div class="row">
                <header>
                    <h3 class="txt-center">Comparateur d'assurance maladie</h3>
                    <nav class="menu">
                        <ul>
                            <li onclick="document.location.href='/comparateur/admin/home/'">Accueil</li>
                            <li>Système
                                <ul>
                                    <li onclick="document.location.href='/comparateur/admin/assureurs/'">Assureurs</li>
                                    <li>Clients
                                        <ul>
                                            <li onclick="document.location.href='/comparateur/admin/clientsStatus/'">Status de clients</li>
                                        </ul>
                                    </li>
                                    <li>Demandes de contacts
                                        <ul>
                                            <li onclick="document.location.href='/comparateur/admin/contactsEtats/'">Etats de demande de contact</li>
                                            <li onclick="document.location.href='/comparateur/admin/contactsTypes/'">Types de demande de contact</li>                                        
                                        </ul>
                                    </li>
                                    <li onclick="document.location.href='/comparateur/admin/langues/'">Langues</li>
                                    <li onclick="document.location.href='/comparateur/admin/nationalites/'">Nationalités</li>
                                    <li>Polices
                                        <ul>
                                            <li onclick="document.location.href='/comparateur/admin/policesTypes/'">Types de polices</li>                                        
                                        </ul>                                
                                    </li>
                                    <li>
                                        Utilisateurs
                                        <ul>
                                            <li onclick="document.location.href='/comparateur/admin/utilisateurs/'">Utilisateurs</li>
                                            <li class="separation"></li>
                                            <li onclick="document.location.href='/comparateur/admin/utilisateursGroupes/'">Groupes d'utilisateurs</li>                                        
                                        </ul>                                 
                                    </li>
                                    <li class="separation"></li>
                                    <li onclick="document.location.href='/comparateur/admin/parametres/'">Paramètres</li>
                                </ul>                        
                            </li>
                            <li>Comparateur
                                <ul>
                                    <li onclick="document.location.href='/comparateur/admin/primes/'">Primes</li>
                                    <li onclick="document.location.href='/comparateur/admin/regions/'">Régions</li>                                
                                    <li class="separation"></li>
                                    <li onclick="document.location.href='/comparateur/admin/comparateur/options/'">Options</li>
                                </ul>   
                            </li>
                            <li>
                                Outils
                                <ul>
                                    <li onclick="document.location.href='/comparateur/admin/clients/'">Clients</li>
                                    <li onclick="document.location.href='/comparateur/admin/conseillers/'">Conseillers</li>                       
                                    <li onclick="document.location.href='/comparateur/admin/contacts/'">Demandes de contact</li>
                                    <li onclick="document.location.href='/comparateur/admin/polices/'">Polices</li>
                                </ul>                              
                            </li>
                            <li onclick="document.location.href='/comparateur/admin/home/contact/'">Contact</li>
                            <li class="right" onclick="document.location.href='/comparateur/admin/connexion/deconnexion/'">Déconnexion</li>
                        </ul>
                    </nav>
                </header>
            </div>
<?php
endif;
// Affiche le contenu de la page
echo $content;
?>
            <footer class="txt-center">
                Copyright © <a href="http://www.syntesis.ch" target="_blank">Syntesis Management SA</a> - Tous droits réservés
            </footer>
        </div>
        <script type="text/javascript" src="/comparateur/web/js/jquery-2.1.1.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/jqplot.barRenderer.min.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/jqplot.categoryAxisRenderer.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/jqplot.dateAxisRenderer.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/jquery.autocomplete.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
        <script type="text/javascript" src="/comparateur/web/library/easypiechart/jquery.easy-pie-chart.js"></script>
        <script type="text/javascript" src="/comparateur/web/library/morris.js-0.5.1/morris.js-0.5.1/morris.js"></script>
        <script type="text/javascript" src="/comparateur/web/js/fonctions.js"></script>        
        <script type="text/javascript" src="/comparateur/web/js/app.js"></script>        
    </body>
</html>