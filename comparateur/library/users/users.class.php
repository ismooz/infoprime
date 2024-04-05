<?php

namespace library\users;

/**
 * Abstract class users
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class users {

    /**
     * getAttribute() - Retourne un attribut de l'utilisateur 
     * @access public
     * @param string $attr
     * @return string|null
     */
    public function getAttribute($attr){
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : NULL;
    }
    
    /**
     * getFlash() - Retourne
     * @access public
     * @return type
     */
    public function getFlash(){
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    
    /**
     * hasFlash() -
     * @access public
     * @return booléan
     */
    public function hasFlash(){
        return isset($_SESSION['flash']);
    }
    
    /**
     * isAuthenticated() - Retourne l'état de l'autentification
     * @abstract
     * @access public
     */
    abstract public function isAuthenticated();
    
    /**
     * setAttribute() -
     * @access public
     * @param type $attr
     * @param type $value
     */
    public function setAttribute($attr, $value){
        $_SESSION[$attr] = $value;
    }
    
    /**
     * setAuthenticated() - Définit l'état de l'authentification
     * @abstract
     * @access public
     */
    abstract public function setAuthenticated($authenticated = true);    
    
    /**
     * stFlash() -
     * @access public
     * @param type $value
     */
    public function setFlash($value){
        $_SESSION['flash'] = $value;
    }
}
