<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class clientEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class clientEntity extends entity{
    
    /**
     * Constantes
     */
    const INVALID_CIVILITE_ID               = 1;
    const INVALID_LANGUE_CORRESPONDANCE_ID  = 2;
    const INVALID_NATIONALITE_ID            = 3;
    const INVALID_STATUS_ID                 = 4;
    const INVALID_USER_ID                   = 5;
    const INVALID_NOM                       = 6;
    const INVALID_PRENOM                    = 7;
    const INVALID_ADRESSE                   = 8;
    const INVALID_NPA                       = 9;
    const INVALID_VILLE                     = 10;
    const INVALID_TELEPONE                  = 11;
    const INVALID_IMAGE                     = 12;
    const INVALID_EMAIL                     = 13; 
    const INVALID_DATE_NAISSANCE            = 14;
    const INVALID_DATE_CREATION             = 15;
    const INVALID_DATE_MODIFICATION         = 16;
    
    /**
     * @access private
     * @var int - Identifiant de la civilité
     */
    private $civiliteId;    
    
    /**
     * @access private
     * @var int - Indentifiant de la langue de correspondance
     */
    private $langueCorrespondanceId;    
    
    /**
     * @access private
     * @var int - Identifiant de la nationalité
     */
    private $nationaliteId;
    
    /**
     * @access public
     * @var int - Identifiant du status
     */
    private $statusId;
    
    /**
     * @access private
     * @var int - Identifiant de l'utilisateur
     */
    private $userId;
    
    /**
     * @access private
     * @var string - Nom du client
     */
    private $nom;
    
    /**
     * @access private
     * @var string - Prénom du client
     */
    private $prenom;
    
    /**
     * @access private
     * @var string - Adresse du client
     */
    private $adresse;
    
    /**
     * @access private
     * @var string - Numéro postal du client
     */
    private $npa;
    
    /**
     * @access private
     * @var string - Ville du client
     */
    private $ville;
    
    /**
     * @access private
     * @var string - Téléphone du client
     */    
    private $telephone;
    
    /**
     * @access private
     * @var string - Adresse email du client
     */
    private $email;
    
    /**
     * @access private
     * @var string - Image du client
     */
    private $image;
    
    /**
     * @access private
     * @var \DateTime - Date de naissance du client
     */
    private $dateNaissance;
    
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
     * getCiviliteId() - Retourne l'identifiant de la civilité
     * @access public
     * @return int - Identifiant de la civilité
     */
    public function getCiviliteId(){
        return $this->civiliteId;
    }    

    /**
     * getLangueCorrespondanceId() - Retourne l'identifiant de la langue de correspondance
     * @access public
     * @return int - Identifiant de la langue de correspondance
     */
    public function getLangueCorrespondanceId(){
        return $this->langueCorrespondanceId;
    }    
    
    /**
     * getNAtionaliteId() - Retourne l'identifiant de la nationalité
     * @access public
     * @return int - Identifiant de la nationalité
     */
    public function getNationaliteId(){
        return $this->nationaliteId;
    }    
    
    /**
     * getStatusId() - Retourne l'identifiant du status client
     * @access public
     * @return int - Identifiant du status client
     */
    public function getStatusId(){
        return $this->statusId;
    }
    
    /**
     * getUserId() - Retourne l'identifiant de l'utilisateur
     * @access public
     * @return int - Identifiant de l'utilisateur
     */
    public function getUserId(){
        return $this->userId;
    }

    /**
     * getNom() - Retourne le nom du client
     * @access public
     * @return string - Nom du client
     */
    public function getNom(){
        return $this->nom;
    }
    
    /**
     * getPrenom() - Retourne le prénom du client
     * @access public
     * @return string - Prénom du client
     */
    public function getPrenom(){
        return $this->prenom;
    }
    
    /**
     * getAdresse() - Retourne l'adresse du client
     * @access public
     * @return string - Adresse du client
     */
    public function getAdresse(){
        return $this->adresse;
    }
    
    /**
     * getNpa() - Retourne le numéro postal du client
     * @access public
     * @return string - Numéro postal du client
     */
    public function getNpa(){
        return $this->npa;
    }

    /**
     * getVille() - Retourne la ville du client
     * @access public
     * @return string - Ville du client
     */
    public function getVille(){
        return $this->ville;
    }

    /**
     * getTelephone() - Retourne le numéro de téléphone du client
     * @access public
     * @return string - Numéro de téléphone du client
     */
    public function getTelephone(){
        return $this->telephone;
    }

    /**
     * getEmail() - Retourne l'adresse email du client
     * @access public
     * @return string - Adresse email du client
     */
    public function getEmail(){
        return $this->email;
    }    

    /**
     * getImage() - Retourne l'url de l'image
     * @access public
     * @return string - Url de l'immage du client
     */
    public function getImage(){
        return $this->image;
    }    

    /**
     * getDateNaissance() - Retourne la date de naissance du client
     * @access public
     * @return \DateTime - Date de naissance du client
     */
    public function getDateNaissance(){
        return $this->dateNaissance;
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
     * setCiviliteId() - Définit l'identifiant de la civilité du client
     * @access public
     * @param int $id - Identifiant de la civilité du client
     */
    public function setCiviliteId($id){
        if(empty($id) || !is_numeric($id) || $id === '-1'){
            $this->_errors[] = self::INVALID_CIVILITE_ID;
        }else {
            $this->civiliteId = $id;
        }        
    }    

    /**
     * setLangueCorrespondanceId() - Définit l'identifiant de la langue de correspondance
     * @access public
     * @param int $id - Identifiant de la langue de correspondance
     */
    public function setLangueCorrespondanceId($id){
        if(empty($id) || !is_numeric($id) || $id === '-1'){
            $this->_errors[] = self::INVALID_LANGUE_CORRESPONDANCE_ID;
        }else {
            $this->langueCorrespondanceId = $id;
        }        
    }    
    
    /**
     * setNationaliteId() -Définit l'identifiant de la nationalité
     * @access public
     * @param type $id - Identifiant de la nationalité 
    */
    public function setNationaliteId($id){
        if(empty($id) || !is_numeric($id) || $id === '-1'){
            $this->_errors[] = self::INVALID_NATIONALITE_ID;            
        } else {
            $this->nationaliteId = $id;
        }        
    }    
    
    /**
     * setStatusId() - Définit l'identifiant du status client
     * @access public
     * @param int $id - Identifiant du status client
     */
    public function setStatusId($id){
        if(empty($id) || !is_numeric($id) || $id == '-1'){
            $this->_errors[] = self::INVALID_STATUS_ID;
        }else {
            $this->statusId = $id;
        }        
    }      
    
    /**
     * setUserId() -Définit l'identifiant de l'utilisateur
     * @access public
     * @param type $id - Identifiant de l'utilisateur
     */
    public function setUserId($id){
        if(!is_numeric($id)){
            $this->_errors[] = self::INVALID_USER_ID;            
        } else {
            $this->userId = $id;
        }        
    }
    
    /**
     * setNom() - Définit le nom du client
     * @access public
     * @param string $nom - Nom du client
     */
    public function setNom($nom){
        if(empty($nom) || !is_string($nom)){
            $this->_errors[] = self::INVALID_NOM;            
        } else {
            $this->nom = $nom;
        }
    }
    
    /**
     * setPrenom() - Définit le prénom du client
     * @access public
     * @param string $prenom - Prénom du client
     */
    public function setPrenom($prenom){
        if(empty($prenom) || !is_string($prenom)){
            $this->_errors[] = self::INVALID_PRENOM;
        } else {
            $this->prenom = $prenom;
        }
    }
    
    /**
     * setAdresse() - Définit l'adresse du client
     * @access public
     * @param string $adresse - Adresse du client
     */
    public function setAdresse($adresse){
        if(empty($adresse) || !is_string($adresse)){
            $this->_errors[] = self::INVALID_ADRESSE;
        } else {
            $this->adresse = $adresse;
        }
    }

    /**
     * setNpa() - Définit le numéro postal du client
     * @access public
     * @param string $npa - Numéro postal du client
     */
    public function setNpa($npa){
        if(empty($npa) || !is_string($npa)){
            $this->_errors[] = self::INVALID_NPA;
        }else {
            $this->npa = $npa;
        }        
    }

    /**
     * setVille() - Définit la ville du client
     * @access public
     * @param string $ville - Ville du client
     */
    public function setVille($ville){
        if(empty($ville) || !is_string($ville)){
            $this->_errors[] = self::INVALID_VILLE;
        }else {
            $this->ville = $ville;
        }        
    }
    
    /**
     * setTelephone() - Définit le téléphone du client
     * @access public
     * @param string $telephone - Téléphone du client
     */
    public function setTelephone($telephone){
        if(empty($telephone) || !is_string($telephone)){
            $this->_errors[] = self::INVALID_TELEPONE;
        }else {
            $this->telephone = $telephone;
        }        
    }

    /**
     * setEmail() - Définit l'adresse email du client
     * @access public
     * @param string $email - Adresse email du client
     */
    public function setEmail($email){
        if(empty($email) || !is_string($email)){
            $this->_errors[] = self::INVALID_EMAIL;
        }else {
            $this->email = $email;
        }        
    }       

    /**
     * setImage() - Définit l'url de l'image du client
     * @access public
     * @param string $image - Url de l'image du client
     */
    public function setImage($image){
        //if(empty($image) || !is_string($image)){
            //$this->_errors[] = self::INVALID_IMAGE;
        //}else {
            $this->image = $image;
        //}        
    }       
    
    /**
     * setDateNaissance() - Définit la date de naissance du client
     * @access public
     * @param \DateTime $dateNaissance du client
     */
    public function setDateNaissance(\DateTime $dateNaissance){
        $this->dateNaissance = $dateNaissance;
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