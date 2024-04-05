<?php

namespace library\models;
use library\managers\managers;

/**
 * Abstract class contactManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class connexionManager extends managers {
    
    /**
     * getUser() - Retourne les information d'authentification
     * @abstract
     * @access protected
     * @param string $login
     * @return array/false
     */    
    abstract public function getUser($login);
}