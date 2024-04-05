<?php

namespace library\models;
use library\managers\managers;
use library\entities\conseillerEntity;

/**
 * Abstract class courtierManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class conseillersManager extends managers {

    /**
     * add() - Ajoute un conseiller 
     * @abstract
     * @access protected
     * @param conseillerEntity $conseiller
     * @return void
     */    
    abstract public function add(conseillerEntity $conseiller);      
    
    /**
     * count() - Retourne le nombre de conseillers
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de conseillers
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un conseiller
     * @abstract
     * @access public
     * @param int $id - identifiant du conseiller
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie un conseiller
     * @abstract
     * @access public
     * @param conseillerEntity $conseiller
     * @return void
     */
    abstract public function modify(conseillerEntity $conseiller);    
    
    /**
     * save() - Sauvegarde un conseiller
     * @access public
     * @param conseillerEntity $conseiller
     * @throws \RuntimeException
     */
    public function save(conseillerEntity $conseiller){
        if($conseiller->isValid()){
            $conseiller->isNew() ? $this->add($conseiller) : $this->modify($conseiller);
        } else {
            throw new \RuntimeException('Ce conseiller doit être valide avant d\'être enregistrée !');
        }
    }
}