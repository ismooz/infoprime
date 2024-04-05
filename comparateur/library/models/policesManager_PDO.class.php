<?php

namespace library\models;
use library\models\policesManager;
use library\entities\policeEntity;

/**
 * Class clientsManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class policesManager_PDO extends policesManager {
    
    /**
     * add() - Ajoute un client
     * @access protected
     * @param policeEntity $police
     */
    public function add(policeEntity $police){
        $requete = $this->_dao->prepare('INSERT INTO polices SET assureurId = :assureurId, conseillerId = :conseillerId, policeTypeId = :policeTypeId, police = :police, prime = :prime, dateDebut = :dateDebut, dateFin = :dateFin, dateResiliation = :dateResiliation, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':assureurId', $police->getAssureurId());
        $requete->bindValue(':conseillerId', $police->getConseillerId());
        $requete->bindValue(':policeTypeId', $police->getPoliceTypeId());
        $requete->bindValue(':police', $police->getPolice());
        $requete->bindValue(':prime', $police->getPrime());
        $requete->bindValue(':dateDebut', $police->getDateDebut()->format('Y-m-d'));
        $requete->bindValue(':dateFin', $police->getDateFin()->format('Y-m-d'));
        $requete->bindValue(':dateResiliation', $police->getDateResiliation()->format('Y-m-d'));
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
            return $this->_dao->query('SELECT COUNT(*) FROM polices ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM polices')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un client
     * @access public
     * @param int $id - Identifiant du client
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM polices WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne une police
     * @access public 
     * @param int $id - Identifiant de la police
     * @return policeEntity $police ou null
     */
    public function getUnique($id){
        $police = '';
        $requete = $this->_dao->prepare('SELECT * FROM polices WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\policeEntity');
        if(($police = $requete->fetch())){
            $police->setDateDebut(new \DateTime($police->getDateDebut()));
            $police->setDateFin(new \DateTime($police->getDateFin()));
            $police->setDateResiliation(new \DateTime($police->getDateResiliation()));
            $police->setDateCreation(new \DateTime($police->getDateCreation()));
            $police->setDateModification(new \DateTime($police->getDateModification()));
            return $police;
        }
        return null;  
    }    
    
    /**
     * getList() - Retourne la liste des polices
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array policeEntity $polices
     */
    public function getList($debut = -1, $limite = -1, $order = 'dateCreation DESC'){
        $sql = 'SELECT polices.id, assureurs.name as assureurName, conseillers.nom as conseillerName, polices_types.name as policeTypeName, .polices.police, polices.prime, polices.dateDebut, polices.dateFin, polices.dateResiliation, polices.dateCreation, polices.dateModification FROM polices LEFT JOIN assureurs ON assureurs.id = polices.assureurId LEFT JOIN conseillers ON polices.conseillerId = conseillers.id LEFT JOIN polices_types ON polices_types.id = polices.policeTypeId ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\policeEntity');
        $polices = $requete->fetchAll();
        foreach($polices as $police){
            $police->setDateDebut(new \DateTime($police->getDateDebut()));
            $police->setDateFin(new \DateTime($police->getDateFin()));
            $police->setDateResiliation(new \DateTime($police->getDateResiliation()));            
            $police->setDateCreation(new \DateTime($police->getDateCreation()));
            $police->setDateModification(new \DateTime($police->getDateModification()));
        }
        $requete->closeCursor();
        return $polices;
    }    

    /**
     * modify() - Modifie une police
     * @access public
     * @param policeEntity $police
     * @return void
     */
    public function modify(policeEntity $police){
        $requete = $this->_dao->prepare('UPDATE polices SET assureurId = :assureurId, conseillerId = :conseillerId, policeTypeId = :policeTypeId, police = :police, prime = :prime, dateDebut = :dateDebut, dateFin = :dateFin, dateResiliation = :dateResiliation, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':assureurId', $police->getAssureurId(), \PDO::PARAM_INT);
        $requete->bindValue(':conseillerId', $police->getConseillerId(), \PDO::PARAM_INT);
        $requete->bindValue(':policeTypeId', $police->getPoliceTypeId(), \PDO::PARAM_INT);
        $requete->bindValue(':police', $police->getPolice(), \PDO::PARAM_STR);
        $requete->bindValue(':prime', $police->getPrime(), \PDO::PARAM_STR);
        $requete->bindValue(':dateDebut', $police->getDateDebut()->format('Y/m/d'), \PDO::PARAM_STR);
        $requete->bindValue(':dateFin', $police->getDateFin()->format('Y/m/d'), \PDO::PARAM_STR);
        $requete->bindValue(':dateResiliation', $police->getDateResiliation()->format('Y/m/d'), \PDO::PARAM_STR);
        $requete->bindValue(':id', $police->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}