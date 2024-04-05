<?php

namespace library\models;
use library\models\languesManager;
use library\entities\langueEntity;

/**
 * Class languesManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class languesManager_PDO extends languesManager {
    
    /**
     * add() - Ajoute une langue
     * @access protected
     * @param langueEntity $langue
     * @return void
     */
    public function add(langueEntity $langue){
        $requete = $this->_dao->prepare('INSERT INTO langues SET name_de = :nameDe, name_en = :nameEn, name_fr = :nameFr, name_it = :nameIt, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':nameDe', $langue->getNameDe());
        $requete->bindValue(':nameEn', $langue->getNameEn());
        $requete->bindValue(':nameFr', $langue->getNameFr());
        $requete->bindValue(':nameIt', $langue->getNameIt());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de langues
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de langues
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM langues ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM langues')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime une langue
     * @access public
     * @param int $id - Identifiant de la langue
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM langues WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne une langue
     * @access public 
     * @param int $id - Identifiant de la langue
     * @return langueEntity $langue ou null
     */
    public function getUnique($id){
        $langue = '';
        $requete = $this->_dao->prepare('SELECT * FROM langues WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\langueEntity');
        if (($langue = $requete->fetch())){
            $langue->setDateCreation(new \DateTime($langue->getDateCreation()));
            $langue->setDateModification(new \DateTime($langue->getDateModification()));
            return $langue;
        }else{
            return null;
        }  
    }    
    
    /**
     * getList() - Retourne la liste des langues
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @param string $order - Ordre de tri
     * @return array langueEntity $langues
     */
    public function getList($debut = -1, $limite = -1, $order = 'id'){
        $sql = 'SELECT * FROM langues ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\langueEntity');
        $langues = $requete->fetchAll();
        foreach($langues as $langue){
            $langue->setDateCreation(new \DateTime($langue->getDateCreation()));
            $langue->setDateModification(new \DateTime($langue->getDateModification()));
        }
        $requete->closeCursor();
        return $langues;
    }     
    
    /**
     * modify() - Modifie une langue
     * @access public
     * @param nationaliteEntity $langue
     * @return void
     */
    public function modify(langueEntity $langue){
        $requete = $this->_dao->prepare('UPDATE langues SET name_de = :nameDe, name_en = :nameEn, name_fr = :nameFr, name_it = :nameIt, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':nameDe', $langue->getNameDe());
        $requete->bindValue(':nameEn', $langue->getNameEn());
        $requete->bindValue(':nameFr', $langue->getNameFr());
        $requete->bindValue(':nameIt', $langue->getNameIt());
        $requete->bindValue(':id', $langue->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}
