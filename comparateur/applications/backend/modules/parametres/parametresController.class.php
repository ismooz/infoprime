<?php

namespace applications\backend\modules\parametres;
use library\controllers\backController;

class parametresController extends backController {
    
    public function executeIndex(){
        // Définit un titre à la page
        $this->_page->addVar('title', 'Parmètres');
    }
    
}