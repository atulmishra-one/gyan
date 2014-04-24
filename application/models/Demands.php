<?php

class Application_Model_Demands
{
    protected $_id;
    protected $_title;
    protected $_details;
    protected $_added_by;
    protected $_modified_by;
    protected $_forward;
    protected $_date_added;
    protected $_approved;
    protected $_distributors_id;
    protected $_product_id;
    protected $_caret;
    
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
    
    public function setProduct_id( $id ) {
        $this->_product_id = (int)$id;
        return $this;
    }
    
    public function getProduct_id() {
        return $this->_product_id;
    }
    
    public function setCaret( $id ) {
        $this->_caret = (int)$id;
        return $this;
    }
    
    public function getCaret() {
        return $this->_caret;
    }
    
    public function setDistributors_id( $id ) {
        $this->_distributors_id = (int)$id;
        return $this;
    }
    
    public function getDistributors_id() {
        return $this->_distributors_id;
    }
    
    public function setTitle( $title ) {
        $this->_title = (string)$title;
        return $this;
    }
    
    public function getTitle() {
        return $this->_title;
    }
    
    public function setDetails( $details ) {
        $this->_details = (string)$details;
        return $this;
    }
    
    public function getDetails() {
        return $this->_details;
    }
    
    public function setAdded_by( $added_by ) {
        $this->_added_by = (string)$added_by;
        return $this;
    }
    
    public function getAdded_by() {
        return $this->_added_by;
    }
    
    public function setModified_by( $modified_by ) {
        $this->_modified_by = (string)$modified_by;
        return $this;
    }
    
    public function getModified_by() {
        return $this->_modified_by;
    }
    
    public function setForward( $forward) {
        $this->_forward = (string)$forward;
        return $this;
    }
    
    public function getForward() {
        return $this->_forward == '' ? 'No' : 'Yes';
    }
    
    public function setApproved( $approved ) {
        $this->_approved = (int)$approved;
        return $this;
    }
    
    public function getApproved() {
        return $this->_approved;
    }
    
    public function setDate_added( $date_added ) {
        $this->_date_added = (string)$date_added;
        return $this;
    }
    
    public function getDate_added() {
        return $this->_date_added;
    }
}

