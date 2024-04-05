<?php

namespace applications\backend\modules\comparateur;
use library\controllers\backController;
use library\request;

/**
 * Class HomeController
 */
class comparateurController extends backController {
    
    public function executeOptions(){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Options');
        $options = array();
        $this->_page->addVar('news', $options);
    }
    
    public function executeOptionsUpdate(request $request){
        if($request->getExists('post', '')){
            $this->processForm();
        }
        $this->_page->addVar('title', '');
    }
}