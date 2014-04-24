<?php

class Demands_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        if( ! Zend_Auth::getInstance ()->hasIdentity() ) {
	       $this->_redirect ( 'default' );
	   }
    }

    public function indexAction()
    {
        $demandsM = new Application_Model_DemandsMapper();
        
        $adapter = $demandsM->fetchAll();
        
        $paginator = new Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber( $this->getParam('page') );
        //$paginator->setItemCountPerPage(1);
        $this->view->demands = $paginator;
        
        $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        $this->_helper->flashMessenger->clearCurrentMessages();
    }
    
    public function approveAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getParam('id');
        
        // SEND SMS HERE
        
        $demandsM = new Application_Model_DemandsMapper();
        $demandsM->approveDemand($id);
        
        $this->_helper->flashMessenger->addMessage('Demand approved !');
        $this->_redirect ( 'demands' );
        
    }
    public function deleteAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getParam('id');
        
        $demandsM = new Application_Model_DemandsMapper();
        $demandsM->delete($id);
        
        $this->_helper->flashMessenger->addMessage('Demand deleted !');
        $this->_redirect ( 'demands' );
    }


}

