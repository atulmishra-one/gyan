<?php

class Demands_AddController extends Zend_Controller_Action
{

    public function init()
    {
        if( ! Zend_Auth::getInstance ()->hasIdentity() ) {
	       $this->_redirect ( 'default' );
	   }
    }

    public function indexAction()
    {
        $did = $this->getParam('id');
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            if( ( $this->validate( $request->getPost() ) ) === true ) {
                
                $data = array(
                 'title'            => $request->getPost('title'),
                 'details'          => $request->getPost('details'),
                 'forward'          => $request->getPost('forward'),
                 'distributors_id'  => $request->getPost('distributors_id'),
                 'product_id'       => $request->getPost('product_id'),
                 'caret'            => $request->getPost('caret'),
                 'added_by'         => Zend_Auth::getInstance()->getStorage()->read()->id,
                 'modified_by'      => ''
                );
                
                $demands = new Application_Model_Demands( $data );
                $demandsM = new Application_Model_DemandsMapper();
                
                $demandsM->save($demands);
                
                $this->_helper->flashMessenger->addMessage('<div class="alert alert-success">Success !</div>');
            }
        }
        $distributorsM = new Application_Model_DistributorsMapper();
        $this->view->distributors = $distributorsM->getDistributors();
        
        $productsM = new Application_Model_ProductsMapper();
        $this->view->products = $productsM->getProducts();
        
        $this->view->did = $did;
        
         $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        
        $this->_helper->flashMessenger->clearCurrentMessages();
    }
    
    protected function validate( $data ) {
        
        $productsM = new Application_Model_ProductsMapper();
        $demandsM = new Application_Model_DemandsMapper();
        
        if ( empty( $data['title']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide Title !</div>');
            return;
        }
        
        if ( empty( $data['details']) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">Please provide Details !</div>');
            return;
        }
        
        if( (int)$data['caret']  > ( $productsM->getQty( $data['product_id']) ) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">This product has limited caret in stock !</div>');
            return;
        }
        
        if( ( $data['caret'] ) > ( (int)$productsM->getQty( $data['product_id']) - (int)$demandsM->getCaret( $data['product_id']) ) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">This product has limited caret in stock !</div>');
            return;
        }
        
        if( (int)$demandsM->getCaret( $data['product_id']) >=  (int)$productsM->getQty( $data['product_id'])  ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">This product is out of stock !</div>');
            return;
        }
        
        return true;
    }


}

