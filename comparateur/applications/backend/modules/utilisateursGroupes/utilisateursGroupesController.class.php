<?php

namespace applications\backend\modules\utilisateursGroupes;
use library\controllers\backController;
use library\request;
use library\entities\utilisateurGroupeEntity;
use library\pagination;

/**
 * Class contactsEtatsController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class utilisateursGroupesController extends backController {   
    
    /**
     * executeInsert() - Exécute la page index des groupes d'utilisateurs
     * @access public
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbUtilisateursGroupes = $this->_application->_config->get('nbUtilisateursGroupes');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Groupes d\'utilisateurs');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbUtilisateursGroupes) - $nbUtilisateursGroupes;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère le manager des utilisateurs
        $manager = $this->_managers->getManagerOf('utilisateursGroupes');
        // Récupère la liste des groupes d'utilisateurs
        $utilisateursGroupes = $manager->getList($debut, $nbUtilisateursGroupes);
        // Ajoute la variable $utilisateursGroupes à la page
        $this->_page->addVar('utilisateursGroupes', $utilisateursGroupes);
        // Récupère le nombre de status de clients
        $nbUtilisateursGroupesTotal = $this->_managers->getManagerOf('utilisateursGroupes')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbUtilisateursGroupesTotal, $nbUtilisateursGroupes, $current_page, '/comparateur/admin/utilisateursGroupes/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);  
    }
 
    /**
     * executeInsert() - Execute la page d'insertion d'un groupe d'utilisateurs
     * @access public
     * @param request $request
     * @return void
     */
    public function executeInsert(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insértion d\'un groupe d\'utilisateurs');
    }      
    
    /**
     * executeUpdate() - Exécute la page de mise à jour d'un groupe d'utilisateurs 
     * @access public
     * @param request $request
     * @return void
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name')){
            $this->_processForm($request);
        } else {
            $this->_page->addVar('utilisateurGroupe', $this->_managers->getManagerOf('utilisateursGroupes')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'un groupe d\'utilisateurs');      
    }     

    /**
     * executeDelete() - Supprime un groupe d'utilisateurs
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime le groupe d'utilisateurs
        $this->_managers->getManagerOf('utilisateursGroupes')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Ce groupe d\'utilisateurs à été correctement supprimée !');
        // Redirige vers la page index des groupes d'utilisateurs
        $this->_application->getResponse()->redirect('/comparateur/admin/utilisateursGroupes/');          
    }
    
    /**
     * _processForm() - Execute la processus du formulaire
     * @access protected
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){     
        // Définit les champs de l'entité utilisateurGroupe
        $utilisateurGroupe = new utilisateurGroupeEntity(array(
            'name' => $request->getData('post', 'name'),
            'dateCreation' => (new \DateTime)->setTimestamp(strtotime($request->getData('post', 'dateCreation'))),
            'dateModification' => (new \DateTime)->setTimestamp(strtotime($request->getData('post', 'dateModification')))
        ));
        // On ajoute l'identifiant à l'entité utilisateurGroupe
        if($request->getExists('post', 'id')){
            $utilisateurGroupe->setId($request->getData('post', 'id'));
        }
        // Vérifie que le groupe d'utilisateurs soit valide
        if($utilisateurGroupe->isValid()){
            // Vérifie que ce soit un nouvel groupe d'utilisateurs
            if($utilisateurGroupe->isNew()){
                // Recherche le nouvel état de contact
                $result = $this->_managers->getManagerOf('utilisateursGroupes')->getUniqueName($utilisateurGroupe->getName());
                // Vérifie si le client status existe déjà
                if(!is_null($result)){
                    $utilisateurGroupe->setError(contactEtatEntity::INVALID_EXISTING_NAME);
                    $this->_page->addVar('erreurs', $utilisateurGroupe->getErrors());
                    $this->_page->addVar('utilisateurGroupe', $utilisateurGroupe);                
                }else{
                    $this->_managers->getManagerOf('utilisateursGroupes')->save($utilisateurGroupe);
                    $this->_application->getUser()->setFlash('Le groupe d\'utilisateurs à bien été ajouté.');
                    $this->_application->getResponse()->redirect('/comparateur/admin/utilisateursGroupes/');
                } 
            }else{
                $this->_managers->getManagerOf('utilisateursGroupes')->save($utilisateurGroupe);
                $this->_application->getUser()->setFlash('Le groupe d\'utilisateurs à bien été modifié.');
                $this->_application->getResponse()->redirect('/comparateur/admin/utilisateursGroupes/');                 
            }
        }else{
            $this->_page->addVar('erreurs', $utilisateurGroupe->getErrors());
            $this->_page->addVar('utilisateurGroupe', $utilisateurGroupe);
        }        
    }
}
