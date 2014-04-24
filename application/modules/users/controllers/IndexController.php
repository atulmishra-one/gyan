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
    
    public function changepasswordAction()
    {
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $usersM = new Application_Model_UsersMapper();
            try{
                $uid = Zend_Auth::getInstance()->getStorage()->read()->id;
                $npass = $request->getPost('npass');
                $opass = $request->getPost('opass');
                $usersM->savePassword($npass, $opass, $uid);
                $this->_helper->flashMessenger->addMessage('<div class="alert alert-success">Success !</div>');
            }
            catch(Exception $e) {
                $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">'.$e->getMessage().' !</div>');
            }
        }
        
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

