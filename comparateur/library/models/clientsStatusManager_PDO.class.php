<?php

namespace library\models;
use library\models\clientsStatusManager;
use library\entities\clientStatusEntity;

/**
 * Class clientsStatusManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class clientsStatusManager_PDO extends clientsStatusManager {
    
    /**
     * add() - Ajoute un status client
     * @access protected
     * @param clientEntity $clientStatus
     */
    public function add(clientStatusEntity $clientStatus){
        $requete = $this->_dao->prepare('INSERT INTO clients_status SET name = :name, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':name', $clientStatus->getName());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de status clients
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de clients
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM clients_status ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM clients_status')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un status client
     * @access public
     * @param int $id - Identifiant du client
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM clients_status WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un status client
     * @access public 
     * @param int $id - Identifiant du client
     * @return clientStatusEntity $clientStatus ou null
     */
    public function getUnique($id){
        $clientStatus = '';
        $requete = $this->_dao->prepare('SELECT * FROM clients_status WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\clientStatusEntity');
        if(($clientStatus = $requete->fetch())){
            $clientStatus->setDateCreation(new \DateTime($clientStatus->getDateCreation()));
            $clientStatus->setDateModification(new \DateTime($clientStatus->getDateModification()));
            return $clientStatus;
        }else{
            return null;
        }
    }    

    /**
     * getUniqueName() - Retourne un status client d'après son nom
     * @access public 
     * @param string $name - noom du status de client
     * @return clientStatusEntity $clientStatus ou null
     */    
    public function getUniqueName($name){
        $clientStatus = '';
        $requete = $this->_dao->prepare('SELECT * FROM clients_status WHERE name = :name');
        $requete->bindValue(':name', $name, \PDO::PARAM_STR);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\clientStatusEntity');
        if(($clientStatus = $requete->fetch())){
            $clientStatus->setDateCreation(new \DateTime($clientStatus->getDateCreation()));
            $clientStatus->setDateModification(new \DateTime($clientStatus->getDateModification()));
            return $clientStatus;
        }else{
            return null;
        }        
    }
    
    /**
     * getList() - Retourne la liste des status de clients
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array clientStatusEntity $clientsStatus
     */
    public function getList($debut = -1, $limite = -1, $order = 'id'){
        $sql = 'SELECT * FROM clients_status ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\clientStatusEntity');
        $clientsStatus = $requete->fetchAll();
        foreach($clientsStatus as $clientStatus){
            $clientStatus->setDateCreation(new \DateTime($clientStatus->getDateCreation()));
            $clientStatus->setDateModification(new \DateTime($clientStatus->getDateModification()));
        }
        $requete->closeCursor();
        return $clientsStatus;
    }   

    /**
     * modify() - Modifie un status client
     * @access public
     * @param clientStatusEntity $clientStatus
     * @return void
     */
    public function modify(clientStatusEntity $clientStatus){
        $requete = $this->_dao->prepare('UPDATE clients_status SET name = :name WHERE id = :id');
        echo($clientStatus->getName());
        $requete->bindValue(':name', $clientStatus->getName(), \PDO::PARAM_STR);
        $requete->bindValue(':id', $clientStatus->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}