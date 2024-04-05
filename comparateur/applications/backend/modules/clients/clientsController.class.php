<?php

namespace applications\backend\modules\clients;
use library\controllers\backController;
use library\request;
use library\entities\clientEntity;
use library\pagination;

/**
 * Class clientsController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class clientsController extends backController {
    
    /**
     * executeIndex() - Exécute la page index
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbClients = $this->_application->_config->get('nbClients');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Clients');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbClients) - $nbClients;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des clients
        $clients = $this->_managers->getManagerOf('clients')->getList($debut, $nbClients);
        // Ajoute la variable $clients à la page
        $this->_page->addVar('clients', $clients);
        // Récupère le nombre de clients
        $nbClientsTotal = $this->_managers->getManagerOf('clients')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbClientsTotal, $nbClients, $current_page, '/comparateur/admin/clients/');
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
        if($request->getExists('post', 'nom')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insértion d\'un client');
        // Récupère la liste des langues
        $langues = $this->_managers->getManagerOf('langues')->getList();
        // Ajoute la variable $langues à la page
        $this->_page->addVar('langues', $langues);
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
     * executeUpdate() - Exécute la page de mise à jour du client
     * @access public
     * @param request $request
     * @return void
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'nom')){
            $this->_processForm($request);
        } else {
            $this->_page->addVar('client', $this->_managers->getManagerOf('clients')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'un client');
        // Récupère la liste des langues
        $langues = $this->_managers->getManagerOf('langues')->getList();
        // Ajoute la vatiable $langues à la page
        $this->_page->addVar('langues', $langues);
        // Récupère la liste des langues
        $nationalites = $this->_managers->getManagerOf('nationalites')->getList();
        // Ajoute la vatiable $langues à la page
        $this->_page->addVar('nationalites', $nationalites);
        // Récupère la liste des status de clients
        $clientsStatus = $this->_managers->getManagerOf('clientsStatus')->getList();
        // Ajoute la variable clientsStatus
        $this->_page->addVar('clientsStatus', $clientsStatus);        
    }     

    /**
     * executeDelete() - Exécute la suppression un client
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime le client
        $this->_managers->getManagerOf('clients')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Ce client à été correctement supprimée !');
        // Redirige vers la page index des clients
        $this->_application->getResponse()->redirect('/comparateur/admin/clients/');          
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
            // Définit les champs de l'entité client
            $client = new clientEntity(array(
                'civiliteId' => $request->getData('post', 'civiliteId'),
                'langueCorrespondanceId' => $request->getData('post', 'langueCorrespondanceId'),
                'nationaliteId' => $request->getData('post', 'nationaliteId'),
                'statusId' => $request->getData('post', 'statusId'),
                'userId' => 0,            
                'nom' => $request->getData('post', 'nom'),
                'prenom' => $request->getData('post', 'prenom'),
                'adresse' => $request->getData('post', 'adresse'),
                'npa' => $request->getData('post', 'npa'),
                'ville' => $request->getData('post', 'ville'),
                'telephone' => $request->getData('post', 'telephone'),
                'email' => $request->getData('post', 'email'),
                'dateNaissance' => (new \DateTime)->createFromFormat('d/m/Y', $request->getData('post', 'dateNaissance')),
                'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
                'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'Modification'))
            ));
            // Ajoute l'identifiant à l'entité client
            if($request->getExists('post', 'id')){
                $client->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité client soit valide
            if($client->isValid()){
                $this->_managers->getManagerOf('clients')->save($client);
                $this->_application->getUser()->setFlash($client->isNew()?'Le client à bien été ajouté.':'Le client à bien été modifié.');
                $this->_application->getResponse()->redirect('/comparateur/admin/clients/');
            }else{
                $this->_page->addVar('erreurs', $client->getErrors());
                $this->_page->addVar('client', $client);
            }
        }
    }
}