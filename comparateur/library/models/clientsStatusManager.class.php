<?php

namespace library\models;
use library\managers\managers;
use library\entities\clientStatusEntity;

/**
 * Abstract class clientsStatusManager
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class clientsStatusManager extends managers {

    /**
     * add() - Ajoute un status client 
     * @abstract
     * @access protected
     * @param clientStatusEntity $clientStatus
     * @return void
     */    
    abstract public function add(clientStatusEntity $clientStatus);      
    
    /**
     * count() - Retourne le nombre de status clients
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de status clients
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un status client
     * @abstract
     * @access public
     * @param int $id - identifiant du client
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie un status client
     * @abstract
     * @access public
     * @param clientStatusEntity $clientStatus
     * @return void
     */
    abstract public function modify(clientStatusEntity $clientStatus);    
    
    /**
     * save() - Sauvegarde un client
     * @access public
     * @param clientEntity $clientStatus
     * @throws \RuntimeException
     */
    public function save(clientStatusEntity $clientStatus){
        if($clientStatus->isValid()){
            $clientStatus->isNew() ? $this->add($clientStatus) : $this->modify($clientStatus);
        } else {
            throw new \RuntimeException('Ce status de client doit être valide avant d\'être enregistrée !');
        }
    }
}