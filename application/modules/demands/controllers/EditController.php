<?php

class Demands_EditController extends Zend_Controller_Action
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
        
        $demandsM = new Application_Model_DemandsMapper();
        $info = $this->view->demands = $demandsM->fetchAll($id);
        
        
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
                 'added_by'         => $info['added_by'],
                 'modified_by'      => Zend_Auth::getInstance()->getStorage()->read()->id,
                 'id'               => $request->getPost('id')
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
        $this->view->products = $productsM->getProductsAll();
        
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
        
        
        if( (int)$data['caret'] > ( (int)$productsM->getQty( $data['product_id'])- (int)$demandsM->getCaretDemandIdNot( $data['id'], $data['product_id']) ) ) {
            $this->_helper->flashMessenger->addMessage('<div class="alert alert-danger">This product has limited caret in stock !</div>');
            return;
        }
        
        return true;
    }


}

