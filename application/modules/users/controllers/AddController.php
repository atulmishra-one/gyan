<?php

class Users_AddController extends Zend_Controller_Action
{

    public function init()
    {
        if( ! Zend_Auth::getInstance ()->hasIdentity() ) {
	   $this->_redirect ( 'default' );
	}
    }

    public function indexAction()
    {
        
        $users_types = new Application_Model_UsersTypeMapper();
        $this->view->users_role = $users_types->fetchAll();
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            if( ( $this->validate( $request->getPost() ) ) === true ) {
                // save data
                $users = new Application_Model_Users( $request->getPost() );
                $usersM = new Application_Model_UsersMapper();
                $usersM->save($users);
               $this->_helper->flashMessenger->addMessage('<div class="alert alert-success">Success !</div>');
            }
        }
        
         
         $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        
        $this->_helper->flashMessenger->clearCurrentMessages();
        
    }
    
    protected function validate( $data ) {
        
        $users = new Application_Model_UsersMapper();
        
        if( empty( $data['name']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide name !</div>');
            return;
        }
        
        if( empty( $data['email']) || ! filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide validate email !</div>');
            return;
        }
        
        if ( empty( $data['type']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide role !</div>');
            return;
        }
        
        if ( empty( $data['password']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide role !</div>');
            return;
        }
        
        if( sizeof( $users->checkEmail($data['email']) ) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Sorry, username exists !</div>');
            return;
        }
        return true;
    }


}

