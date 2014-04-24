<?php

class Application_Model_UsersMapper
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
            $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }
    
    public function checkEmail($email) {
        $sql = $this->getDbtable()
                ->select()
                ->where('email=?', $email)
                ->limit(1, 0);
        return $this->getDbtable()->fetchRow( $sql );
    }

    public function save(Application_Model_Users $users) {
        $data = array(
            'email'         => $users->getEmail(),
            'password'      => md5($users->getPassword()),
            'name'          => $users->getName(),
            'status'        => $users->getStatus(),
            'date_added'    => new Zend_Db_Expr('NOW()'),
            'type'          => $users->getType()
        );
        
        if( null == ($id = $users->getId())) {
            unset( $data['id']);
            $this->getDbTable()->insert($data);
        }
        else {
            $this->getDbTable()->update( $data, array('id =? ' => $id));
        }
    }
    
    public function savePassword($npass, $opass, $uid) {
        
        $sql = $this->getDbtable()->select()
        ->where('id=?', $uid)
        ->where('password=?', md5($opass) );
        
        $check = $this->getDbtable()->fetchRow($sql);
        
        if( !sizeof($check) ) {
            throw new Exception('Password doesnot match');
        }
        
        $data = array(
            'password' => md5($npass)
        );
        
        $this->getDbtable()->update($data, array(
        'id=?' => $uid
        ));
    }
    public function fetchAll($id = false) {
        
        
        $sql = $this->getDbtable()->select()
                ->setIntegrityCheck(false)
                ->from('users as u', array('u.id as uid', 'u.password' ,'u.email','u.status', 'u.name as uname', 'ut.name as u_type', 'ut.id as kid') )
                ->join('user_type as ut', 'ut.id=u.type' );
        
        if( $id ) {
           $sql->where('u.id=?', $id);  
        }
        
        $resultSet = $this->getDbtable()->fetchAll($sql);
        $result = array();
        
        foreach ( $resultSet as $row ) {
            if( $row['u_type'] == 'ADMIN' ) {
                continue;
            }
            $result[] = array(
                'uid'   => $row['uid'],
                'uname' => ucwords($row['uname']),
                'email' => $row['email'],
                'status' =>$row['status'],
                'u_type' => self::filterName($row['u_type']),
                'password'=> $row['password'],
                'kid'      => $row['kid']
            );
        }
        
        return $result;
    }
    
    protected static function filterName( $str ) {
        return ucfirst( str_replace( '_', ' ', strtolower($str) ) );
    }
    
    public function delete( $id ) {
        return $this->getDbtable()->delete( array(
            'id=?' => $id
        ));
    }
}

