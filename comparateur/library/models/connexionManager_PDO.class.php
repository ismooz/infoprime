<?php

namespace library\models;
use library\models\connexionManager;

/**
 * Class connexionManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class connexionManager_PDO extends connexionManager{
    /**
     * getUser() - Retourne les paramètre d'authentification
     * @param type $login
     * @return array/null
     */
    public function getUser($login) {
        $user = '';
        $requete = $this->_dao->prepare('SELECT id, login, password FROM users WHERE login = :login');
        $requete->bindValue(':login', $login);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_ASSOC);
        if(($user = $requete->fetch())){
            return $user;
        }else{
            return null;
        }
    }
}