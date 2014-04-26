<?php

class Gyan_Acl extends Zend_Controller_Plugin_Abstract
{
    private $_acl;
    
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $acl = $this->_getAcl();
        $role = $this->_getRole();
        
        $module = $request->getModuleName();
        
        $resource = $module;
        
        if( $acl->has($resource) ) {
            if( ! $acl->isAllowed($role, $resource) ) {
                $redirector = new Zend_Controller_Action_Helper_Redirector();
                $redirector->gotoUrlAndExit('/', array('index'));
            }
        }
    }
    
    protected function _getAcl()
    {
        $acl = new Zend_Acl();
        
        $roles = array('admin', 'headoffice', 'areamanager', 'plant', 'account', 'guest');
        
        foreach( $roles as $role ) {
            $acl->addRole( new Zend_Acl_Role($role) );
        }
        
        $acl->add( new Zend_Acl_Resource('dashboard') );
        $acl->add( new Zend_Acl_Resource('products') );
        $acl->add( new Zend_Acl_Resource('users') );
        $acl->add( new Zend_Acl_Resource('distributors') );
        $acl->add( new Zend_Acl_Resource('demands') );
        
        $acl->allow('admin');
        
        $acl->allow('headoffice', array('dashboard', 'distributors', 'demands'));
        $acl->deny('headoffice', array('products', 'users'));
        //$acl->deny('headoffice', 'users');
		
        $acl->allow('plant', array('dashboard','demands'));
        $acl->deny('plant', array('distributors', 'users', 'products'));
        
        $acl->allow('areamanager', array('demands'));
        $acl->deny('areamanager', array('dashboard','distributors', 'users', 'products'));
        
		return $this->_acl = $acl;
    }
    
    protected function _getRole()
    {
        $auth = Zend_Auth::getInstance();
        if( $auth->hasIdentity() ) {
            $identity = $auth->getIdentity();
            
            switch( $identity->type ) {
                case 1:
                 $role = 'admin';
                break;
                
                case 2:
                 $role = 'headoffice';
                break;
                
                case 3:
                  $role = 'areamanager';
                break;
                
                case 4:
                  $role = 'plant';
                break;
                
                case 5:
                 $role = 'account';
                break;
                
                default:
                 $role = 'guest';
                break;
            }
           return $role;
        }
    }
}