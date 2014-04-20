<?php

class Application_Model_UsersTypeMapper
{
    protected $_dbTable;
    
    public function setDbTable( $dbTable) {
        if(is_string($dbTable) ) {
            $dbTable = new $dbTable();
        }
        
        if( !$dbTable instanceof Zend_Db_Table_Abstract ) {
            throw new Exception('Invalid table data gateway provided');
        }
        
        $this->_dbTable = $dbTable;
        return $this;
    }
    
    public function getDbtable() {
        if( null == $this->_dbTable ) {
            $this->setDbTable('Application_Model_DbTable_UserType');
        }
        return $this->_dbTable;
    }
    

    public function fetchAll() {
        $resultSet = $this->getDbtable()->fetchAll();
        $results = array();
        foreach ( $resultSet as $row ) {
            if( $row->name == 'ADMIN' ) {
                continue;
            }
            $results[] = array(
                'id'    => $row->id,
                'name'  => self::filterName($row->name)
            );
        }
        
        return $results;
    }
    
    protected static function filterName( $str ) {
        return ucfirst( str_replace( '_', ' ', strtolower($str) ) );
    }
}

