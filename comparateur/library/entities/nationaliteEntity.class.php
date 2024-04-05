<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class nationaliteEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class nationaliteEntity extends entity{
    
    /**
     * Constantes
     */
    const INVALID_NAME_DE   = 1;
    const INVALID_NAME_EN   = 2;
    const INVALID_NAME_FR   = 3;
    const INVALID_NAME_IT   = 4;
   
    /**
     * @access protected
     * @var string - Nom de la nationalité en Allemand
     */
    public $name_de;
    
    /**
     * @access protected
     * @var string - Nom de la nationalité en Anglais
     */
    public $name_en;
    
    /**
     * @access protected
     * @var string - Nom de la nationalité en Français
     */
    public $name_fr;
    
    /**
     * @access protected
     * @var string - Nom de la nationalité en Italien
     */
    public $name_it;
    
    /**
     * @access protected
     * @var \DateTime - Date de création de la nationalité 
     */
    public $dateCreation;
    
    /**
     * @access protected
     * @var \DateTime - Date de modification de la nationalité
     */
    public $dateModification;
    
    /**
     * getNameDe() - Retourne le nom de la nationalité en Allemand
     * @access public
     * @return string - Nom de la nationalité en Allemand
     */
    public function getNameDe(){
        return $this->name_de;
    }
    
    /**
     * getNameEn() - Retourne le nom de la nationalité en Anglais
     * @access public
     * @return string - Nom de la nationalité en Anglais
     */
    public function getNameEn(){
        return $this->name_en;
    }
    
    /**
     * getNameFr() - Retourne le nom de la nationalité en Français
     * @access public
     * @return string - Nom de la nationalité en Français
     */
    public function getNameFr(){
        return $this->name_fr;
    }
    
    /**
     * getNameIt() - Retourne le nom de la nationalité en Italien
     * @access public
     * @return string - Nom de la nationalité en Italien
     */
    public function getNameIt(){
        return $this->name_it;
    }
    
    /**
     * getDataCreation() - Retourne la date de création de la nationalité
     * @access public
     * @return \DateTime - Date de création de la nationalité
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    /**
     * getDataModification() - Retourne la date de modification de la nationalité
     * @access public
     * @return \DateTime - Date de modification de la nationalité
     */
    public function getDateModification(){
        return $this->dateModification;
    }
    
    /**
     * setNameDe() - Définit le nom de la nationalité en Allemand
     * @access public
     * @param string $name - Nom de la nationalité en Allemand
     */
    public function setNameDe($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_NAME_DE;            
        } else {
            $this->name_de = $name;
        }
    }
    
    /**
     * setNameEn() - Définit le nom de la nationalité en Anglais
     * @access public
     * @param string $name - Nom de la nationalité en Anglais
     */
    public function setNameEn($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_NAME_EN;
        } else {
            $this->name_en = $name;
        }
    }
    
    /**
     * setNameFr() - Définit le nom de la nationalité en Français
     * @access public
     * @param string $name - Nom de la nationalité en Français
     */
    public function setNameFr($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_NAME_FR;
        } else {
            $this->name_fr = $name;
        }
    }

    /**
     * setNameIt() - Définit le nom de la nationalité en Italien
     * @access public
     * @param string $name - Nom de la nationalité en Italien
     */
    public function setNameIt($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_NAME_IT;
        }else {
            $this->name_it = $name;
        }        
    }
    
    /**
     * setDateCreation() - Définit la date de création de la nationalité
     * @access public
     * @param \DateTime $dateCreation - Date de création de la nationalité
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification de la nationalité
     * @access public
     * @param \DateTime $dateModification - Date de modification de la nationalité
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }
}