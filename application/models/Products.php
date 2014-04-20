<?php

class Application_Model_Products
{
    protected $_id;
    protected $_name;
    protected $_price;
    protected $_qty;
    protected $_status;
    protected $_date_added;
    
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
    
    public function setName( $name ) {
        $this->_id = (string)$name;
        return $this;
    }
    
    public function getName() {
        return $this->_name;
    }
    
    public function setPrice( $price ) {
        $this->_price = (string)$price;
        return $this;
    }
    
    public function getPrice() {
        return $this->_price;
    }
    
    public function setQty( $qty ) {
        $this->_qty = (string)$qty;
        return $this;
    }
    
    public function getQty() {
        return $this->_qty;
    }
    
    public function setStatus( $status) {
        $this->_status = (string)$status;
        return $this;
    }
    
    public function getStatus() {
        return $this->_status == '' ? 'Inactive' : 'Active';
    }
    
    public function setDateAdded( $date_added ) {
        $this->_date_added = (string)$date_added;
        return $this;
    }
    
    public function getDateAdded() {
        return $this->_date_added;
    }
}

