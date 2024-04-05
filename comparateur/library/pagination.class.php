<?php

namespace library;

/**
 * Class pagination
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class pagination {
    
    private $_currentPage;
    private $_nbPages;
    private $_nbTotalRecords;
    private $_nbPageRecords;
    private $_range;
    private $_url;
    
    /**
     * Constructor
     * @param string $query
     * @param int $nbPageRecords
     * @param int $currentPage
     */
    public function __construct($nbRecords, $nbPageRecords, $currentPage, $url, $range = 5) {
        $this->_currentPage = $currentPage;
        $this->_nbPageRecords = $nbPageRecords;
        $this->_url = $url;
        $this->_nbTotalRecords = $nbRecords;
        $this->_nbPages = ceil($this->_nbTotalRecords / $this->_nbPageRecords);
        $this->_range = $range;
    }
    
    /**
     * display() - Affiche la pagination
     * @return string
     */
    public function display(){
        if($this->_currentPage <= $this->_range){
            $debut = 1;
            if(($this->_nbTotalRecords/$this->_nbPageRecords) > $this->_range){
                $fin = $this->_range;
            } else {
                $fin = 1;
            }      
        }else{
            $debut = ((ceil($this->_currentPage/$this->_range) - 1) * $this->_range) + 1;
            if((ceil($this->_currentPage/$this->_range) * $this->_range) < $this->_nbPages){
                $fin = ceil($this->_currentPage/$this->_range) * $this->_range;
            }else{
                $fin = $this->_nbPages;
            }
        }
        $result = '<nav><ul class="pagination">' . "\r\n";
        $result .= '<li class="pages" title="' . ($this->_nbTotalRecords > 1?$this->_nbTotalRecords . ' Enregistrements':$this->_nbTotalRecords . ' enregistrement') . '">Page ' . $this->_currentPage . ' sur ' . $this->_nbPages . '</li>' . "\r\n";
        if($this->_currentPage == 1){
            $result .= '<li class="disabled" title="Premier"><i class="fa fa-fast-backward"></i></li>' . "\r\n";
            $result .= '<li class="disabled" title="Précédant"><i class="fa fa-step-backward"></i></li>' . "\r\n";
        } else {
            $result .= '<li onclick="document.location.href=\'' . $this->_url . '1/' . '\'" title="Premier"><i class="fa fa-fast-backward"></i></li>' . "\r\n";
            $result .= '<li onclick="document.location.href=\'' . $this->_url . ($this->_currentPage - 1) . '/\'" title="Précédant"><i class="fa fa-step-backward"></i></li>' . "\r\n";
        }
        if($this->_currentPage > $this->_range){
            $result .= '<li onclick="document.location.href=\'' . $this->_url . ($this->_currentPage - $this->_range) . '/\'">...</li>' . "\r\n";
        }
        for($i=$debut;$i<=$fin;$i++){
            if($this->_currentPage == $i){
                $result .= '<li class="current">' . $i . '</li>' . "\r\n";
            } else {
                $result .= '<li onclick="document.location.href=\'' . $this->_url . $i . '/\'">' . $i . '</li>' . "\r\n";
            }
        }
        if(($this->_currentPage + $this->_range) <= $this->_nbPages){
            $result .= '<li onclick="document.location.href=\'' . $this->_url . ($this->_currentPage + $this->_range) . '/\'">...</li>' . "\r\n";
        }
        if($this->_currentPage == $this->_nbPages){
            $result .= '<li class="disabled" title="Suivant"><i class="fa fa-step-forward"></i></li>' . "\r\n";
            $result .= '<li class="disabled" title="Dernier"><i class="fa fa-fast-forward"></i></li>' . "\r\n";
        } else {
            $result .= '<li onclick="document.location.href=\'' . $this->_url . ($this->_currentPage + 1) . '/\'" title="Suivant"><i class="fa fa-step-forward"></i></li>' . "\r\n";
            $result .= '<li onclick="document.location.href=\'' . $this->_url . $this->_nbPages . '/\'" title="Dernier"><i class="fa fa-fast-forward"></i></li>' . "\r\n";
        }       
        $result .= '</ul></nav>' . "\r\n";
        echo $result;
    }
}