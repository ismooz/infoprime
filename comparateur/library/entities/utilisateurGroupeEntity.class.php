<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class clientsStatusEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class utilisateurGroupeEntity extends entity {
    
    /**
     * Constantes
     */
    const INVALID_NAME              = 1;
    const INVALID_DATE_CREATION     = 2;
    const INVALID_DATE_MODIFICATION = 3;
    const INVALID_EXISTING_NAME     = 4;
    
    /**
     * @access protected
     * @var type - Nom du groupe d'utilisateurs
     */
    public $name;
    
    /**
     * @access protected
     * @var type - Date de création du groupe d'utilisateurs
     */
    public $dateCreation;
    
    /**
     * @access protected
     * @var type - Date de modification du groupe d'utilisateurs
     */
    public $dateModification;
    
    /**
     * getName() - Retourne le nom du groupe d'utilisateurs
     * @access public
     * @return string - Nom du groupe d'utilisateurs
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * getDataCreation() - Retourne la date de création du groupe d'utilisateurs
     * @access public
     * @return \DateTime - Date de création du groupe d'utilisateurs
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    /**
     * getDataModification() - Retourne la date de modification du groupe d'utilisateurs
     * @access public
     * @return \DateTime - Date de modification du grooupe d'utilisateurs
     */
    public function getDateModification(){
        return $this->dateModification;
    }
    
    /**
     * setLogin() - Définit le nom du groupe d'utilisateurs
     * @access public
     * @param string $name - Nom du groupe d'utilisateurs
     */
    public function setName($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_NAME;            
        } else {
            $this->name = $name;
        }
    }
    
    /**
     * setDateCreation() - Définit la date de création du groupe d'utilisateurs
     * @access public
     * @param \DateTime $dateCreation - Date de création du groupe d'utilisateurs
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification du groupe d'utilisateurs
     * @access public
     * @param \DateTime $dateModification - Date de modification du groupe d'utilisateurs
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }    
}
