<?php

class Users_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        if( ! Zend_Auth::getInstance ()->hasIdentity() ) {
	       $this->_redirect ( 'default' );
	   }
    }

    public function indexAction()
    {
        $usersM = new Application_Model_UsersMapper();
        $this->view->users = $usersM->fetchAll();
        
        $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        $this->_helper->flashMessenger->clearCurrentMessages();
    }
    
    public function deleteAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getParam('id');
        
        $usersM = new Application_Model_UsersMapper();
        $usersM->delete($id);
        
        $this->_helper->flashMessenger->addMessage('User deleted !');
        $this->_redirect ( 'users' );
    }


}

