<?php

namespace library\application;
use library\users\userAdmin;

/**
 * Class BackendApplication
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class backendApplication extends application {
    
    /**
     * Constructor
     * @access public
     */
    public function __construct() {
        parent::__construct();
        // On définit le nom de l'application
        $this->_name = 'backend';
        // On instancie l'utilisateur
        $this->_user = new userAdmin();
    }

    /**
     * @access public
     * @param string $filename
     */
    public function run($filename) {
        if($this->_user->isAuthenticated()){
            $controller = $this->getController($filename);
        } else {
            $controller = new \applications\backend\modules\connexion\connexionController($this, 'connexion', 'index');
        }
        $controller->execute();
        $this->_response->setPage($controller->getPage());
        $this->_response->send();        
    }
}