<?php

namespace library\models;
use library\managers\managers;
use library\entities\contactEtatEntity;

/**
 * Abstract class contactsEtatsManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class contactsEtatsManager extends managers {

    /**
     * add() - Ajoute un état demande de contact 
     * @abstract
     * @access protected
     * @param contactEtatEntity $contactEtat
     * @return void
     */    
    abstract public function add(contactEtatEntity $contactEtat);      
    
    /**
     * count() - Retourne le nombre d'états demande de contact
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre d'états demande de contact
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un état demande de contact
     * @abstract
     * @access public
     * @param int $id - identifiant de l'état demande de contact
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie un état demande de contact
     * @abstract
     * @access public
     * @param contactEtatEntity $contactEtat
     * @return void
     */
    abstract public function modify(contactEtatEntity $contactEtat);    
    
    /**
     * save() - Sauvegarde un état demande de contact
     * @access public
     * @param contactEtatEntiy $contactEtat
     * @throws \RuntimeException
     */
    public function save(contactEtatEntity $contactEtat){
        if($contactEtat->isValid()){
            $contactEtat->isNew() ? $this->add($contactEtat) : $this->modify($contactEtat);
        } else {
            throw new \RuntimeException('Cet état demande de contact doit être valide avant d\'être enregistrée !');
        }
    }
}