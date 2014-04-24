<?php

class Application_Model_ProductsMapper
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
            $this->setDbTable('Application_Model_DbTable_Products');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Products $products) {
        $data = array(
            'name'          => $products->getName(),
            'price'         => $products->getPrice(),
            'qty'           => $products->getQty(),
            'status'        => $products->getStatus(),
            'date_added'    => new Zend_Db_Expr('NOW()')
        );
        
       
        if( null == ($id = $products->getId())) {
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
            /*
            return $this->getDbtable()->fetchAll($sql);
            */
            $adapter =  new Zend_Paginator_Adapter_DbSelect($sql);
            return $adapter;
        }
    }
    
    public function getProducts() {
        $sql = $this->getDbtable()->select()->where('status=?', 'Active');
        return $this->getDbtable()->fetchAll($sql);
    }
    
    public function getQty($id) {
        $sql = $this->getDbtable()->select()->where('id=?', $id);
        $row = $this->getDbtable()->fetchRow($sql);
        return $row->qty;
    }
    
    public function delete( $id ) {
        return $this->getDbtable()->delete( array(
            'id=?' => $id
        ));
    }
}

