<?php

// Inclut les constantes
require_once 'library/constantes.php';

// Vérifie si le debugging est activé
if(DEBUG_ENABLED){
    // Inclut le gestionnaire d'erreurs
    require_once 'library/my_error_handler.php';
    // Définit un gestionnaire d'erreurs
    set_error_handler('my_error_handler');
    // Fixe le niveau de rapport d'erreurs PHP
    error_reporting(E_ALL);
    // Modifie la valeur d'une option de configuration
    ini_set("display_errors", 'on');

}else{
    // Fixe le niveau de rapport d'erreurs PHP
    error_reporting(E_ALL);
    // Définit que les erreurs ne doivent pas s'afficher à l'écran
    ini_set('display_errors', 'off');
    // Définit l'activation de la sauvegarde des logs
    ini_set('log_errors', 'on');
    // Définit le chemin de sauvegarde du log
    ini_set('error_log', 'web/error/file.log');
}
// Inclut la fonction d'autochargement des classes
require_once 'library/autoload.php';

// Instancie l'application
$app = new \library\application\frontendApplication();

// Démarre l'application
$app->run('applications/frontend/config/routes.xml');