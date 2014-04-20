<?php

class Products_EditController extends Zend_Controller_Action
{

    public function init()
    {
        if( ! Zend_Auth::getInstance ()->hasIdentity() ) {
	   $this->_redirect ( 'default' );
	}
    }

    public function indexAction()
    {
        // action body
    }


}

