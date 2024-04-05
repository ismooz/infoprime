<?php

namespace applications\backend\modules\polices;
use library\controllers\backController;
use library\request;
use library\entities\policeEntity;
use library\pagination;

class policesController extends backController {
        
    /**
     * executeIndex() - Exécute la page index
     * @access public
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbPolices = $this->_application->_config->get('nbPolices');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page courante
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbPolices) - $nbPolices;
        }else{
            // Définit le numéro de la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Polices');        
        // Récupère la liste des polices
        $polices = $this->_managers->getManagerOf('polices')->getList($debut, $nbPolices);
        // Ajoute la variable $polices à la page.
        $this->_page->addVar('polices', $polices);
        // Récupère le nombre de polices
        $nbPolicesTotal = $this->_managers->getManagerOf('polices')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbPolicesTotal, $nbPolices, $current_page, '/comparateur/admin/polices/');
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
        if($request->getExists('post', 'assureurId')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insertion d\'une police');
        // Récupère la liste des assureurs
        $assureurs = $this->_managers->getManagerOf('assureurs')->getList();
        // Ajoute la variable $assureurs à la page
        $this->_page->addVar('assureurs', $assureurs);
        // Récupère la liste des conseillers
        $conseillers = $this->_managers->getManagerOf('conseillers')->getList();
        // Ajoute la variable $conseillers à la page
        $this->_page->addVar('conseillers', $conseillers);
        // Récupère la liste des types de polices
        $policesTypes = $this->_managers->getManagerOf('policesTypes')->getList();
        // Ajoute la variable $types à la page
        $this->_page->addVar('policesTypes', $policesTypes);
    }

    /**
     * executeUpdate() - Exécute la page de mise à jour d'une nationalité
     * @access public
     * @param request $request
     */
    public function executeUpdate(request $request){
        // Vérifie si le formulaire est posté
        if($request->getExists('post', 'assureurId')){
            $this->_processForm($request);
        } else {
            $this->_page->addVar('police', $this->_managers->getManagerOf('polices')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'une police');
        // Récupère la liste des assureurs
        $assureurs = $this->_managers->getManagerOf('assureurs')->getList();
        // Ajoute la variable $assureurs à la page
        $this->_page->addVar('assureurs', $assureurs);               
        // Récupère la liste des conseillers
        $conseillers = $this->_managers->getManagerOf('conseillers')->getList();
        // Ajoute la variable $conseillers à la page
        $this->_page->addVar('conseillers', $conseillers);
        // Récupère la liste des banches de polices
        $policesTypes = $this->_managers->getManagerOf('policesTypes')->getList();
        // Ajoute la variable $branches à la page
        $this->_page->addVar('policesTypes', $policesTypes);
    }     
    
    /**
     * executeDelete() - Exécute la suppression d'une nationalité
     * @access public
     * @param request $request
     */
    public function executeDelete(request $request){
        // Supprime la nationalité
        $this->_managers->getManagerOf('polices')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Cette police à été correctement supprimée !');
        // Redirige vers l'index des nationalités
        $this->_application->getResponse()->redirect('/comparateur/admin/polices/');        
    }
    
    /**
     * _processForm() - Exécute le processus formulaire
     * @param request $request
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité nationalité
            $police = new policeEntity(array(
                'assureurId' => $request->getData('post', 'assureurId'),
                'conseillerId' => $request->getData('post', 'conseillerId'),
                'policeTypeId' => $request->getData('post', 'policeTypeId'),
                'police' => $request->getData('post', 'police'),
                'prime' => $request->getData('post', 'prime'),
                'dateDebut' => (new \DateTime)->createFromFormat('d/m/Y', $request->getData('post', 'dateDebut')),
                'dateFin' => (new \DateTime)->createFromFormat('d/m/Y', $request->getData('post', 'dateFin')),
                'dateResiliation' => (new \DateTime)->createFromFormat('d/m/Y', $request->getData('post', 'dateResiliation')),
                'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
                'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'dateModification'))
            ));
            // Ajoute l'identifiant à l'entité nationalité
            if($request->getExists('post', 'id')){
                $police->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité nationalité soit valide
            if($police->isValid()){
                $this->_managers->getManagerOf('polices')->save($police);
                $this->_application->getUser()->setFlash($police->isNew()?'La police à bien été ajoutée.':'La police à bien été modifiée.');
                $this->_application->getResponse()->redirect('/comparateur/admin/polices/');
            }else{
                $this->_page->addVar('erreurs', $police->getErrors());
                $this->_page->addVar('police', $police);
            }
        }
    }    
}
