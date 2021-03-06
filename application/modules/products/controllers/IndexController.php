<?php

class Products_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        if( ! Zend_Auth::getInstance ()->hasIdentity() ) {
	       $this->_redirect ( 'default' );
	   }
    }

    public function indexAction()
    {
        $productsM = new Application_Model_ProductsMapper();
        
        $adapter = $productsM->fetchAll();
        
        $paginator = new Zend_Paginator($adapter);
        $paginator->setCurrentPageNumber( $this->getParam('page') );
        //$paginator->setItemCountPerPage(1);
        $this->view->products = $paginator;
        
        $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        $this->_helper->flashMessenger->clearCurrentMessages();
    }
    
     public function deleteAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getParam('id');
        
        $productsM = new Application_Model_ProductsMapper();
        $productsM->delete($id);
        
        $this->_helper->flashMessenger->addMessage('Product deleted !');
        $this->_redirect ( 'products' );
    }


}

