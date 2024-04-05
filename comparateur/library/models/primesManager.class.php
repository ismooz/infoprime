<?php

namespace library\models;
use library\managers\managers;
use library\entities\primeEntity;

/**
 * Abstract class primesManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class primesManager extends managers {

    /**
     * add() - Ajoute une prime 
     * @abstract
     * @access protected
     * @param primeEntity $prime
     * @return void
     */    
    abstract public function add(primeEntity $prime);      
    
    /**
     * count() - Retourne le nombre de primes
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de primes
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime une prime
     * @abstract
     * @access public
     * @param int $id - identifiant de la prime
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie une prime
     * @abstract
     * @access public
     * @param primeEntity $prime
     * @return void
     */
    abstract public function modify(primeEntity $prime);    
    
    /**
     * save() - Sauvegarde une prime
     * @access public
     * @param primeEntity $prime
     * @throws \RuntimeException
     */
    public function save(primeEntity $prime){
        if($prime->isValid()){
            $prime->isNew() ? $this->add($prime) : $this->modify($prime);
        } else {
            throw new \RuntimeException('Cette prime doit être valide avant d\'être enregistrée !');
        }
    }
}