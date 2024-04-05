<?php

namespace library\models;
use library\managers\managers;
use library\entities\assureurEntity;

/**
 * Abstract class clientManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class assureursManager extends managers {

    /**
     * add() - Ajoute un assureur
     * @abstract
     * @access protected
     * @param assureurEntity $assureur
     * @return void
     */    
    abstract public function add(assureurEntity $assureur);      
    
    /**
     * count() - Retourne le nombre d'assureurs
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre d'assureurs
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un assureur
     * @abstract
     * @access public
     * @param int $id - identifiant de l'assureur
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie un assureur
     * @abstract
     * @access public
     * @param assureurEntity $assureur
     * @return void
     */
    abstract public function modify(assureurEntity $assureur);    
    
    /**
     * save() - Sauvegarde un assureur
     * @access public
     * @param assureurEntity $assureur
     * @throws \RuntimeException
     */
    public function save(assureurEntity $assureur){
        if($assureur->isValid()){
            $assureur->isNew() ? $this->add($assureur) : $this->modify($assureur);
        } else {
            throw new \RuntimeException('Cet assureur doit être valide avant d\'être enregistrée !');
        }
    }
}