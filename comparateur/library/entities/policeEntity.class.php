<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class policeEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class policeEntity extends entity{
    
    /**
     * Constantes
     */
    const INVALID_ASSUREUR_ID       = 1;
    const INVALID_COMNSEILLER_ID    = 2;
    const INVALID_CONSEILLER_NAME   = 3;
    const INVALID_POLICE_TYPE_ID    = 4;
    const INVALID_POLICE_TYPE_NAME  = 5;
    const INVALID_POLICE_NO         = 6;
    const INVALID_PRIME             = 7;
    const INVALID_DATE_DEBUT        = 8;
    const INVALID_DATE_FIN          = 9;
    const INVALID_DATE_RESILIATION  = 10;
    const INVALID_DATE_CREATION     = 11;
    const INVALID_DATE_MODIFICATION = 12;
    
    /**
     * @access private
     * @var int - Identifiant de l'assureur de la police
     */
    private $assureurId; 
    
     /**
     * @access private
     * @var string - Nom de l'assureur de la police
     */   
    private $assureurName;
    
    /**
     * @access private
     * @var int - Indentifiant du conseiller de la police
     */
    private $conseillerId;       

    /**
     * @access private
     * @var string - Nom du conseiller de la police
     */
    private $conseillerName;       
    
    /**
     * @access private
     * @var int - Identifdiant de la branche de la police
     */
    private $policeTypeId;
    
    /**
     * @access private
     * @var string - Nom du type de la police
     */    
    private $policeTypeName;
    
    /**
     * @access private
     * @var string  - Numéro de la police d'assurance de la police
     */
    private $police;
    
    /**
     * @access private
     * @var decimal 
     */
    private $prime;
    
    /**
     * @access private
     * @var \DateTime - Date de début de la police
     */
    private $dateDebut;
    
    /**
     * @access private
     * @var \DateTime - Date de fin de la police
     */
    private $dateFin;
    
    /**
     * @access private
     * @var \DateTime - Date de résiliation de la police
     */
    private $dateResiliation;
    
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
     * getAssureurId() - Retourne l'identifiant de l'assureur de la police
     * @access public
     * @return int - Identifiant de l'assureur de la police
     */
    public function getAssureurId(){
        return $this->assureurId;
    }    
    
    /**
     * getAssureurName() - Retourne le nom de l'assureur de la police
     * @access public
     * @return string - Nom de l'assureur de la police
     */    
    public function getAssureurName(){
        return $this->assureurName;
    }
    
    /**
     * getConseillerId() - Retourne l'identifiant du conseiller
     * @access public
     * @return int
     */
    public function getConseillerId(){
        return $this->conseillerId;
    }     
    
    /**
     * getConseillerName() - Retourne le nom du conseiller
     * @access public
     * @return string
     */
    public function getConseillerName(){
        return $this->conseillerName;
    }     
    
    /**
     * getPoliceTypeId() - Retourne l'identifiant de la branche de la polcie
     * @access public
     * @return int - Identifiant de la branche de la police
     */
    public function getPoliceTypeId(){
        return $this->policeTypeId;
    }
    
    /**
     * getPoliceTypeName() - Retourne le nom du type de la polcie
     * @access public
     * @return int - Nom du type de police
     */
    public function getPoliceTypeName(){
        return $this->policeTypeName;
    }    

    /**
     * getPolice() - Retourne le numéro de police
     * @access public
     * @return string - Numéro de la police
     */
    public function getPolice(){
        return $this->police;
    }
    
    /**
     * getPrime() - Retourne la prime de la police
     * @access public
     * @return string - Prime de la police
     */    
    public function getPrime(){
        return $this->prime;
    }
    
    /**
     * getDateDebut() - Retourne la date de début de la police
     * @access public
     * @return string - Date de début de la police
     */
    public function getDateDebut(){
        return $this->dateDebut;
    }
    
    /**
     * getDateFin() - Retourne la date de fin de la police
     * @access public
     * @return string - Date de fin de la police
     */
    public function getDateFin(){
        return $this->dateFin;
    }
    
    /**
     * getDateResiliation() - Retourne la date de résiliation de la police
     * @access public
     * @return string - Date de résiliation de la police
     */
    public function getDateResiliation(){
        return $this->dateResiliation;
    }
    
    /**
     * getDataCreation() - Retourne la date de création de la police
     * @access public
     * @return \DateTime - Date de création de la police
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    /**
     * getDataModification() - Retourne la date de modification de la police
     * @access public
     * @return \DateTime - Date de modification de la police
     */
    public function getDateModification(){
        return $this->dateModification;
    }

    /**
     * setAssureurId() - Définit l'identifiant de l'assureur de la police
     * @access public
     * @param int $assureurId - Identifiant de l'assureur de la police
     */
    public function setAssureurId($assureurId){
        if(empty($assureurId) || !is_numeric($assureurId) || $assureurId == '-1'){
            $this->_errors[] = self::INVALID_ASSUREUR_ID;
        }else {
            $this->assureurId = $assureurId;
        }        
    } 

    /**
     * setAssureurId() - Définit le nom de l'assureur de la police
     * @access public
     * @param int $name - Nom de l'assureur de la police
     */
    public function setAssureurName($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_ASSUREUR_ID;
        }else {
            $this->assureurName = $name;
        }        
    } 
    
    /**
     * setConseillerId() - Définit l'identifiant du conseiller de la police
     * @access public
     * @param int $id - Identifiant du conseiller de la police
     */
    public function setConseillerId($id){
        if(empty($id) || !is_numeric($id) || $id == '-1'){
            $this->_errors[] = self::INVALID_CONSEILLER_ID;
        }else {
            $this->conseillerId = $id;
        }        
    }     
    
    /**
     * setConseillerId() - Définit le nom du conseiller de la police
     * @access public
     * @param string $name - Nom du conseiller de la police
     */
    public function setConseillerName($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_CONSEILLER_NAME;
        }else {
            $this->conseillerName = $name;
        }        
    }       
    
    /**
     * setBrancheId() - Définit l'identifiant du type de police
     * @access public
     * @param type $policeTypeId - Identifiant du type de police
     */
    public function setPoliceTypeId($policeTypeId){
        if(empty($policeTypeId) || !is_numeric($policeTypeId) || $policeTypeId == '-1'){
            $this->_errors[] = self::INVALID_POLICE_TYPE_ID;            
        } else {
            $this->policeTypeId = $policeTypeId;
        }        
    }
    
    /**
     * setPoliceTypeName() - Définit le nom du type de police
     * @access public
     * @param type $name - Nom du type de police
     */
    public function setPoliceTypeName($name){
        if(empty($name) || !is_string($name)){
            $this->_errors[] = self::INVALID_POLICE_TYPE_ID;            
        } else {
            $this->policeTypeName = $name;
        }        
    }
    
    /**
     * setPoliceNo() - Définit le numéro de police
     * @access public
     * @param string $nom - Numéro de la police
     */
    public function setPolice($nom){
        if(empty($nom) || !is_string($nom)){
            $this->_errors[] = self::INVALID_POLICE_NO;            
        } else {
            $this->police = $nom;
        }
    }
    
    /**
     * setPrime() - Définit la prime de la police
     * @access public
     * @param string $prime - Prime de la police
     */
    public function setPrime($prime){
        if(empty($prime) || !is_string($prime) || !is_numeric($prime)){
            $this->_errors[] = self::INVALID_PRIME;            
        } else {
            $this->prime = $prime;
        }
    }    
    
    /**
     * setDateDebut() - Définit la date de début de la police
     * @access public
     * @param \DateTime $dateDebut - Date de début de la police
     */
    public function setDateDebut($dateDebut){
        if(empty($dateDebut) || ($dateDebut instanceof \DateTime) == false){
            $this->_errors[] = self::INVALID_DATE_DEBUT;
        }else{
            $this->dateDebut = $dateDebut;
        }
    }
    
    /**
     * setDateFin() - Définit le date de fin de la police
     * @access public
     * @param \DateTime $dateFin - Date de fin de la police
     */
    public function setDateFin($dateFin){
        if(empty($dateFin) || ($dateFin instanceof \DateTime) == false){
            $this->_errors[] = self::INVALID_DATE_FIN;
        }else{
            $this->dateFin = $dateFin;
        }
    }

    /**
     * setDateResiliation() - Définit la date de résiliation de la police
     * @access public
     * @param \DateTime $dateResiliation - Date de résilitation de la police
     */
    public function setDateResiliation($dateResiliation){
        if(empty($dateResiliation) || ($dateResiliation instanceof \DateTime) == false){
            $this->_errors[] = self::INVALID_DATE_RESILIATION;        
        }else{
            $this->dateResiliation = $dateResiliation;
        }
    }  
    
    /**
     * setDateCreation() - Définit la date de création de la police
     * @access public
     * @param \DateTime $dateCreation - Date de création de la police
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification de la police
     * @access public
     * @param \DateTime $dateModification - Date de modification de la police
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }
}