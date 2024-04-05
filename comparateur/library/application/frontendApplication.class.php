<?php

namespace library\application;
use library\users\userDefault;

/**
 * Class FrontendApplication
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class frontendApplication extends application {
    
    /**
     * Constructor
     * @access public
     * @param \Library\Application\Application $application
     */
    public function __construct() {
        parent::__construct();
        // On définit le nom de l'application
        $this->_name = 'frontend';
        // On instancie l'utilisateur
        $this->_user = new userDefault();        
    }
    
    /**
     * @access public
     * @param string $filename
     */
    public function run($filename){
        // On récupère le controller de l'application
        $controller = $this->getController($filename);
        // On execute le controller
        $controller->execute();
        // Assignation de la page crée par le controller à la réponse
        $this->_response->setPage($controller->getPage());
        // Envoi de la réponse
        $this->_response->send();        
    }
}