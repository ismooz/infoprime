<?php

namespace applications\backend\modules\langues;
use library\controllers\backController;
use library\request;
use library\entities\langueEntity;
use library\pagination;

/**
 * Class languesController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class languesController extends backController {
    
    /**
     * executeIndex() - Exécute la page index des langues
     * @param request $request
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbLangues = $this->_application->_config->get('nbLangues');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Langues');
        // Vérifie si une page est demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbLangues) - $nbLangues;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des langues        
        $langues = $this->_managers->getManagerOf('langues')->getList($debut, $nbLangues);
        // Ajoute la variable $langues à la vue.
        $this->_page->addVar('langues', $langues);
        // Récupère le nombre de langues
        $nbLanguesTotal = $this->_managers->getManagerOf('langues')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbLanguesTotal, $nbLangues, $current_page, '/comparateur/admin/langues/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);  
    }
    
    /**
     * executeInsert() - Exécute la page d'insertion d'une langue
     * @access public
     * @param request $request
     */
    public function executeInsert(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name_fr')){
            // Exécute le processus formulaire
            $this->_processForm($request);
        }
        // Ajout la variable titre à la page
        $this->_page->addVar('title', 'Insértion d\'une langue');
    }
    
    /**
     * executeUpdate() - Exécute la page de mise à jour d'une langue
     * @access public
     * @param request $request
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name_fr')){
            // Exécute le processus formulaire
            $this->_processForm($request);
        } else {
            // Ajoute la variable langue à la page
            $this->_page->addVar('langue', $this->_managers->getManagerOf('langues')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'une langue');
    }        
    
    /**
     * executeDelete() - Exécute la suppression d'une langue
     * @access public
     * @param request $request
     */
    public function executeDelete(request $request){
        // Supprime la langue
        $this->_managers->getManagerOf('langues')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Cette langue à été correctement supprimée.');
        // Redirige vers la page index des langues
        $this->_application->getResponse()->redirect('/comparateur/admin/langues/');        
    } 
    
    /**
     * _processForm() - Exécute le processus formulaire
     * @access private
     * @param request $request
     */
    private function _processForm(request $request){  
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité langue
            $langue = new langueEntity(array(
                'nameDe' => $request->getData('post', 'name_de'),
                'nameEn' => $request->getData('post', 'name_en'),
                'nameFr' => $request->getData('post', 'name_fr'),
                'nameIt' => $request->getData('post', 'name_it'),
                'dateCreation' => (new \DateTime)->setTimestamp(strtotime($request->getData('post', 'dateCreation'))),
                'dateModification' => (new \DateTime)->setTimestamp(strtotime($request->getData('post', 'dateModification')))
            ));
            // Ajoute l'identifiant à l'entité langue
            if($request->getExists('post', 'id')){
                $langue->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité langue soit valide
            if($langue->isValid()){
                $this->_managers->getManagerOf('langues')->save($langue);
                $this->_application->getUser()->setFlash($langue->isNew()?'La langue à bien été ajoutée.':'La langue à bien été modifiée.');
                $this->_application->getResponse()->redirect('/comparateur/admin/langues/');
            }else{
                $this->_page->addVar('erreurs', $langue->getErrors());
            }
            $this->_page->addVar('langue', $langue);
        }
    }    
}
