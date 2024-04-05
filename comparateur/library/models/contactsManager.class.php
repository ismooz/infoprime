<?php

namespace library\models;
use library\managers\managers;
use library\entities\contactEntity;

/**
 * Abstract class contactManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class contactsManager extends managers {

    /**
     * add() - Ajoute une demande de contact 
     * @abstract
     * @access protected
     * @param contactEntity $contact
     * @return void
     */    
    abstract public function add(contactEntity $contact);      
    
    /**
     * count() - Retourne le nombre de demandes de contact
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de contacts
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime une demande de contact
     * @abstract
     * @access public
     * @param int $id - identifiant du client
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie une demande de contact
     * @abstract
     * @access public
     * @return void
     */
    abstract public function modify(contactEntity $contact);    
    
    /**
     * save() - Sauvegarde une demande de contact
     * @access public
     * @param contactEntity $contact
     * @throws \RuntimeException
     */
    public function save(contactEntity $contact){
        if($contact->isValid()){
            $contact->isNew() ? $this->add($contact) : $this->modify($contact);
        } else {
            throw new \RuntimeException('Ce contact doit être valide avant d\'être enregistrée !');
        }
    }
}