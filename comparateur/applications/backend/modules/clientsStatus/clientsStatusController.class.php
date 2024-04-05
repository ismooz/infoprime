<?php

namespace applications\backend\modules\clientsStatus;
use library\controllers\backController;
use library\request;
use library\entities\clientStatusEntity;
use library\pagination;

/**
 * Class clientsStatusController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class clientsStatusController extends backController {   
    
    /**
     * executeInsert() - Exécute la page index
     * @access public
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbClientsStatus = $this->_application->_config->get('nbClientsStatus');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Clients status');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbClientsStatus) - $nbClientsStatus;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des status de clients
        $clientsStatus = $this->_managers->getManagerOf('clientsStatus')->getList($debut, $nbClientsStatus);
        // Ajoute la variable $clientsStatus à la page
        $this->_page->addVar('clientsStatus', $clientsStatus);
        // Récupère le nombre de status de clients
        $nbClientsStatusTotal = $this->_managers->getManagerOf('clientsStatus')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbClientsStatusTotal, $nbClientsStatus, $current_page, '/comparateur/admin/clients/status/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);
    }
 
    /**
     * executeInsert() - Execute la page d'insertion d'un status de client
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
        $this->_page->addVar('title', 'Insértion d\'un status client');
        // Récupère la liste des status de clients
        $clientsStatus = $this->_managers->getManagerOf('clientsStatus')->getList();
        // Ajoute la variable $clientsStatus à la page
        $this->_page->addVar('clientsStatus', $clientsStatus);
    }      
    
    /**
     * executeUpdate() - Exécute la page de mise à jour du status de client
     * @access public
     * @param request $request
     * @return void
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name')){
            $this->_processForm($request);
        } else {
            $this->_page->addVar('clientStatus', $this->_managers->getManagerOf('clientsStatus')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'un client');      
    }     

    /**
     * executeDelete() - Execute la Suppression un client
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime le status du client
        $this->_managers->getManagerOf('clientsStatus')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Ce status de client à été correctement supprimée !');
        // Redirige vers la page index des status de clients
        $this->_application->getResponse()->redirect('/comparateur/admin/clientsStatus/');          
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
            // Définit les champs de l'entité clientStatus
            $clientStatus = new clientStatusEntity(array(
                'name' => $request->getData('post', 'name'),
                'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
                'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'Modification'))
            ));
            // Ajoute l'identifiant à l'entité clientStatus
            if($request->getExists('post', 'id')){
                $clientStatus->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité clientStatus soit valide
            if($clientStatus->isValid()){
                // Vérifie que ce soit un nouveau client status
                if($clientStatus->isNew()){
                    // Recherche le nouveau client status
                    $result = $this->_managers->getManagerOf('clientsStatus')->getUniqueName($clientStatus->getName());
                    // Vérifie si le client status existe déjà
                    if(!is_null($result)){
                        $clientStatus->setError(clientStatusEntity::INVALID_EXISTING_NAME);
                        $this->_page->addVar('erreurs', $clientStatus->getErrors());
                        $this->_page->addVar('clientStatus', $clientStatus);                
                    }else{
                        $this->_managers->getManagerOf('clientsStatus')->save($clientStatus);
                        $this->_application->getUser()->setFlash('Le client à bien été ajouté.');
                        $this->_application->getResponse()->redirect('/comparateur/admin/clientsStatus/');
                    }                
                }else{
                    $this->_managers->getManagerOf('clientsStatus')->save($clientStatus);
                    $this->_application->getUser()->setFlash('Le client à bien été modifié.');
                    $this->_application->getResponse()->redirect('/comparateur/admin/clientsStatus/');                
                }
            }else{
                $this->_page->addVar('erreurs', $clientStatus->getErrors());
                $this->_page->addVar('clientStatus', $clientStatus);
            }
        }
    }
}
