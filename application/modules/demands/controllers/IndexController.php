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
        
        $u_type = Zend_Auth::getInstance ()->getStorage()->read()->type;
        $u_id = Zend_Auth::getInstance ()->getStorage()->read()->id;
        
        $adapter = $demandsM->fetchAll(false, $u_type, $u_id);
        
        $paginator = new Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber( $this->getParam('page') );
        //$paginator->setItemCountPerPage(1);
        $this->view->demands = $paginator;
        
        $this->view->u_type = $u_type;
        
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

