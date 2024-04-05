<?php

namespace library\models;
use library\managers\managers;
use library\entities\policeEntity;

/**
 * Abstract class clientManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class policesManager extends managers {

    /**
     * add() - Ajoute une police 
     * @abstract
     * @access protected
     * @param policeEntity $police
     * @return void
     */    
    abstract public function add(policeEntity $police);      
    
    /**
     * count() - Retourne le nombre de polices
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de polices
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime une police
     * @abstract
     * @access public
     * @param int $id - identifiant de la police
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie une police
     * @abstract
     * @access public
     * @param policeEntity $police
     * @return void
     */
    abstract public function modify(policeEntity $police);    
    
    /**
     * save() - Sauvegarde une police
     * @access public
     * @param policeEntity $police
     * @throws \RuntimeException
     */
    public function save(policeEntity $police){
        if($police->isValid()){
            $police->isNew() ? $this->add($police) : $this->modify($police);
        } else {
            throw new \RuntimeException('Cette police doit être valide avant d\'être enregistrée !');
        }
    }
}