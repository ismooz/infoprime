<?php

namespace library\entities;
use library\entities\entity;

/**
 * Class contactEntity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class contactEntity extends entity {
 
    /**
     * Constantes
     */
    const INVALID_TYPE_ID           = 1;
    const INVALID_ETAT_ID           = 2;
    const INVALID_NOM               = 3;
    const INVALID_EMAIL             = 4;
    const INVALID_COMMENTAIRE       = 5;
    const INVALID_NOM_TYPE          = 6;
    const INVALID_NOM_ETAT          = 7;
    const INVALID_DATE_CREATION     = 8;
    const INVALID_DATE_MODIFICATION = 9;
    
    /**
     * @access private
     * @var string - Nom du contact
     */
    private $nom;
    
    /**
     * @access private
     * @var string - Adresse email du contact
     */
    private $email;
    
    /**
     * @access private
     * @var string - Commentaire du contact
     */
    private $commentaire;
    
    /**
     * @access private
     * @var string - Nom du type du contact
     */
    private $nomType;
    
    /**
     * @access private
     * @var string - Nom de l'état du contact 
     */
    private $nomEtat;
    
    /**
     * @access private
     * @var int - Identifiant du type de contact
     */
    private $typeId;
    
    /**
     * @access private
     * @var int  - Identifiant de l'état du contact
     */
    private $etatId;
    
    /**
     * @access private
     * @var \DateTime - Date de création du contact
     */
    private $dateCreation;
    
    /**
     * @access private
     * @var \DateTime - Date de modification du contact
     */
    private $dateModification;
    
    /**
     * getNom() - Retourne le nom du contact
     * @access public
     * @return type - Nom du contact
     */
    public function getNom(){
        return $this->nom;
    }
    
    /**
     * getEmail() - Retourne l'adresse email du contact
     * @access public
     * @return type - Adrese email du contact
     */
    public function getEmail(){
        return $this->email;
    }
    
    /**
     * getCommentaire() - Retourne le commentaire du contact
     * @access public
     * @return type - Commentaire du contact
     */
    public function getCommentaire(){
        return $this->commentaire;
    }
    
    /**
     * getNomType() - Retourne le nom du type du contact
     * @return type
     */
    public function getNomType(){
        return $this->nomType;
    }
    
    /**
     * getNomEtat() - Retourne le nom de l'état du contact
     * @return type
     */
    public function getNomEtat(){
        return $this->nomEtat;
    }
    
    /**
     * getTypeId() - Retourne l'identifiant du type de contact
     * @access public
     * @return int - Identifiant du type de contact
     */
    public function getTypeId(){
        return $this->typeId;
    }
    
    /**
     * getEtat() - Retourne l'identifiant de l'état du contact
     * @access public
     * @return int - Identifiant de l'état du contact
     */
    public function getEtatId(){
        return $this->etatId;
    }
    
    
    
    /**
     * getDateCreation() - Retourne la date de création du contact
     * @access public
     * @return \DateTime - Date de création du contact
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }

    /**
     * getDateModification() - Retourne la date de modification du contact
     * @access public
     * @return \DateTime - Date de modification du contact
     */
    public function getDateModification(){
        return $this->dateModification;
    }
    
    /**
     * setNom() - Définit le nom du contact
     * @access public
     * @param string $nom - Nom du contact
     */
    public function setNom($nom){
        if(empty($nom) || !is_string($nom)){
            $this->_errors[] = self::INVALID_NOM;
        }else{
            $this->nom = $nom;
        }
    }
    
    /**
     * setEmail() - Définit l'adresse email du contact
     * @access public
     * @param string $email - Adresse email du contact
     */
    public function setEmail($email){
        if(empty($email) || !is_string($email)){
            $this->_errors[] = self::INVALID_EMAIL;
        }else{
            $this->email = $email;
        }
    }    
    
    /**
     * setCommentaire() - Définit le commentaire du contact
     * @access public
     * @param string $commentaire - Commentaire du contact
     */
    public function setCommentaire($commentaire){
        if(empty($commentaire) || !is_string($commentaire)){
            $this->_errors[] = self::INVALID_COMMENTAIRE;
        }else{
            $this->commentaire = $commentaire;
        }
    }

    /**
     * setNomType() - Définit le nom du type du contact
     * @access public
     * @param string $nom - Nom du type du contact
     */
    public function setNomType($nom){
        if(empty($nom) || !is_string($nom)){
            $this->_errors[] = self::INVALID_NOM_TYPE;
        }else{
            $this->nomType = $nom;
        }
    }
    
    /**
     * setNomEtat() - Définit le nom de l'état du contact
     * @access public
     * @param string - Nom de l'état du contact
     */
    public function setNomEtat($nomEtat){
        if(empty($nomEtat) || !is_string($nomEtat)){
            $this->_errors[] = self::INVALID_NOM_ETAT;
        }else{
            $this->nomEtat = $nomEtat;
        }        
    }
    
    /**
     * setTypeId() - Définit l'identifiant du type de contact
     * @access public
     * @param int $typeId - Identifiant du type de contact
     */
    public function setTypeId($typeId){
        if(empty($typeId) || !is_numeric($typeId) || $typeId == '-1'){
            $this->_errors[] = self::INVALID_TYPE_ID;
        }else{
            $this->typeId = $typeId;
        }
    }
    
    /**
     * setEtatId() - Définit l'identifiant de l'état du contact
     * @access public
     * @param int $etatId - Identifiant de l'état du contact
     */
    public function setEtatId($etatId){
        if(empty($etatId) || !is_numeric($etatId) || $etatId == '-1'){
            $this->_errors[] = self::INVALID_ETAT_ID;
        }else{
            $this->etatId = $etatId;
        }
    }
    
    /**
     * setDateCreation() - Définit la date de création du contact
     * @access public
     * @param \DateTime $dateCreation -  Date de création du contact
     */
    public function setDateCreation(\DateTime $dateCreation){
        $this->dateCreation = $dateCreation;
    }
    
    /**
     * setDateModification() - Définit la date de modification du contact
     * @access public
     * @param \DateTime $dateModification - Date de création du contact
     */
    public function setDateModification(\DateTime $dateModification){
        $this->dateModification = $dateModification;
    }
}
