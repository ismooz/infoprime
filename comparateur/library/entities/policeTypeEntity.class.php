<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class contactTypeEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class policeTypeEntity extends entity {
    
    /**
     * Constantes
     */
    const INVALID_NAME              = 1;
    const INVALID_DATE_CREATION     = 2;
    const INVALID_DATE_MODIFICATION = 3;
    const INVALID_EXISTING_NAME     = 4;
   
    /**
     * @access protected
     * @var string - Nom du type de contact
     */
    public $name;
    
    /**
     * @access protected
     * @var \DateTime - Date de création du type de contact
     */
    public $dateCreation;
    
    /**
     * @access protected
     * @var \DateTime - Date de modification du type de contact
     */
    public $dateModification;
    
    /**
     * getName() - Retourne le nom du status de contact
     * @access public
     * @return string - Nom du status de contact
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * getDataCreation() - Retourne la date de création du status de contact
     * @access public
     * @return \DateTime - Date de création du status de contact
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    /**
     * getDataModification() - Retourne la date de modification du status de contact
     * @access public
     * @return \DateTime - Date de modification du status de contact
     */
    public function getDateModification(){
        return $this->dateModification;
    }
    
    /**
     * setName() - Définit le nom du status de contact
     * @access public
     * @param string $name - Nom du status de contact
     */
    public function setName($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_NAME;            
        } else {
            $this->name = $name;
        }
    }
    
    /**
     * setDateCreation() - Définit la date de création du status de contact
     * @access public
     * @param \DateTime $dateCreation - Date de création du status de contact
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification du status de contact
     * @access public
     * @param \DateTime $dateModification - Date de modification du status de contact
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }    
}
