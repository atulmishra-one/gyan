<?php

class Default_IndexController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->layout()->disableLayout();
    }

    public function indexAction() {
        $request = $this->getRequest();
        $formData = $request->getPost();
        if ($request->isPost()) {
            try {
                if ($this->_process($formData)) {
                    $auth = Zend_Auth::getInstance();
                    if ($auth->hasIdentity()) {
                        $this->_redirect('dashboard/index');
                    }
                } else {

                    $this->_helper->flashMessenger->addMessage('Wrong username and password!');
                }
            } catch (Exception $e) {
                echo $e;
            }
        }
        // $this->view->messages = $this->_helper->flashMessenger->getMessages();
        $this->view->messages = array_merge(
                $this->_helper->flashMessenger->getMessages(), $this->_helper->flashMessenger->getCurrentMessages()
        );
        $this->_helper->flashMessenger->clearCurrentMessages();
    }

    protected function _process($values) {

        $db = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($db);
        $authAdapter->setTableName('users');
        $authAdapter->setIdentityColumn('email');
        // convert password in md5
        $pass = md5($values['password']);
        $authAdapter->setCredentialColumn('password');
        $authAdapter->setIdentity($values['username']);
        $authAdapter->setCredential($pass);
        $authAdapter->getDbSelect()->where('status = "Active"'); // added
        $auth = Zend_Auth::getInstance();

        $result = $auth->authenticate($authAdapter);


        if ($result->isValid()) {
            $user = $authAdapter->getResultRowObject();
            $auth->getStorage()->write($user);

            return true;
        } else {

            return false;
        }
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->flashMessenger->addMessage('You have successfully logged out');
        $this->_helper->redirector('index');
    }

}
