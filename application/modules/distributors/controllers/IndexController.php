<?php

class Distributors_IndexController extends Zend_Controller_Action
{

    public function init()
    {
       if( ! Zend_Auth::getInstance ()->hasIdentity() ) {
	       $this->_redirect ( 'default' );
	   }
    }

    public function indexAction()
    {
        $distributorsM = new Application_Model_DistributorsMapper();
        
        $adapter = $distributorsM->fetchAll();
        
        $paginator = new Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber( $this->getParam('page') );
        //$paginator->setItemCountPerPage(1);
        $this->view->distributors = $paginator;
        
        $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        $this->_helper->flashMessenger->clearCurrentMessages();
    }
    
     public function deleteAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getParam('id');
        
        $distributorsM = new Application_Model_DistributorsMapper();
        $distributorsM->delete($id);
        
        $this->_helper->flashMessenger->addMessage('Distributors deleted !');
        $this->_redirect ( 'distributors' );
    }


}

