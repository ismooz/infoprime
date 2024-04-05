<?php

namespace applications\backend\modules\assureurs;
use library\controllers\backController;
use library\request;
use library\entities\assureurEntity;
use library\pagination;

/**
 * Class assureursController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class assureursController extends backController {
    
    /**
     * executeIndex() - Exécute la page index
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbAssureurs = $this->_application->_config->get('nbAssureurs');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Assureurs');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbAssureurs) - $nbAssureurs;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des assureurs
        $assureurs = $this->_managers->getManagerOf('assureurs')->getList($debut, $nbAssureurs);
        // Ajoute la variable $assureurs à la page
        $this->_page->addVar('assureurs', $assureurs);
        // Récupère le nombre d'assureurs
        $nbAssureursTotal = $this->_managers->getManagerOf('assureurs')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbAssureursTotal, $nbAssureurs, $current_page, '/comparateur/admin/assureurs/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);  
    }
 
    /**
     * executeInsert() - Execute la page d'insertion d'un client
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
        $this->_page->addVar('title', 'Insértion d\'un assureur');
        // Récupère la liste des langues
        $assureurs = $this->_managers->getManagerOf('assureurs')->getList();
        // Ajoute la variable $langues à la page
        $this->_page->addVar('langues', $assureurs);
        // Récupère la liste des nationalités
        $nationalites = $this->_managers->getManagerOf('nationalites')->getList();
        // Ajoute la variable $nationalites à la page
        $this->_page->addVar('nationalites', $nationalites);
        // Récupère la liste des status clients
        $clientsStatus = $this->_managers->getManagerOf('clientsStatus')->getList();
        // Ajoute la variable $clientsStatus à la page
        $this->_page->addVar('clientsStatus', $clientsStatus);
    }      
    
    /**
     * executeDelete() - Exécute la suppression un assureur
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime l'assureur
        $this->_managers->getManagerOf('assureurs')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Cet assureur à été correctement supprimée !');
        // Redirige vers la page index des clients
        $this->_application->getResponse()->redirect('/comparateur/admin/assureurs/');          
    }    
    
    /**
     * executeUpdate() - Exécute la page de mise à jour du client
     * @access public
     * @param request $request
     * @return void
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name')){
            // Execute le processus formulaire
            $this->_processForm($request);
        } else {
            $this->_page->addVar('assureur', $this->_managers->getManagerOf('assureurs')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'un assureur');     
    }
    
    /**
     * _processForm() - Execute le processus du formulaire
     * @access protected
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité assureur
            $assureur = new assureurEntity(array(
                'name' => $request->getData('post', 'name'),
                'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
                'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'Modification'))
            ));
            // Ajoute l'identifiant à l'entité assureur
            if($request->getExists('post', 'id')){
                $assureur->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité assureur soit valide
            if($assureur->isValid()){
                // Vérifie que ce soit un nouvel assureur
                if($assureur->isNew()){
                    // Recherche le nouvel assureur
                    $result = $this->_managers->getManagerOf('assureurs')->getUniqueName($assureur->getName());
                    // Vérifie si l'assureur existe déjà
                    if(!is_null($result)){
                        $assureur->setError(assureurEntity::INVALID_EXISTING_NAME);
                        $this->_page->addVar('erreurs', $assureur->getErrors());
                        $this->_page->addVar('assureur', $assureur);
                    }else{
                        $this->_managers->getManagerOf('assureurs')->save($assureur);
                        $this->_application->getUser()->setFlash('L\'assureur à bien été ajouté.');
                        $this->_application->getResponse()->redirect('/comparateur/admin/assureurs/');
                    }                
                }else{
                    $this->_managers->getManagerOf('assureurs')->save($assureur);
                    $this->_application->getUser()->setFlash('L\'assureur à bien été modifié.');
                    $this->_application->getResponse()->redirect('/comparateur/admin/assureurs/');               
                }
            }else{
                $this->_page->addVar('erreurs', $assureur->getErrors());
                $this->_page->addVar('client', $assureur);
            }
        }
    }    
}
