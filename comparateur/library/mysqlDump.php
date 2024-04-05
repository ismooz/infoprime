<?php

namespace library;
use library\database\MyPDO;

class mysqlDump {
    
    // Same as mysqldump
    const MAXLINESIZE = 1000000;
    
    /**
     * @access private
     * @var type 
     */
    private $_db;
    
    private $_tablesStructure = array();
    
    public function __construct(MyPDO $db) {
        $this->_db = $db;
    }
    
    public function getDataStructure(){
        
    }
    
    public function getDatabaseStructure(){
        
    } 
    
    public function getTableStructure(){
        $sql = 'SHOW TABLES';
        $tables = $this->_db->query($sql)->fetchAll(\PDO::FETCH_COLUMN);
        foreach($tables as $table){
            $sqlTable = 'SHOW CREATE TABLE ' . $table;
            $this->_tablesStructure[] = $this->_db->query($sqlTable)->fetch(\PDO::FETCH_ASSOC)['Create Table'];
        }
        foreach($this->_tablesStructure as $table){
            echo($table . '<br/><br/>');
        }
    }
}
