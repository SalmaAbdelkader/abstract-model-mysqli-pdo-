<?php

/* 
  -- All Methods In This Class are making Operations On DataBase [ Create - Update - Read - Delete]
  -- In This Class We Use Static (Late Static Binding) => to  allows a child class to reference its parent class's static properties or methods
*/

class AbstractModel{

    // Constants Of Data Types In My Database

    const DATA_TYPE_BOOL = PDO::PARAM_BOOL;
    const DATA_TYPE_STRING = PDO::PARAM_STR;
    const DATA_TYPE_INTEGER = PDO::PARAM_INT;
    const DATA_TYPE_DECIMAL = 4;

    // This Function used to prepare Values Which Takes from $table_schema array And Make Binding To These Values
    public function prepareValues(PDOStatement &$stmt)
    {

        foreach(static::$table_schema as $table_column => $type)
        {
            if($type == 4)
            {    
                $sanatized_value = filter_var($table_column, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$table_column}", $this->$table_column );
            }else{

               $stmt->bindValue(":{$table_column}", $this->$table_column, $type );
            }
        }
        return $stmt;
    }
    
    // This Function Used To buliding parameters of the sql statement By making loop of the $table_schema array 
    private static function buildNameParametersSql()
    {
        $parameters_name = '';
        foreach(static::$table_schema as $table_column => $type)
        {
            $parameters_name .= $table_column. '=:' .$table_column . ',';
        }
        // Triming The $parameters_name
        return trim($parameters_name, ', ');
    }

    // This Function Used To  Inserting data Of User In DataBase
    public  function create()
    {
        global $connection;
        $sql = "INSERT INTO ". static::$table_name . " SET " . self::buildNameParametersSql();
        $stmt = $connection->prepare($sql);
        $this->prepareValues($stmt);    
        return  $stmt->execute();
        
        
    }

    // This function Used To Check if he exist static::$primary_key == null , it will call create function 
    // else it will call Update Function which mean That User Have Account 
    public function save()
    {
        return  $this->{static::$primary_key} == null ? $this->create() : $this->update();
    }

     // This Function Used To Updating data Of User In DataBase Dased On $primary Key
    public  function update()
    {
        global $connection;
        $sql = "UPDATE ". static::$table_name . " SET " . self::buildNameParametersSql() . ' WHERE '. static::$primary_key . ' = ' . $this->{static::$primary_key};
        $stmt = $connection->prepare($sql);
         $this->prepareValues($stmt);    
        return  $stmt->execute();
        
        
    }

     // This Function Used To Deleteing data Of User from DataBase Dased On $primary Key
    public  function delete()
    {

        global $connection;
        $sql = "DELETE FROM ". static::$table_name . ' WHERE '. static::$primary_key . ' = ' . $this->{static::$primary_key};
        $stmt = $connection->prepare($sql);  
        return  $stmt->execute();
        
        
    }

    /* 
       -- Fethcing data from database as a properties of a class called users 
       -- PDO::FETCH_PROPS_LATE => used to calling the constructor before setting the properties , so 
       -- we set array with the columns name in the constructor
       -- (get_called_class()) => Retrurn The Name Of Class That Called This Function
       -- array_keys() => This Function Used To Return A Keys Of The $table_schema Of This Class 
    */
    public static function getAllData()
    {

        global $connection;
        $sql = "SELECT * FROM ". static::$table_name ;
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$table_schema)); 
        return  (is_array($result) && !empty($result)) ? $result : false;
        
    }

    /*
    -- Fethcing data from database as a properties of a class called $Obj Based On $primary key 
    */

    public static function getDataByPrimaryKey($pk)
    {

        global $connection;
        $sql = "SELECT * FROM ". static::$table_name . ' WHERE '. static::$primary_key . ' = ' . $pk;
        $stmt = $connection->prepare($sql);  
        if($stmt->execute() === true )
        {
            $obj = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$table_schema));
            $obj = array_shift($obj);
            return $obj;
        }
        return false;
    }


    /*
         This Function used to return Data Of user Based On The Sql Statement And The $options array 

    */
    public static function get($sql , $options = array())
    {
        global $connection;
        $stmt = $connection->prepare($sql);
        if(!empty($options))
        {
            // Looping in The Array $options 
            foreach($options as $table_column => $type)
            {
                if($type[0] == 4)
                {    
                    $sanatized_value = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$table_column}", $sanatized_value );
                }else{

                $stmt->bindValue(":{$table_column}", $type[1], $type[0] );
                }
            }  

        }
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$table_schema)); 
        return  (is_array($result) && !empty($result)) ? $result : false;
        
        
    }


    public static function getOne($sql, $options = array())
    {
        $result = static::get($sql, $options);
        return $result === false ? false : $result->current();
    }

    

}