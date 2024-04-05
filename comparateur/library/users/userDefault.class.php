<?php

namespace library\users;
use library\users\users;

/**
 * Class User
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class userDefault extends users {
    
    /**
     * isAuthenticated() - Retourne 
     * @access public
     * @return booléan
     */
    public function isAuthenticated(){
        return isset($_SESSION['auth']) && $_SESSION['auth'] == true;
    }    
    
    /**
     * setAuthentificated() -
     * @access public
     * @param type $authenticated
     * @throws \InvalidArgumentException
     */
    public function setAuthenticated($authenticated = true){
        if(!is_bool($authenticated)){
            throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
        }
        $_SESSION['auth'] = $authenticated;
    }
}