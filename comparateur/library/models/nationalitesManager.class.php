<?php

namespace library\models;
use library\managers\managers;
use library\entities\nationaliteEntity;

/**
 * Abstract class nationalitesManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class nationalitesManager extends managers {

    /**
     * add() - Ajoute une nationalité 
     * @abstract
     * @access protected
     * @param nationaliteEntity $nationalite
     * @return void
     */    
    abstract public function add(nationaliteEntity $nationalite);      
    
    /**
     * count() - Retourne le nombre de nationalités
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de nationalités
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime une nationalité
     * @abstract
     * @access public
     * @param int $id - identifiant de la nationalité
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie une nationalité
     * @abstract
     * @access public
     * @param nationaliteEntity $nationalite
     * @return void
     */
    abstract public function modify(nationaliteEntity $nationalite);    
    
    /**
     * save() - Sauvegarde une demande de contact
     * @access public
     * @param nationaliteEntity $nationalite
     * @throws \RuntimeException
     */
    public function save(nationaliteEntity $nationalite){
        if($nationalite->isValid()){
            $nationalite->isNew() ? $this->add($nationalite) : $this->modify($nationalite);
        } else {
            throw new \RuntimeException('Cette nationalité doit être valide avant d\'être enregistrée !');
        }
    }
}