<?php

/*
  -- This Class Extends All Methods From AbstractModel 
  -- All Methods In This Class are making Operations Based on The data of User  
*/

class users extends AbstractModel{

    // these properties are private to prevent accessing form outside the class
    private $name;
    private $email;
    private $password;
    private $age;
    private $address;
    private $salary;
    private $tax;

    protected static $table_name = 'users';
    /* 
      -- This Property array contains All The Columns Of Users Table With There Data Types
      -- Data Types are Constants Extends From Abstractmodel  
    */
    protected static $table_schema = array(
        'name'       => self::DATA_TYPE_STRING,
        'email'      => self::DATA_TYPE_STRING,
        'password'   => self::DATA_TYPE_STRING,
        'age'        => self::DATA_TYPE_INTEGER,
        'address'    => self::DATA_TYPE_STRING,
        'salary'     => self::DATA_TYPE_DECIMAL,
        'tax'        => self::DATA_TYPE_DECIMAL
    );

    protected static $primary_key = 'id';

    // this function used to set the data arguments of user 
    // we use construct method to prevent access to the ptoperties from outside the class 
    public function __construct($name, $email, $password, $age, $address, $salary, $tax)
    {
        global $connection;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->age  = $age ;
        $this->address = $address;
        $this->salary = $salary;
        $this->tax = $tax;

    }

    /*
    -- I use a Magic Method to can access a private properties and return my private properties 
    */

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function setName($name)
    {
       return $this->name = $name;
    }

    public function calcSalary(){

        return $this->salary - ($this->salary * $this->tax /100 );
    }

    
    public function getTableName(){

      return   self::$table_name;
    }
}
