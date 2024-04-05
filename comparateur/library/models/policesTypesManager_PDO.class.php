<?php

namespace library\models;
use library\models\policesTypesManager;
use library\entities\policeTypeEntity;

/**
 * Class clientsStatusManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class policesTypesManager_PDO extends policesTypesManager {
    
    /**
     * add() - Ajoute un type de police
     * @access protected
     * @param policeTypeEntity $policeType
     */
    public function add(policeTypeEntity $policeType){
        $requete = $this->_dao->prepare('INSERT INTO polices_types SET name = :name, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':name', $policeType->getName());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de types de polices
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de types de polices
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM polices_types ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM polices_types')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un type de police
     * @access public
     * @param int $id - Identifiant du type de police
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM polices_types WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un type de police
     * @access public 
     * @param int $id - Identifiant du type de police
     * @return policeTypeEntity $policeType ou null
     */
    public function getUnique($id){
        $policeType = '';
        $requete = $this->_dao->prepare('SELECT * FROM polices_types WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\policeTypeEntity');
        if(($policeType = $requete->fetch())){
            $policeType->setDateCreation(new \DateTime($policeType->getDateCreation()));
            $policeType->setDateModification(new \DateTime($policeType->getDateModification()));
            return $policeType;
        }else{
            return null;
        }
    }    
    
    /**
     * getUniqueName() - Retourne un type de police d'après son nom
     * @access public 
     * @param string $name - Nom du type de police
     * @return policeTypeEntity $policeType ou null
     */
    public function getUniqueName($name){
        $policeType = '';
        $requete = $this->_dao->prepare('SELECT * FROM polices_types WHERE name = :name');
        $requete->bindValue(':name', $name, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\policeTypeEntity');
        if(($policeType = $requete->fetch())){
            $policeType->setDateCreation(new \DateTime($policeType->getDateCreation()));
            $policeType->setDateModification(new \DateTime($policeType->getDateModification()));
            return $policeType;
        }else{
            return null;
        }
    }    
    
    /**
     * getList() - Retourne la liste des types de polices
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array policeTypeEntity $policesTypes
     */
    public function getList($debut = -1, $limite = -1, $order = 'id'){
        $sql = 'SELECT * FROM polices_types ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\policeTypeEntity');
        $policesTypes = $requete->fetchAll();
        foreach($policesTypes as $policeType){
            $policeType->setDateCreation(new \DateTime($policeType->getDateCreation()));
            $policeType->setDateModification(new \DateTime($policeType->getDateModification()));
        }
        $requete->closeCursor();
        return $policesTypes;
    }   

    /**
     * modify() - Modifie un type de police
     * @access public
     * @param policeTypeEntity $policeType
     * @return void
     */
    public function modify(policeTypeEntity $policeType){
        $requete = $this->_dao->prepare('UPDATE polices_types SET name = :name WHERE id = :id');
        $requete->bindValue(':name', $policeType->getName(), \PDO::PARAM_STR);
        $requete->bindValue(':id', $policeType->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}