<?php

namespace applications\backend\modules\utilisateurs;
use library\controllers\backController;
use library\request;
use library\entities\utilisateurEntity;
use library\pagination;

/**
 * Class utilisateursController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class utilisateursController extends backController{

    /**
     * executeIndex() - Exécute la page index
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbUtilisateurs = $this->_application->_config->get('nbUtilisateurs');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Utilisateurs');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbUtilisateurs) - $nbUtilisateurs;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des utilisateurs
        $utilisateurs = $this->_managers->getManagerOf('utilisateurs')->getList($debut, $nbUtilisateurs);
        // Ajoute la variable $utilisateurs à la page
        $this->_page->addVar('utilisateurs', $utilisateurs);
        // Récupère le nombre de status de clients
        $nbUtilisateursTotal = $this->_managers->getManagerOf('utilisateurs')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbUtilisateursTotal, $nbUtilisateurs, $current_page, '/comparateur/admin/utilisateurs/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);      
    }
    
    /**
     * executeInsert() - Exécute la page d'insertion d'un utilisateur
     * @access public
     * @param request $request
     * @return void
     */
    public function executeInsert(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'login')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insértion d\'un utilisateur');
        // Récupère la liste des utilisateurs
        $utilisateursGroupes = $this->_managers->getManagerOf('utilisateursGroupes')->getList();
        // Ajoute la variable $utilisateursGroupes à la page
        $this->_page->addVar('utilisateursGroupes', $utilisateursGroupes);        
}
 
    /**
     * executeUpdate() - Exécute la page de mise à jour du utilisateur
     * @access public
     * @param request $request
     * @return void
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'login')){
            $this->_processForm($request);
        } else {
            $this->_page->addVar('utilisateur', $this->_managers->getManagerOf('utilisateurs')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'un utilisateur');
        // Récupère la liste des utilisateurs
        $utilisateursGroupes = $this->_managers->getManagerOf('utilisateursGroupes')->getList();
        // Ajoute la variable $utilisateursGroupes à la page
        $this->_page->addVar('utilisateursGroupes', $utilisateursGroupes);         
    }     

    /**
     * executeDelete() - Exécute la suppression d'un utilisateur
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime l'utilisateur
        $this->_managers->getManagerOf('utilisateurs')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Cet utilisateur à été correctement supprimée !');
        // Redirige vers la page index des utilisateurs
        $this->_application->getResponse()->redirect('/comparateur/admin/utilisateurs/');          
    }
    
    /**
     * _processForm() - Exécute le processus du formulaire
     * @access protected
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité utilisateur
            $utilisateur = new utilisateurEntity(array(
                'login' => $request->getData('post', 'login'),
                'password' => $request->getData('post', 'password'),
                'passwordValidate' => $request->getData('post', 'passwordValidate'),
                'utilisateurGroupeId' => $request->getData('post', 'groupeId'),
                'state' => ($request->getExists('post', 'state')?true:false),
                'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
                'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'dateModification'))
            ));
            // On ajoute l'identifiant a l'utilisateur
            if($request->getExists('post', 'id')){
                $utilisateur->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'utilisateur soit valide
            if($utilisateur->isValid()){
                // Vérifie que ce soit un nouvel utilisateur
                if($utilisateur->isNew()){
                    // Récupère l'utilisateur d'après son login
                    $result = $this->_managers->getManagerOf('utilisateurs')->getUniqueLogin($utilisateur->getLogin());
                    // Vérifie que le login ne soit pas déjà utilisé
                    if(!is_null($result)){
                        $utilisateur->setError(utilisateurEntity::INVALID_EXISTING_LOGIN);
                        $this->_page->addVar('erreurs', $utilisateur->getErrors());
                        $this->_page->addVar('utilisateur', $utilisateur);
                    }else{
                        $this->_managers->getManagerOf('utilisateurs')->save($utilisateur);
                        $this->_application->getUser()->setFlash('L\'utilisateur à bien été ajouté.');
                        $this->_application->getResponse()->redirect('/comparateur/admin/utilisateurs/');                
                    }                
                }else{
                    $this->_managers->getManagerOf('utilisateurs')->save($utilisateur);
                    $this->_application->getUser()->setFlash('L\'utilisateur à bien été modifié.');
                    $this->_application->getResponse()->redirect('/comparateur/admin/utilisateurs/');                
                }
            }else{
                $this->_page->addVar('erreurs', $utilisateur->getErrors());
                $this->_page->addVar('utilisateur', $utilisateur);
            }
        }
    }
}
