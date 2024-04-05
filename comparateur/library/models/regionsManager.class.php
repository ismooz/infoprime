<?php

namespace library\models;
use library\managers\managers;
use library\entities\regionEntity;

/**
 * Abstract class regionsManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class regionsManager extends managers {

    /**
     * add() - Ajoute une région
     * @abstract
     * @access protected
     * @param clientEntity $region
     * @return void
     */    
    abstract public function add(regionEntity $region);      
    
    /**
     * count() - Retourne le nombre de regions
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de régions
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime une région
     * @abstract
     * @access public
     * @param int $id - identifiant de la région
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie une région
     * @abstract
     * @access public
     * @param regionEntity $region
     * @return void
     */
    abstract public function modify(regionEntity $region);    
    
    /**
     * save() - Sauvegarde une région
     * @access public
     * @param regionEntity $region
     * @throws \RuntimeException
     * @return void
     */
    public function save(regionEntity $region){
        if($region->isValid()){
            $region->isNew() ? $this->add($region) : $this->modify($region);
        } else {
            throw new \RuntimeException('Cette région doit être valide avant d\'être enregistrée !');
        }
    }
}