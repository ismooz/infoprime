<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class clientEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class assureurEntity extends entity{
    
    /**
     * Constantes
     */
    const INVALID_NAME              = 1;
    const INVALID_DATE_CREATION     = 2;
    const INVALID_DATE_MODIFICATION = 3;
    const INVALID_EXISTING_NAME     = 4;
    
    /**
     * @access private
     * @var string $name - Nom de l'assureur
     */
    private $name;
    
    /**
     * @access private
     * @var \DateTime - Date de création de la police
     */
    private $dateCreation;
    
    /**
     * @access private
     * @var \DateTime - Date de modification de la police
     */
    private $dateModification;

    /**
     * getCiviliteId() - Retourne le nom de l'assureur
     * @access public
     * @return int - Identifiant de l'assureur
     */
    public function getName(){
        return $this->name;
    }  
    
    /**
     * getDataCreation() - Retourne la date de création du client
     * @access public
     * @return \DateTime - Date de création du client
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    /**
     * getDataModification() - Retourne la date de modification du client
     * @access public 
     * @return \DateTime - Date de modification du client
     */
    public function getDateModification(){
        return $this->dateModification;
    }

    /**
     * setName() - Définit le nom de l'assureur
     * @access public
     * @param string $name - Nom de l'assureur
     */
    public function setName($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_NAME;
        }else {
            $this->name = $name;
        }        
    }
    
    /**
     * setDateCreation() - Définit la date de création du client
     * @access public
     * @param \DateTime $dateCreation - Date de création du client
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification du client
     * @access public
     * @param \DateTime $dateModification - Date de modification du client
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }
}