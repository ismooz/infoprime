<?php

namespace library\models;
use library\models\clientsManager;
use library\entities\clientEntity;

/**
 * Class clientsManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class clientsManager_PDO extends clientsManager {
    
    /**
     * add() - Ajoute un client
     * @access protected
     * @param clientEntity $client
     */
    public function add(clientEntity $client){
        $requete = $this->_dao->prepare('INSERT INTO clients SET langueCorrespondanceId = :langueCorrespondanceId, nationaliteId = :nationaliteId, statusId = :statusId, userId = :userId, nom = :nom, prenom = :prenom, adresse = :adresse, npa = :npa, ville = :ville, telephone = :telephone, email = :email, dateNaissance = :dateNaissance, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':langueCorrespondanceId', $client->getLangueCorrespondanceId());
        $requete->bindValue(':nationaliteId', $client->getNationaliteId());
        $requete->bindValue(':statusId', $client->getStatusId());
        $requete->bindValue(':userId', $client->getUserId());
        $requete->bindValue(':statusId', $client->getStatusId());
        $requete->bindValue(':nom', $client->getNom());
        $requete->bindValue(':prenom', $client->getPrenom());
        $requete->bindValue(':adresse', $client->getAdresse());
        $requete->bindValue(':npa', $client->getNpa());
        $requete->bindValue(':ville', $client->getVille());
        $requete->bindValue(':telephone', $client->getTelephone());
        $requete->bindValue(':email', $client->getEmail());
        $requete->bindValue(':dateNaissance', $client->getDateNaissance()->format('d/m/Y'));
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de clients
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de clients
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM clients ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM clients')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un client
     * @access public
     * @param int $id - Identifiant du client
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM clients WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un client
     * @access public 
     * @param int $id - Identifiant du client
     * @return clientEntity $client ou null
     */
    public function getUnique($id){
        $client = '';
        $requete = $this->_dao->prepare('SELECT clients.id, clients.civiliteId, clients.langueCorrespondanceId, clients.nationaliteId, clients.statusId, clients.userId, clients.nom, clients.prenom, clients.adresse, clients.npa, clients.ville, clients.telephone, clients.email, clients.image, clients.dateCreation, clients.dateModification FROM clients WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\clientEntity');
        if(($client = $requete->fetch())){
            $client->setDateNaissance(new \DateTime($client->getDateNaissance()));
            $client->setDateCreation(new \DateTime($client->getDateCreation()));
            $client->setDateModification(new \DateTime($client->getDateModification()));
            return $client;
        }
        return null;  
    }    
    
    /**
     * getList() - Retourne la liste des deamndes de contact
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array clientEntity $clients
     */
    public function getList($debut = -1, $limite = -1, $order = 'nom'){
        $sql = 'SELECT * FROM clients ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\clientEntity');
        $clients = $requete->fetchAll();
        foreach($clients as $client){
            $client->setDateCreation(new \DateTime($client->getDateCreation()));
            $client->setDateModification(new \DateTime($client->getDateModification()));
        }
        $requete->closeCursor();
        return $clients;
    }    

    /**
     * modify() - Modifie un client
     * @access public
     * @param clientEntity $client
     * @return void
     */
    public function modify(clientEntity $client){
        $requete = $this->_dao->prepare('UPDATE clients SET langueCorrespondanceId = :langueCorrespondanceId, nationaliteId = :nationaliteId, statusId = :statusId, userId = :userId, nom = :nom, prenom = :prenom, adresse = :adresse, npa = :npa, ville = :ville, telephone = :telephone, email = :email, dateNaissance = :dateNaissance, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':langueCorrespondanceId', $client->getLangueCorrespondanceId(), \PDO::PARAM_INT);
        $requete->bindValue(':nationaliteId', $client->getNationaliteId(), \PDO::PARAM_INT);
        $requete->bindValue(':statusId', $client->getStatusId(), \PDO::PARAM_INT);
        $requete->bindValue(':userId', $client->getUserId(), \PDO::PARAM_INT);
        $requete->bindValue(':nom', $client->getNom(), \PDO::PARAM_STR);
        $requete->bindValue(':prenom', $client->getPrenom(), \PDO::PARAM_STR);
        $requete->bindValue(':adresse', $client->getAdresse(), \PDO::PARAM_STR);
        $requete->bindValue(':npa', $client->getNpa(), \PDO::PARAM_STR);
        $requete->bindValue(':ville', $client->getVille(), \PDO::PARAM_STR);
        $requete->bindValue(':telephone', $client->getTelephone(), \PDO::PARAM_STR);
        $requete->bindValue(':email', $client->getEmail(), \PDO::PARAM_STR);
        $requete->bindValue(':dateNaissance', $client->getDateNaissance()->format('U'), \PDO::PARAM_INT);
        $requete->bindValue(':id', $client->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}