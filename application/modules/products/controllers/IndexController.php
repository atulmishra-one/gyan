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
        $this->view->products = $productsM->fetchAll();
        
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

