<?php

class Application_Model_DistributorsMapper
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
            $this->setDbTable('Application_Model_DbTable_Distributors');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Distributors $distributors) {
        $data = array(
            'initial_name'   => $distributors->getInitial_name(),
            'name'          => $distributors->getName(),
            'email'         => $distributors->getEmail(),
            'contact_no'    => $distributors->getContact_no(),
            'address'       => $distributors->getAddress(),
            'status'        => $distributors->getStatus()
        );
        
       
        if( null == ($id = $distributors->getId())) {
            unset( $data['id']);
            $this->getDbTable()->insert($data);
        }
        else {
            $this->getDbTable()->update( $data, array('id =? ' => $id));
        }
    }
    
    public function fetchAll( $id = false ) {
        if( $id ) {
            $sql = $this->getDbtable()->select()->where('id=?', $id);
            return $this->getDbtable()->fetchRow($sql);
        }
        else {
            
            $sql = $this->getDbtable()->select()->order('id desc');
            
            $adapter =  new Zend_Paginator_Adapter_DbSelect($sql);
            return $adapter;
        }
    }
    
    public function getDistributors() {
        $sql = $this->getDbtable()->select()->where('status=?', 'Active');
        return $this->getDbtable()->fetchAll($sql);
    }
    
    public function delete( $id ) {
        return $this->getDbtable()->delete( array(
            'id=?' => $id
        ));
    }
}

