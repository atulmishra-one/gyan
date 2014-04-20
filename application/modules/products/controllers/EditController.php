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
        $id = $this->getParam('id');
        
        $productsM = new Application_Model_ProductsMapper();
        $this->view->products = $productsM->fetchAll($id);
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            if( ( $this->validate( $request->getPost() ) ) === true ) {
                
                //print_r($request->getPost());
                $products = new Application_Model_Products( $request->getPost() );
                $productsM = new Application_Model_ProductsMapper();
                
                $productsM->save($products);
                $this->_helper->flashMessenger->addMessage('<div class="alert alert-success">Success !</div>');
            }
        }
        
        $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        
        $this->_helper->flashMessenger->clearCurrentMessages();
    }
    
    protected function validate( $data ) {
        
        if ( empty( $data['name']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide name !</div>');
            return;
        }
        
        if ( empty( $data['price']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide price !</div>');
            return;
        }
        
        return true;
    }


}

