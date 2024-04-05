<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class courtierEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class conseillerEntity extends entity{
    
    /**
     * Constantes
     */
    const INVALID_NOM       = 1;
    const INVALID_PRENOM    = 2;
    const INVALID_ADRESSE   = 3;
    const INVALID_NPA       = 4;
    const INVALID_VILLE     = 5;
   
    /**
     * @access protected
     * @var string - 
     */
    public $nom;
    
    /**
     * @access protected
     * @var type 
     */
    public $prenom;
    
    /**
     * @access protected
     * @var type 
     */
    public $adresse;
    
    /**
     * @access protected
     * @var type 
     */
    public $npa;
    
    /**
     * @access protected
     * @var type 
     */
    public $ville;
    
    /**
     * @access protected
     * @var type 
     */
    public $dateCreation;
    
    /**
     * @access protected
     * @var type 
     */
    public $dateModification;
    
    /**
     * getNom() - Retourne le nom
     * @access public
     * @return string
     */
    public function getNom(){
        return $this->nom;
    }
    
    /**
     * getPrenom() - Retourne le prénom
     * @access public
     * @return type
     */
    public function getPrenom(){
        return $this->prenom;
    }
    
    /**
     * getAdresse() - Retourne l'adresse
     * @access public
     * @return string
     */
    public function getAdresse(){
        return $this->adresse;
    }
    
    /**
     * getNpa() - Retourne le numéro postal
     * @access public
     * @return string
     */
    public function getNpa(){
        return $this->npa;
    }

    /**
     * getVille() - Retourne la ville
     * @access public
     * @return string
     */
    public function getVille(){
        return $this->ville;
    }
    
    /**
     * getDataCreation() - Retourne la date de création
     * @access public
     * @return \DateTime
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    /**
     * getDataModification() - Retourne la date de modification
     * @access public
     * @return \DateTime
     */
    public function getDateModification(){
        return $this->dateModification;
    }
    
    /**
     * setNom() - Définit le nom
     * @access public
     * @param string $nom
     */
    public function setNom($nom){
        if(empty($nom) || !is_string($nom)){
            $this->_errors[] = self::INVALID_NOM;            
        } else {
            $this->nom = $nom;
        }
    }
    
    /**
     * setPrenom() - Définit le prénom
     * @access public
     * @param string $prenom
     */
    public function setPrenom($prenom){
        if(empty($prenom) || !is_string($prenom)){
            $this->_errors[] = self::INVALID_PRENOM;
        } else {
            $this->prenom = $prenom;
        }
    }
    
    /**
     * setAdresse() - Définit l'adresse
     * @access public
     * @param string $adresse
     */
    public function setAdresse($adresse){
        if(empty($adresse) || !is_string($adresse)){
            $this->_errors[] = self::INVALID_ADRESSE;
        } else {
            $this->adresse = $adresse;
        }
    }

    /**
     * setNpa() - Définit le numéro postal
     * @access public
     * @param string $npa
     */
    public function setNpa($npa){
        if(empty($npa) || !is_string($npa)){
            $this->_errors[] = self::INVALID_NPA;
        }else {
            $this->npa = $npa;
        }        
    }

    /**
     * setVille() - Définit la ville
     * @access public
     * @param string $ville
     */
    public function setVille($ville){
        if(empty($ville) || !is_string($ville)){
            $this->_errors[] = self::INVALID_VILLE;
        }else {
            $this->ville = $ville;
        }        
    }
    
    /**
     * setDateCreation() - Définit la date de création
     * @access public
     * @param \DateTime $dateCreation
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de création
     * @access public
     * @param \DateTime $dateModification
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }
}