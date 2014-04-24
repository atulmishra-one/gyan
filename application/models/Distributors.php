<?php

class Application_Model_Distributors
{
    protected $_id;
    protected $_initial_name;
    protected $_name;
    protected $_email;
    protected $_contact_no;
    protected $_address;
    protected $_status;
    
    public function __construct( array $options = null) {
        
        if(is_array($options) ) {
            $this->setOptions( $options);
        }
    }
    
    public function __set($name, $value) {
        $method = 'set'. $name;
        
        if( ('mapper' == $name)  || !method_exists($this, $method)) {
            throw new Exception('Invalid Userstype property');
        }
        
        $this->$method($value);
    }
    
    public function __get($name) {
        $method = 'get'.$name;
        
        if( ('mapper' == $name)  || !method_exists($this, $method)) {
            throw new Exception('Invalid Userstype property');
        }
        
        return $this->$method();
    }
    
    public function setOptions( array $options) {
        $methods = get_class_methods($this);
        
        foreach( $options as $key => $value ) {
            $method = 'set'.ucfirst($key);
            
            if( in_array( $method, $methods)) {
                $this->$method($value);
            }
        }
        
        return $this;
    }
    
    public function setId( $id ) {
        $this->_id = (int)$id;
        return $this;
    }
    
    public function getId() {
        return $this->_id;
    }
    
    public function setInitial_name( $name ) {
        $this->_initial_name = (string)$name;
        return $this;
    }
    
    public function getInitial_name() {
        return $this->_initial_name;
    }
    
    public function setName( $name ) {
        $this->_name = (string)$name;
        return $this;
    }
    
    public function getName() {
        return $this->_name;
    }
    
    public function setEmail( $email ) {
        $this->_email = (string)$email;
        return $this;
    }
    
    public function getEmail() {
        return $this->_email;
    }
    
    public function setContact_no( $contact ) {
        $this->_contact_no = (string)$contact;
        return $this;
    }
    
    public function getContact_no() {
        return $this->_contact_no;
    }
    
    public function setAddress( $address ) {
        $this->_address = (string)$address;
        return $this;
    }
    
    public function getAddress() {
        return $this->_address;
    }
    
    public function setStatus( $status) {
        $this->_status = (string)$status;
        return $this;
    }
    
    public function getStatus() {
        return $this->_status == '' ? 'Inactive' : 'Active';
    }
}

