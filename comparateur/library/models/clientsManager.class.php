<?php

namespace library\models;
use library\managers\managers;
use library\entities\clientEntity;

/**
 * Abstract class clientManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class clientsManager extends managers {

    /**
     * add() - Ajoute un client 
     * @abstract
     * @access protected
     * @param clientEntity $client
     * @return void
     */    
    abstract public function add(clientEntity $client);      
    
    /**
     * count() - Retourne le nombre de clients
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de clients
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un client
     * @abstract
     * @access public
     * @param int $id - Identifiant du client
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * getUnique() - Retourne un client
     * @access public
     * @param int $id - Identifiant du client
     * @return clientEntity $client
     */
    abstract public function getUnique($id);
    
    /**
     * getList() - Retourne la liste des clients
     * @access public
     * @param int $debut - 
     * @param int $limite -
     * @param string $order - 
     * @return clientEntity $clients
     */
    abstract public function getList($debut, $limite, $order);
    
    /**
     * modifiy() - Modifie un client
     * @abstract
     * @access public
     * @param clientEntity $client
     * @return void
     */
    abstract public function modify(clientEntity $client);    
    
    /**
     * save() - Sauvegarde un client
     * @access public
     * @param clientEntity $client
     * @throws \RuntimeException
     */
    public function save(clientEntity $client){
        if($client->isValid()){
            $client->isNew() ? $this->add($client) : $this->modify($client);
        } else {
            throw new \RuntimeException('Ce client doit être valide avant d\'être enregistrée !');
        }
    }
}