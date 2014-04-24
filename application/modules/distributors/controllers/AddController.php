<?php

class Distributors_AddController extends Zend_Controller_Action
{

    public function init()
    {
        if( ! Zend_Auth::getInstance ()->hasIdentity() ) {
	       $this->_redirect ( 'default' );
	   }
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            if( ( $this->validate( $request->getPost() ) ) === true ) {
                
                $distributors = new Application_Model_Distributors( $request->getPost() );
                $distributorsM = new Application_Model_DistributorsMapper();
                
                $distributorsM->save($distributors);
                
                $this->_helper->flashMessenger->addMessage('<div class="alert alert-success">Success !</div>');
            }
        }
        
        $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        
        $this->_helper->flashMessenger->clearCurrentMessages();
    }
    
    protected function validate( $data ) {
        
        if ( empty( $data['initial_name']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide Initial name !</div>');
            return;
        }
        
        if ( empty( $data['name']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide name !</div>');
            return;
        }
        
        if ( empty( $data['email']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide email !</div>');
            return;
        }
        
        if ( empty( $data['contact_no']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide Contact no !</div>');
            return;
        }
        
        return true;
    }


}

