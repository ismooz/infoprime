<?php

namespace library;

/**
 * Class notNullValidator
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class notNullValidator extends validator {
    
    /**
     * isValid() -
     * @access public
     * @param type $value
     * @return type
     */
    public function isValid($value){
        return $value != '';
    }
}
