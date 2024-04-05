<?php

namespace applications\backend\modules\nationalites;
use library\controllers\backController;
use library\request;
use library\entities\nationaliteEntity;
use library\pagination;

/**
 * Class nationalitesController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class nationalitesController extends backController{
    
    /**
     * executeIndex() - Exécute la page index des nationalités
     * @access public
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbNationalites = $this->_application->_config->get('nbNationalites');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Nationalités');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page courante
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbNationalites) - $nbNationalites;
        }else{
            // Définit le numéro de la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des nationalités
        $nationalites = $this->_managers->getManagerOf('nationalites')->getList($debut, $nbNationalites);
        // Ajoute la variable $nationalites à la page.
        $this->_page->addVar('nationalites', $nationalites);
        // Récupère le nombre de nationalités
        $nbNationalitesTotal = $this->_managers->getManagerOf('nationalites')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbNationalitesTotal, $nbNationalites, $current_page, '/comparateur/admin/nationalites/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);    
    }

    /**
     * executeInsert() - Exécute la page d'ajout d'une nationalité
     * @access public
     * @param request $request
     */
    public function executeInsert(request $request){
        // Vérifie si le formulaire est posté
        if($request->getExists('post', 'name_fr')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insertion d\'une nationalité');
    }

    /**
     * executeUpdate() - Exécute la page de mise à jour d'une nationalité
     * @access public
     * @param request $request
     */
    public function executeUpdate(request $request){
        // Vérifie si le formulaire est posté
        if($request->getExists('post', 'name_fr')){
            $this->_processForm($request);
        } else {
            $this->_page->addVar('nationalite', $this->_managers->getManagerOf('nationalites')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'une nationalité');
    }     
    
    /**
     * executeDelete() - Exécute la suppression d'une nationalité
     * @access public
     * @param request $request
     */
    public function executeDelete(request $request){
        // Supprime la nationalité
        $this->_managers->getManagerOf('nationalites')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Cette nationalité à été correctement supprimée !');
        // Redirige vers l'index des nationalités
        $this->_application->getResponse()->redirect('/comparateur/admin/nationalites/');        
    }
    
    /**
     * _processForm() - Exécute le processus formulaire
     * @param request $request
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité nationalité
            $nationalite = new nationaliteEntity(array(
                'nameDe' => $request->getData('post', 'name_de'),
                'nameEn' => $request->getData('post', 'name_en'),
                'nameFr' => $request->getData('post', 'name_fr'),
                'nameIt' => $request->getData('post', 'name_it'),
                'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
                'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'dateModification'))
            ));
            // Ajoute l'identifiant à l'entité nationalité
            if($request->getExists('post', 'id')){
                $nationalite->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité nationalité soit valide
            if($nationalite->isValid()){
                $this->_managers->getManagerOf('nationalites')->save($nationalite);
                $this->_application->getUser()->setFlash($nationalite->isNew()?'La nationalité à bien été ajoutée.':'La nationalité à bien été modifiée.');
                $this->_application->getResponse()->redirect('/comparateur/admin/nationalites/');
            }else{
                $this->_page->addVar('erreurs', $nationalite->getErrors());
                $this->_page->addVar('nationalite', $nationalite);
            }
        }
    }    
}
