<?php

class Application_Model_DemandsMapper
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
            $this->setDbTable('Application_Model_DbTable_Demands');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Demands $demands) {
        
        $data = array(
            'title'             => $demands->getTitle(),
            'details'           => $demands->getDetails(),
            'added_by'          => $demands->getAdded_by(),
            'modified_by'       => $demands->getModified_by(),
            'forward'           => $demands->getForward(),
            'distributors_id'   => $demands->getDistributors_id(),
            'product_id'        => $demands->getProduct_id(),
            'caret'             => $demands->getCaret(),
            'date_added'        => new Zend_Db_Expr('NOW()')
        );
        
        if( null == ($id = $demands->getId())) {
            unset( $data['id']);
            $this->getDbTable()->insert($data);
        }
        else {
            $this->getDbTable()->update( $data, array('id =? ' => $id));
        }
    }
    
    public function fetchAll( $id = false , $by = false, $by_id = false ) {
        if( $id ) {
            $sql = $this->getDbtable()->select()->where('id=?', $id);
            return $this->getDbtable()->fetchRow($sql);
        }
        else {
            
            
            $sql = $this->getDbtable()->select()
            ->setIntegrityCheck(false)
            ->from('demands as d', array(
            'd.*', 
            'd.id as did', 
            'ds.id as dsid', 
            'ds.initial_name', 
            'ds.name', 
            'u.name as uname',
            'ut.name as u_type',
            'p.name as pname',
            'd.caret'
             )
            )
            ->join('products as p', 'p.id=d.product_id')
            ->join('users as u', 'u.id=d.added_by')
            ->join('user_type as ut', 'ut.id=u.type')
            ->join('distributors as ds', 'ds.id=d.distributors_id')
            ->order('d.id desc');
            
            if( $by && $by == 3) {
              $sql->where('d.added_by=?', $by_id);   
            }
            
            if( $by && $by == 4 ) {
                $sql->where('d.forward=?', 'Yes');
            }
            
            $adapter =  new Zend_Paginator_Adapter_DbSelect($sql);
            return $adapter;
        }
    }
    
    public function getCaret($pid) {
       /* $sql = $this->getDbtable()->select()->where('product_id=?', $pid);
        $row = $this->getDbtable()->fetchRow($sql);
        return $row->caret;
        */
        $sql = "SELECT SUM(caret) as total FROM demands WHERE product_id=$pid";
        $row = Zend_Db_Table::getDefaultAdapter()->query($sql)->fetch();
        return $row['total'];
    }
    
    public function getCaretDemandIdNot($did, $pid) {
       /* $sql = $this->getDbtable()->select()->where('product_id=?', $pid);
        $row = $this->getDbtable()->fetchRow($sql);
        return $row->caret;
        */
        $sql = "SELECT SUM(caret) as total FROM demands WHERE id != $did AND product_id=$pid";
        $row = Zend_Db_Table::getDefaultAdapter()->query($sql)->fetch();
        return $row['total'];
    }
    
    public function approveDemand( $id ) {
        return $this->getDbtable()->update( array(
            'approved' => 1
        ), array('id=?' => $id));
    }
    
    public function delete( $id ) {
        return $this->getDbtable()->delete( array(
            'id=?' => $id
        ));
    }
}

