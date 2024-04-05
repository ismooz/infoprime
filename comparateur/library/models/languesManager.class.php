<?php

namespace library\models;
use library\managers\managers;
use library\entities\langueEntity;

/**
 * Abstract class langueManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class languesManager extends managers {

    /**
     * add() - Ajoute une langue
     * @abstract
     * @access protected
     * @param langueEntity $langue
     * @return void
     */    
    abstract public function add(langueEntity $langue);      
    
    /**
     * count() - Retourne le nombre de langues
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de langues
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime une langue
     * @abstract
     * @access public
     * @param int $id - identifiant de la langue
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie une langue
     * @abstract
     * @access public
     * @param langueEntity $langue
     * @return void
     */
    abstract public function modify(langueEntity $langue);    
    
    /**
     * save() - Sauvegarde une langue
     * @access public
     * @param langueEntity $langue
     * @throws \RuntimeException
     */
    public function save(langueEntity $langue){
        if($langue->isValid()){
            $langue->isNew() ? $this->add($langue) : $this->modify($langue);
        } else {
            throw new \RuntimeException('Cette langue doit être valide avant d\'être enregistrée !');
        }
    }
}