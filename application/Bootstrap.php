<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_front;


	public function _initDispatch()
	{
		Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH. '/helpers');
        
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Gyan_Acl());
	}
	
	public function _initSession()
	{
	   Zend_Session::start();
	   $this->bootstrap('layout');
           $layout = $this->getResource('layout');
	   $view = $layout->getView();
	   $auth = Zend_Auth::getInstance ();
	   $view->current_user_name = null;
           if( isset( $auth->getStorage()->read()->name ) )
	   {
		$view->current_user_name = $auth->getStorage()->read()->name;
	   }
	   
	}
}

