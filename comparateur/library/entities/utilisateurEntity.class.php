<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class utilisateurEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class utilisateurEntity extends entity {
 
    /**
     * Constantes
     */
    const INVALID_LOGIN             = 1;
    const INVALID_PASSWORD          = 2;
    const INVALID_PASSWORD_VALIDATE = 3;
    const INVALID_GROUPE_ID         = 4;
    const INVALID_GROUPE_NAME       = 5;
    const INVALID_STATE             = 6;
    const INVALID_EXISTING_LOGIN    = 7;
    
    /**
     * @access public
     * @var string - Nom d'utilisateur
     */
    public $login;
    
    /**
     * @access public
     * @var string - Mot de passe de l'utilisateur
     */
    public $password;
    
    /**
     * @access public
     * @var string - Mot de passe de validation de l'utilisateur
     */
    public $passwordValidate;
    
    /**
     * @access public
     * @var string - Identifiant du groupe d'utilisateurs
     */    
    public $utilisateurGroupeId;
    
     /**
     * @access public
     * @var string - Nom du groupe d'utilisateurs
     */   
    public $utilisateurGroupeName;
    
    /**
     * @access public
     * @var boolean - Etat de l'utilisateur
     */    
    public $state;
    
    /**
     * @access public
     * @var \DateTime - Date de création de l'utilisateur
     */
    public $dateCreation;
    
    /**
     * @access public
     * @var \DateTime - Date de modification de l'utilisateur
     */
    public $dateModification;
    
    /**
     * getLogin() - Retourne le nom d'utilisateur
     * @access public
     * @return string - Nom d'utilisateur
     */
    public function getLogin(){
        return $this->login;
    }
    
    /**
     * getPassword() - Retourne le mot de passe de l'utilisateur
     * @access public
     * @return string - Mot de passe de l'utilisateur
     */
    public function getPassword(){
        return $this->password;
    }    
    
    /**
     * getPasswordValidate() - Retourne le mot de passe de validation de l'utilisateur
     * @access public
     * @return string - Mot de passe de l'utilisateur
     */
    public function getPasswordValidate(){
        return $this->passwordValidate;
    }    

    /**
     * getUtilisateurGroupeId() - Retourne l'identifiant du groupe d'utilisateurs
     * @access public
     * @return string - Identifiant du groupe d'utilisateurs
     */    
    public function getUtilisateurGroupeId(){
        return $this->utilisateurGroupeId;
    }

    /**
     * getUtilisateurGroupeName() - Retourne le nom du groupe d'utilisateurs
     * @access public
     * @return string - Nom du groupe d'utilisateurs
     */    
    public function getUtilisateurGroupeName(){
        return $this->utilisateurGroupeName;
    }
    
    /**
     * getState() - Retourne l'état de l'utilisateur
     * @return type
     */
    public function getState(){
        return $this->state;
    }
    
    /**
     * getDateCreation() - Retourne la date de création de l'utilisateur
     * @access public
     * @return \DateTime - Date de création de l'utilisateur
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }

    /**
     * getDateModification() - Retourne la date de modification de l'utilisateur
     * @access public
     * @return \DateTime - Date de modification de l'utilisateur
     */
    public function getDateModification(){
        return $this->dateModification;
    }
    
    /**
     * setLogin() - Définit le nom d'utilisateur
     * @access public
     * @param type $login - Nom d'utilisateur
     * @return void
     */
    public function setLogin($login){
        if(empty($login) || !is_string($login)){
            $this->_errors[] = self::INVALID_LOGIN;
        }else{
            $this->login = $login;
        }
    }
    
    /**
     * setPassword() - Définit le mot de passe de l'utilisateur
     * @access public
     * @param int $password
     * @return void
     */
    public function setPassword($password){
        if(empty($password) || !is_string($password)){
            $this->_errors[] = self::INVALID_PASSWORD;
        }else{
            $this->password = $password;
        }
    }
    
    /**
     * setPasswordValidate() - Définit le mot de passe de validation de l'utilisateur
     * @access public
     * @param int $passwordValidate
     * @return void
     */
    public function setPasswordValidate($passwordValidate){
        if(empty($passwordValidate) || !is_string($passwordValidate) || $this->password != $passwordValidate){
            $this->_errors[] = self::INVALID_PASSWORD_VALIDATE;
        }else{
            $this->passwordValidate = $passwordValidate;
        }
    }

    /**
     * setUtilisateurGroupeId() - Définit l'identifiant du groupe d'utilisateurs
     * @access public
     * @param int $id - Identifiant du groupe d'utilisateurs
     * @return void
     */    
    public function setUtilisateurGroupeId($id){
        if(empty($id) || !is_numeric($id) || $id == '-1'){
            $this->_errors[] = self::INVALID_GROUPE_ID;
        }else{
            $this->utilisateurGroupeId = $id;
        }        
    }

    /**
     * setUtilisateurGroupeName() - Définit le nom du groupe d'utilisateurs
     * @access public
     * @param string $name - Nom du groupe d'utilisateurs
     * @return void
     */    
    public function setUtilisateurGroupeName($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_GROUPE_NAME;
        }else{
            $this->utilisateurGroupeName = $name;
        }        
    }

    /**
     * setState() - Définit l'état de l'utilisateurs
     * @access public
     * @param string $state - Etat de l'utilisateurs
     * @return void
     */    
    public function setState($state){
        if(!is_bool($state)){
            $this->_errors[] = self::INVALID_STATE;
        }else{
            $this->state = $state;
        }        
    }
    
    /**
     * setDateCreation() - Définit la date de création de l'utilisateur
     * @access public
     * @param \DateTime $dateCreation - Date de création de l'utilisateur
     * @return void
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification de l'utilisateur
     * @access public
     * @param \DateTime $dateModification - Date de modification de l'utilisateur
     * @return void
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }
}
