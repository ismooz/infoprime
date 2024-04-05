<?php

namespace applications\backend\modules\conseillers;
use library\controllers\backController;
use library\request;
use library\entities\conseillerEntity;
use library\pagination;

/**
 * Class courtiersController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class conseillersController extends backController {

    /**
     * executeIndex() - Exécute la page index des courtiers
     * @access public
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbConseillers = $this->_application->_config->get('nbConseillers');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Conseillers');
        // Vérifie si une page est demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbConseillers) - $nbConseillers;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des conseillers
        $conseillers = $this->_managers->getManagerOf('conseillers')->getList($debut, $nbConseillers);
        // Ajoute la variable $conseillers à la page.
        $this->_page->addVar('conseillers', $conseillers);
        // Récupère le nombre de conseillers
        $nbConseillersTotal = $this->_managers->getManagerOf('conseillers')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbConseillersTotal, $nbConseillers, $current_page, '/comparateur/admin/conseillers/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);  ;        
    }
    
    /**
     * executeInsert() - Exécute la page d'insertion d'un courtier
     * @access public
     * @param request $request
     * @return void
     */
    public function executeInsert(request $request){
        // Vérifie que le formulaire soit bien posté
        if($request->getExists('post', 'nom')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insértion d\'un conseiller');
    }
    
    /**
     * executeUpdate() - Exécute la page de mise à jour d'un conseiller
     * @access public
     * @param request $request
     * @return void
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit bien posté
        if($request->getExists('post', 'nom')){
            // Exécute le processus formulaire
            $this->_processForm($request);
        } else {
            // Ajoute la variable $courtier à la page
            $this->_page->addVar('conseiller', $this->_managers->getManagerOf('conseillers')->getUnique($request->getData('get', 'id')));
        }
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Modification d\'un conseiller');
    }     

    /**
     * executeDelete() - Exécute la suppression d'un conseiller
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime le courtier
        $this->_managers->getManagerOf('conseillers')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Ce conseiller à été correctement supprimée.');
        // Redirige vers la page index des courtier
        $this->_application->getResponse()->redirect('/comparateur/admin/conseillers/');          
    }
    
    /**
     * _proocessForm() - Exécute le processus formulaire
     * @access private
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité courtier
            $conseiller = new conseillerEntity(array(
                'nom' => $request->getData('post', 'nom'),
                'prenom' => $request->getData('post', 'prenom'),
                'adresse' => $request->getData('post', 'adresse'),
                'npa' => $request->getData('post', 'npa'),
                'ville' => $request->getData('post', 'ville'),
                'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
                'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'dateModification'))
            ));
            // Ajoute l'identifiant à l'entité courtier
            if($request->getExists('post', 'id')){
                $conseiller->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité courtier soit valide
            if($conseiller->isValid()){
                $this->_managers->getManagerOf('conseillers')->save($conseiller);
                $this->_application->getUser()->setFlash($conseiller->isNew()?'Le conseiller à bien été ajouté.':'Le conseiller à bien été modifié.');
                $this->_application->getResponse()->redirect('/comparateur/admin/conseillers/');
            }else{
                $this->_page->addVar('erreurs', $conseiller->getErrors());
            }
            $this->_page->addVar('conseiller', $conseiller);
        }
    }   
    
}
