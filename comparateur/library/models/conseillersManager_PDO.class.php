<?php

namespace library\models;
use library\models\conseillersManager;
use library\entities\conseillerEntity;

/**
 * Class courtiersManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class conseillersManager_PDO extends conseillersManager {
    
    /**
     * add() - Ajoute un conseiller
     * @access protected
     * @param courtierEntity $conseiller
     */
    public function add(conseillerEntity $conseiller){
        $requete = $this->_dao->prepare('INSERT INTO conseillers SET nom = :nom, prenom = :prenom, adresse = :adresse, npa = :npa, ville = :ville, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':nom', $conseiller->getNom());
        $requete->bindValue(':prenom', $conseiller->getPrenom());
        $requete->bindValue(':adresse', $conseiller->getAdresse());
        $requete->bindValue(':npa', $conseiller->getNpa());
        $requete->bindValue(':ville', $conseiller->getVille());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de conseillers
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de conseillers
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM conseillers ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM conseillers')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un conseiller
     * @access public
     * @param int $id - Identifiant du conseiller
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM conseillers WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un conseiller
     * @access public 
     * @param int $id - Identifiant du courtier
     * @return conseillerEntity $conseiller ou null
     */
    public function getUnique($id){
        $conseiller = '';
        $requete = $this->_dao->prepare('SELECT * FROM conseillers WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\conseillerEntity');
        if (($conseiller = $requete->fetch())){
            $conseiller->setDateCreation(new \DateTime($conseiller->getDateCreation()));
            $conseiller->setDateModification(new \DateTime($conseiller->getDateModification()));
            return $conseiller;
        }else{
            return null;
        }
    }    
    
    /**
     * getList() - Retourne la liste des conseillers
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array conseillerEntity $conseillers
     */
    public function getList($debut = -1, $limite = -1, $order = 'nom'){
        $sql = 'SELECT * FROM conseillers ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\conseillerEntity');
        $conseillers = $requete->fetchAll();
        foreach($conseillers as $conseiller){
            $conseiller->setDateCreation(new \DateTime($conseiller->getDateCreation()));
            $conseiller->setDateModification(new \DateTime($conseiller->getDateModification()));
        }
        $requete->closeCursor();
        return $conseillers;
    }     
    
    /**
     * modify() - Modifie un conseiller
     * @access public
     * @param conseillerEntity $conseiller
     * @return void
     */
    public function modify(conseillerEntity $conseiller){
        $requete = $this->_dao->prepare('UPDATE conseillers SET nom = :nom, prenom = :prenom, adresse = :adresse, npa = :npa, ville = :ville, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':nom', $conseiller->getNom(), \PDO::PARAM_STR);
        $requete->bindValue(':prenom', $conseiller->getPrenom(), \PDO::PARAM_STR);
        $requete->bindValue(':adresse', $conseiller->getAdresse(), \PDO::PARAM_STR);
        $requete->bindValue(':npa', $conseiller->getNpa(), \PDO::PARAM_STR);
        $requete->bindValue(':ville', $conseiller->getVille(), \PDO::PARAM_STR);
        $requete->bindValue(':id', $conseiller->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}
