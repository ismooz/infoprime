<?php

namespace applications\backend\modules\contactsEtats;
use library\controllers\backController;
use library\request;
use library\entities\contactEtatEntity;
use library\pagination;

/**
 * Class contactsEtatsController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class contactsEtatsController extends backController {   
    
    /**
     * executeInsert() - Exécute la page index des état de contacts
     * @access public
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbContactsEtats = $this->_application->_config->get('nbContactsEtats');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Contacts états');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbContactsEtats) - $nbContactsEtats;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère le manager des clients
        $manager = $this->_managers->getManagerOf('contactsEtats');
        // Récupère la liste des clients
        $contactEtats = $manager->getList($debut, $nbContactsEtats);
        // Ajoute la variable $clients à la page
        $this->_page->addVar('contactsEtats', $contactEtats);
        // Récupère le nombre de status de clients
        $nbContactsEtatsTotal = $this->_managers->getManagerOf('contactsEtats')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbContactsEtatsTotal, $nbContactsEtats, $current_page, '/comparateur/admin/contactsEtats/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);     
    }
 
    /**
     * executeInsert() - Execute la page d'insertion de l'état d'un contact
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
        $this->_page->addVar('title', 'Insértion d\'un état de contact');
    }      
    
    /**
     * executeUpdate() - Exécute la page de mise à jour de l'état du contact 
     * @access public
     * @param request $request
     * @return void
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name')){
            $this->_processForm($request);
        } else {
            $this->_page->addVar('contactEtat', $this->_managers->getManagerOf('contactsEtats')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'un client');      
    }     

    /**
     * executeDelete() - Supprime un état de contact
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime le client
        $this->_managers->getManagerOf('contactsEtats')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Cet état de contact à été correctement supprimée !');
        // Redirige vers la page index des status de clients
        $this->_application->getResponse()->redirect('/comparateur/admin/contactsEtats/');          
    }
    
    /**
     * _processForm() - Execute la processus du formulaire
     * @access protected
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){     
        // Définit les champs de l'entité client
        $contactEtat = new contactEtatEntity(array(
            'name' => $request->getData('post', 'name'),
            'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
            'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'dateModification'))
        ));
        // On ajoute l'identifiant au courtier
        if($request->getExists('post', 'id')){
            $contactEtat->setId($request->getData('post', 'id'));
        }
        // Vérifie que le courtier soit valide
        if($contactEtat->isValid()){
            // Vérifie que ce soit un nouvel état de contact
            if($contactEtat->isNew()){
                // Recherche le nouvel état de contact
                $result = $this->_managers->getManagerOf('contactsEtats')->getUniqueName($contactEtat->getName());
                // Vérifie si le client status existe déjà
                if(!is_null($result)){
                    $contactEtat->setError(contactEtatEntity::INVALID_EXISTING_NAME);
                    $this->_page->addVar('erreurs', $contactEtat->getErrors());
                    $this->_page->addVar('contactEtat', $contactEtat);                
                }else{
                    $this->_managers->getManagerOf('contactsEtats')->save($contactEtat);
                    $this->_application->getUser()->setFlash('L\'état du contact à bien été ajouté.');
                    $this->_application->getResponse()->redirect('/comparateur/admin/contactsEtats/');
                } 
            }else{
                $this->_managers->getManagerOf('contactsEtats')->save($contactEtat);
                $this->_application->getUser()->setFlash('L\'état du contact à bien été modifié.');
                $this->_application->getResponse()->redirect('/comparateur/admin/contactsEtats/');                 
            }
        }else{
            $this->_page->addVar('erreurs', $contactEtat->getErrors());
            $this->_page->addVar('contactEtat', $contactEtat);
        }        
    }
}
