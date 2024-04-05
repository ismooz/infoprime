<?php

namespace library\models;
use library\managers\managers;
use library\entities\policeTypeEntity;

/**
 * Abstract class clientsStatusManager
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class policesTypesManager extends managers {

    /**
     * add() - Ajoute un type de police 
     * @abstract
     * @access protected
     * @param policeBrancheEntity $policeType
     * @return void
     */    
    abstract public function add(policeTypeEntity $policeType);      
    
    /**
     * count() - Retourne le nombre de types de polices
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de types de polices
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un type de police
     * @abstract
     * @access public
     * @param int $id - identifiant du type de polcie
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie un type de police
     * @abstract
     * @access public
     * @param policeTypeEntity $policeType
     * @return void
     */
    abstract public function modify(policeTypeEntity $policeType);    
    
    /**
     * save() - Sauvegarde un type de police
     * @access public
     * @param policeTypeEntity $policeType
     * @throws \RuntimeException
     */
    public function save(policeTypeEntity $policeType){
        if($policeType->isValid()){
            $policeType->isNew() ? $this->add($policeType) : $this->modify($policeType);
        } else {
            throw new \RuntimeException('Ce type de police doit être valide avant d\'être enregistrée !');
        }
    }
}