<?php

namespace library\models;
use library\models\nationalitesManager;
use library\entities\nationaliteEntity;

/**
 * Class nationalitesManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class nationalitesManager_PDO extends nationalitesManager {
    
    /**
     * add() - Ajoute une nationalité
     * @access protected
     * @param nationaliteEntity $nationalite
     * @return void
     */
    public function add(nationaliteEntity $nationalite){
        var_dump($nationalite);
        $requete = $this->_dao->prepare('INSERT INTO nationalites SET name_de = :nameDe, name_en = :nameEn, name_fr = :nameFr, name_it = :nameIt, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':nameDe', $nationalite->getNameDe());
        $requete->bindValue(':nameEn', $nationalite->getNameEn());
        $requete->bindValue(':nameFr', $nationalite->getNameFr());
        $requete->bindValue(':nameIt', $nationalite->getNameIt());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de nationalités
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de nationalités
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM nationalites ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM nationalites')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime une nationalité
     * @access public
     * @param int $id - Identifiant de la nationalité
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM nationalites WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne une nationalité
     * @access public 
     * @param int $id - Identifiant de la nationalité
     * @return nationaliteEntity $nationalite ou null
     */
    public function getUnique($id){
        $nationalite = '';
        $requete = $this->_dao->prepare('SELECT * FROM nationalites WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\nationaliteEntity');
        if (($nationalite = $requete->fetch())){
            $nationalite->setDateCreation(new \DateTime($nationalite->getDateCreation()));
            $nationalite->setDateModification(new \DateTime($nationalite->getDateModification()));
            return $nationalite;
        }else{
            return null;
        }  
    }    
    
    /**
     * getList() - Retourne la liste des nationalités
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @param string $order - Ordre de tri
     * @return array nationaliteEntity $nationalite
     */
    public function getList($debut = -1, $limite = -1, $order = 'id'){
        $sql = 'SELECT * FROM nationalites ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\nationaliteEntity');
        $nationalites = $requete->fetchAll();
        foreach($nationalites as $nationalite){
            $nationalite->setDateCreation(new \DateTime($nationalite->getDateCreation()));
            $nationalite->setDateModification(new \DateTime($nationalite->getDateModification()));
        }
        $requete->closeCursor();
        return $nationalites;
    }     
    
    /**
     * modify() - Modifie une nationalité
     * @access public
     * @param nationaliteEntity $nationalite
     * @return void
     */
    public function modify(nationaliteEntity $nationalite){
        $requete = $this->_dao->prepare('UPDATE nationalites SET name_de = :nameDe, name_en = :nameEn, name_fr = :nameFr, name_it = :nameIt, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':nameDe', $nationalite->getNameDe());
        $requete->bindValue(':nameEn', $nationalite->getNameEn());
        $requete->bindValue(':nameFr', $nationalite->getNameFr());
        $requete->bindValue(':nameIt', $nationalite->getNameIt());
        $requete->bindValue(':id', $nationalite->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}
