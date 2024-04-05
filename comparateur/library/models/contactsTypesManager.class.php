<?php

namespace library\models;
use library\managers\managers;
use library\entities\contactTypeEntity;

/**
 * Abstract class contactTypesManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class contactsTypesManager extends managers {

    /**
     * add() - Ajoute un type demande de contact 
     * @abstract
     * @access protected
     * @param contactTypeEntity $contactType
     * @return void
     */    
    abstract public function add(contactTypeEntity $contactType);      
    
    /**
     * count() - Retourne le nombre de types demande de contact
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de types demande de contact
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un type demande de contact
     * @abstract
     * @access public
     * @param int $id - identifiant du type demande de contact
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie un type demande de contact
     * @abstract
     * @access public
     * @param contactTypeEntity $contactType
     * @return void
     */
    abstract public function modify(contactTypeEntity $contactType);    
    
    /**
     * save() - Sauvegarde un type demande de contact
     * @access public
     * @param contactTypeEntiy $contactType
     * @throws \RuntimeException
     */
    public function save(contactTypeEntity $contactType){
        if($contactType->isValid()){
            $contactType->isNew() ? $this->add($contactType) : $this->modify($contactType);
        } else {
            throw new \RuntimeException('Ce type demande de contact doit être valide avant d\'être enregistrée !');
        }
    }
}