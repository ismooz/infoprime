<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class primeEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class primeEntity extends entity{
    
    /**
     * Constantes
     */
    const INVALID_ASSUREUR_ID       = 1;
    const INVALID_CANTON            = 2;
    const INVALID_EXERCICE          = 3;
    const INVALID_ENQUETE           = 4;
    const INVALID_REGION            = 5;
    const INVALID_CLASSE_AGE        = 6;
    const INVALID_ACCIDENT          = 7;
    const INVALID_TARIF             = 8;
    const INVALID_TARIF_TYPE        = 9;
    const INVALID_GROUPE_AGE        = 10;
    const INVALID_ETAT_FRANCHISE    = 11;
    const INVALID_FRANCHISE         = 12;
    const INVALID_PRIME             = 13;
    const INVALID_SORTE             = 14;
    const INVALID_ESTBASEP          = 15;
    const INVALID_ESTBASEF          = 16;
    const INVALID_NOM_TARIF         = 17;
   
    /**
     * @access protected
     * @var int - Identifiant de l'assureur de la prime
     */
    public $assureurId;
    
    /**
     * @access protected
     * @var string - Canton de la prime
     */
    public $canton;
    
    /**
     * @access protected
     * @var string - Exercice de la prime
     */
    public $exercice;
    
    /**
     * @access protected
     * @var string - Enquête de la prime
     */
    public $enquete;
    
    /**
     * @access protected
     * @var string - Région de la prime
     */
    public $region;
    
    /**
     * @access protected
     * @var string - Classe d'age de la prime
     */
    public $classe_age;
    
    /**
     * @access protected
     * @var string - Accident de la prime
     */    
    public $accident;

    /**
     * @access protected
     * @var string - Tarif de la prime
     */
    public $tarif;
    
    /**
     * @access protected
     * @var string - Tarif-type de la prime
     */    
    public $tarif_type;
    
    /**
     * @access protected
     * @var string - Groupe d'age de la prime
     */    
    public $groupe_age;
    
    /**
     * @access protected
     * @var string - Etat de franchise de la prime
     */
    public $etat_franchise;
    
    /**
     * @access protected
     * @var string - Franchise de la prime
     */
    public $franchise;
    
    /**
     * @access protected
     * @var string - Prime
     */
    public $prime;
    
    /**
     * @access protected
     * @var string - Sorte de prime
     */
    public $sorte;
    
    /**
     * @access protected
     * @var string
     */
    public $estBaseP;
    
    /**
     * @access protected
     * @var string
     */
    public $estBaseF;
    
    /**
     * @access protected
     * @var string - Nom du tarif de la prime
     */
    public $nom_tarif;
    
    /**
     * @access protected
     * @var \DateTime - Date de création de la prime
     */
    public $dateCreation;
    
    /**
     * @access protected
     * @var \DateTime - Date de modification de la prime
     */
    public $dateModification;
    
    /**
     * getAssureurId() - Retourne l'identifiant de l'assureur de la prime
     * @access public
     * @return int - Identifiant de l'assureur de la prime
     */
    public function getAssureurId(){
        return $this->assureurId;
    }
    
    /**
     * getCanton() - Retourne le canton de la prime
     * @access public
     * @return string - Canton de la prime
     */
    public function getCanton(){
        return $this->canton;
    }
    
    /**
     * getExercice() - Retourne l'exercice de la prime
     * @access public
     * @return string - Execice de la prime
     */
    public function getExercice(){
        return $this->exercice;
    }
    
    /**
     * getEnquete() - Retourne l'enquête de la prime
     * @access public
     * @return string - Enquête de la prime
     */
    public function getEnquete(){
        return $this->enquete;
    }
    
    /**
     * getRegion() - Retourne la région de la prime
     * @access public
     * @return string - Région de la prime
     */
    public function getRegion(){
        return $this->region;
    }
    
    /**
     * getClasseAge() - Retourne la classe d'age de la prime
     * @access public
     * @return string - Classe d'age de la prime
     */
    public function getClasseAge(){
        return $this->classe_age;
    }
    
    /**
     * getAccident() - Retourne l'accident de la prime
     * @access public
     * @return string - Accident de la prime
     */
    public function getAccident(){
        return $this->accident;
    }
    
    /**
     * getTarif() - Retourne le tarif de la prime
     * @access public
     * @return string - Tarif de la prime
     */
    public function getTarif(){
        return $this->tarif;
    }
    
    /**
     * getTarif() - Retourne le tarif-type de la prime
     * @access public
     * @return string - Tarif-type de la prime
     */
    public function getTarifType(){
        return $this->tarif_type;
    }
    
    /**
     * getGroupeAge() - Retourne le groupe d'age de la prime
     * @access public
     * @return string - Groupe d'age de la prime
     */    
    public function getGroupeAge(){
        return $this->groupe_age;
    }
    
    /**
     * getEtatFranchise() - Retourne l'état de la franchise de la prime
     * @access public
     * @return string - Etat de la franchise de la prime
     */    
    public function getEtatFranchise(){
        return $this->etat_franchise;
    }

    /**
     * getFranchise() - Retourne la franchise de la prime
     * @access public
     * @return string - Franchise de la prime
     */    
    public function getFranchise(){
        return $this->franchise;
    }

    /**
     * getPrime() - Retourne la prime
     * @access public
     * @return string - Prime
     */    
    public function getPrime(){
        return $this->prime;
    }

    /**
     * getSorte() - Retourne la sorte de prime
     * @access public
     * @return string - Sorte de prime
     */    
    public function getSorte(){
        return $this->sorte;
    }

    /**
     * getEstBaseP() - Retourne 
     * @access public
     * @return string
     */    
    public function getEstBaseP(){
        return $this->estBaseP;
    }

    /**
     * getEstBaseF() - Retourne 
     * @access public
     * @return string
     */    
    public function getEstBaseF(){
        return $this->estBaseP;
    }

    /**
     * getEstBaseF() - Retourne le nom du tarif de la prime
     * @access public
     * @return string - Nom du tarif de la prime
     */    
    public function getNomTarif(){
        return $this->nom_tarif;
    }
    
    /**
     * getDataCreation() - Retourne la date de création de la prime
     * @access public
     * @return \DateTime - Date de création de la prime
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    /**
     * getDataModification() - Retourne la date de modification de la prime
     * @access public
     * @return \DateTime - Date de modificaion de la prime
     */
    public function getDateModification(){
        return $this->dateModification;
    }
    
    /**
     * setAssureurId() - Définit l'identifiant de l'assureur de la prime
     * @access public
     * @param int $id - Identifiant de l'assureur de la prime
     */
    public function setAssureurId($id){
        if(empty($id) || !is_string($id)){
            $this->assureurId = self::INVALID_ASSUREUR_ID;            
        } else {
            $this->assureurId = $id;
        }
    }
    
    /**
     * setCanton() - Définit le canton de la prime
     * @access public
     * @param string $canton - Canton de la prime
     */
    public function setCanton($canton){
        if(empty($canton) || !is_string($canton)){
            $this->canton = self::INVALID_CANTON;
        } else {
            $this->canton = $canton;
        }
    }
    
    /**
     * setExercice() - Définit l'exercice de la prime
     * @access public
     * @param string $exercice - Exercice de la prime
     */
    public function setExercie($exercice){
        if(empty($exercice) || !is_string($exercice)){
            $this->exercice = self::INVALID_EXERCICE;
        } else {
            $this->exercice = $exercice;
        }
    }

    /**
     * setRegion() - Définit l'enquête de la prime
     * @access public
     * @param string $enquete - Enquête de la prime
     */
    public function setEnquete($enquete){
        if(empty($enquete) || !is_string($enquete)){
            $this->enquete = self::INVALID_ENQUETE;
        }else {
            $this->enquete = $enquete;
        }        
    }

    /**
     * setRegion() - Définit la région de la prime
     * @access public
     * @param string $region - Région de la prime
     */
    public function setRegion($region){
        if(empty($region) || !is_string($region)){
            $this->region = self::INVALID_REGION;
        }else {
            $this->region = $region;
        }        
    }

    /**
     * setClasseAge() - Définit la classe d'age de la prime
     * @access public
     * @param string $classe_age - Classe d'age de la prime
     */
    public function setClasseAge($classe_age){
        if(empty($classe_age) || !is_string($classe_age)){
            $this->classe_age = self::INVALID_CLASSE_AGE;
        }else {
            $this->classe_age = $classe_age;
        }        
    }

    /**
     * setAccident() - Définit l'accident de la prime
     * @access public
     * @param string $accident - Accident de la prime
     */
    public function setAccident($accident){
        if(empty($accident) || !is_string($accident)){
            $this->accident = self::INVALID_ACCIDENT;
        }else {
            $this->accident = $accident;
        }        
    }

    /**
     * setTarif() - Définit le tarif de la prime
     * @access public
     * @param string $tarif - Tarif de la prime
     */
    public function setTarif($tarif){
        if(empty($tarif) || !is_string($tarif)){
            $this->tarif = self::INVALID_TARIF;
        }else {
            $this->tarif = $tarif;
        }        
    }    
    
    /**
     * setTarifType() - Définit le tarif type de la prime
     * @access public
     * @param string $tarif_type - Tatif-type de la prime
     */
    public function setTarifType($tarif_type){
        if(empty($tarif_type) || !is_string($tarif_type)){
            $this->tarif_type = self::INVALID_TARIF_TYPE;
        }else {
            $this->tarif_type = $tarif_type;
        }        
    }    

    /**
     * setGroupeAge() - Définit le groupe d'age de la prime
     * @access public
     * @param string $groupe_age - Groupe d'age de la prime
     */
    public function setGroupeAge($groupe_age){
        if(empty($groupe_age) || !is_string($groupe_age)){
            $this->groupe_age = self::INVALID_GROUPE_AGE;
        }else {
            $this->groupe_age = $groupe_age;
        }        
    }    
    
    /**
     * setEtatFranchise() - Définit l'état de la franchise de la prime
     * @access public
     * @param string $etat_franchise - Etat de la franchise de la prime
     */
    public function setEtatFranchise($etat_franchise){
        if(empty($etat_franchise) || !is_string($etat_franchise)){
            $this->etat_franchise = self::INVALID_ETAT_FRANCHISE;
        }else {
            $this->etat_franchise = $etat_franchise;
        }        
    }    
    
    /**
     * setFranchise() - Définit la franchise de la prime
     * @access public
     * @param string $franchise - Franchise de la prime
     */
    public function setFranchise($franchise){
        if(empty($franchise) || !is_string($franchise)){
            $this->franchise = self::INVALID_FRANCHISE;
        }else {
            $this->franchise = $franchise;
        }        
    }    
    
    /**
     * setPrime() - Définit la prime
     * @access public
     * @param decimal $prime
     */
    public function setPrime($prime){
        if(empty($prime) || !is_string($prime)){
            $this->prime = self::INVALID_PRIME;
        }else {
            $this->prime = $prime;
        }        
    }    
    
    /**
     * setSorte() - Définit la sorte de la prime
     * @access public
     * @param string $sorte - Sorte de la prime
     */
    public function setSorte($sorte){
        if(empty($sorte) || !is_string($sorte)){
            $this->sorte = self::INVALID_SORTE;
        }else {
            $this->sorte = $sorte;
        }        
    }    
    
    /**
     * setEstBaseP() - Définit 
     * @access public
     * @param string $estBaseP
     */
    public function setEstBaseP($estBaseP){
        if(empty($estBaseP) || !is_string($estBaseP)){
            $this->estBaseP = self::INVALID_ESTBASEP;
        }else {
            $this->estBaseP = $estBaseP;
        }        
    }    
    
    /**
     * setEstBaseF() - Définit 
     * @access public
     * @param string $estBaseF
     */
    public function setEstBaseF($estBaseF){
        if(empty($estBaseF) || !is_string($estBaseF)){
            $this->estBaseF = self::INVALID_ESTBASEF;
        }else {
            $this->estBaseF = $estBaseF;
        }        
    }    
    
    /**
     * setNomTarif() - Définit le nom du tarif de la prime
     * @access public
     * @param string $nom_tarif - Nom du tarif de la prime
     */
    public function setNomTarif($nom_tarif){
        if(empty($nom_tarif) || !is_string($nom_tarif)){
            $this->nom_tarif = self::INVALID_NOM_TARIF;
        }else {
            $this->nom_tarif = $nom_tarif;
        }        
    }    
    
    /**
     * setDateCreation() - Définit la date de création de la prime
     * @access public
     * @param \DateTime $dateCreation - Date de création de la prime
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification de la prime
     * @access public
     * @param \DateTime $dateModification - Date de modification de la prime
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }
}