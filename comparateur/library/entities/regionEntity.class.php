<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class regionEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class regionEntity extends entity{
    
    /**
     * Constantes
     */
    const INVALID_NPA       = 1;
    const INVALID_LOCALITE  = 2;
    const INVALID_CANTON    = 3;
    const INVALID_REGION    = 4;
    const INVALID_NO_OFS    = 5;
    const INVALID_COMMUNE   = 6;
    const INVALID_DISTRICT  = 7;
   
    /**
     * @access protected
     * @var string - Numéro postal de la région
     */
    public $npa;
    
    /**
     * @access protected
     * @var string - Localité de la région
     */
    public $localite;
    
    /**
     * @access protected
     * @var string - Canton de la région
     */
    public $canton;
    
    /**
     * @access protected
     * @var string - Région
     */
    public $region;
    
    /**
     * @access protected
     * @var string - Numéro OFS de la région
     */
    public $no_ofs;
    
    /**
     * @access protected
     * @var string - Commune de la région
     */
    public $commune;
    
    /**
     * @access protected
     * @var string - District de la région
     */
    public $district;
    
    /**
     * @access protected
     * @var \DateTime - Date de création de la région
     */
    public $dateCreation;
    
    /**
     * @access protected
     * @var \DateTime - Date de modification de la région
     */
    public $dateModification;
    
    /**
     * getNpa() - Retourne le numéro postal de la région
     * @access public
     * @return string - Numéro postal de la région
     */
    public function getNpa(){
        return $this->npa;
    }
    
    /**
     * getLocalite() - Retourne la localité de la région
     * @access public
     * @return string - Localité de la région
     */
    public function getLocalite(){
        return $this->localite;
    }
    
    /**
     * getCanton() - Retourne le canton de la région
     * @access public
     * @return string - Canton de la région
     */
    public function getCanton(){
        return $this->canton;
    }
    
    /**
     * getRegion() - Retourne la région
     * @access public
     * @return string - Région
     */
    public function getRegion(){
        return $this->region;
    }
    
    /**
     * getNoOfs() - Retourne le numéro OFS de la région
     * @access public
     * @return string - Numéro OFS de la région
     */
    public function getNoOfs(){
        return $this->no_ofs;
    }
    
    /**
     * getCommune() - Retourne la commune de la région
     * @access public
     * @return string - Commune de la région
     */
    public function getCommune(){
        return $this->commune;
    }
    
    /**
     * getDistrict() - Retourne le district de la région
     * @access public
     * @return string - District de la région
     */
    public function getDistrict(){
        return $this->district;
    }
    
    /**
     * getDataCreation() - Retourne la date de création de la région
     * @access public
     * @return \DateTime - Date de création de la région
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    /**
     * getDataModification() - Retourne la date de modification de la région
     * @access public
     * @return \DateTime - Date de modification de la région
     */
    public function getDateModification(){
        return $this->dateModification;
    }
    
    /**
     * setNpa() - Définit le numéro postal de la région
     * @access public
     * @param string $npa - Numéro postal de la région
     */
    public function setNpa($npa){
        if(empty($npa) || !is_string($npa)){
            $this->npa = self::INVALID_NPA;            
        } else {
            $this->npa = $npa;
        }
    }
    
    /**
     * setLocalite() - Définit la localité de la région
     * @access public
     * @param string $localite - Localité de la région
     */
    public function setLocalite($localite){
        if(empty($localite) || !is_string($localite)){
            $this->localite = self::INVALID_LOCALITE;
        } else {
            $this->localite = $localite;
        }
    }
    
    /**
     * setCanton() - Définit le canton de la région
     * @access public
     * @param string $canton - Canton de la région
     */
    public function setCanton($canton){
        if(empty($canton) || !is_string($canton)){
            $this->canton = self::INVALID_CANTON;
        } else {
            $this->canton = $canton;
        }
    }

    /**
     * setRegion() - Définit la région
     * @access public
     * @param string $region
     */
    public function setRegion($region){
        if(empty($region) || !is_string($region)){
            $this->region = self::INVALID_REGION;
        }else {
            $this->region = $region;
        }        
    }

    /**
     * setNoOfs() - Définit le numéro ofs de la région
     * @access public
     * @param string $no_ofs - Numéro OFS de la région
     */
    public function setNoOfs($no_ofs){
        if(empty($no_ofs) || !is_string($no_ofs)){
            $this->no_ofs = self::INVALID_NO_OFS;
        }else {
            $this->no_ofs = $no_ofs;
        }        
    }

    /**
     * setNoOfs() - Définit la commune de la région
     * @access public
     * @param string $commune - Commune de la région
     */
    public function setCommune($commune){
        if(empty($commune) || !is_string($commune)){
            $this->commune = self::INVALID_COMMUNE;
        }else {
            $this->commune = $commune;
        }        
    }

    /**
     * setNoOfs() - Définit le district de la région
     * @access public
     * @param string $district - District de la région
     */
    public function setDistrict($district){
        if(empty($district) || !is_string($district)){
            $this->district = self::INVALID_DISTRICT;
        }else {
            $this->district = $district;
        }        
    }
    
    /**
     * setDateCreation() - Définit la date de création de la région
     * @access public
     * @param \DateTime $dateCreation - Date de création de la région
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification de la région
     * @access public
     * @param \DateTime $dateModification - Date de modification de la région
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }
}