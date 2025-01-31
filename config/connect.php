<?php



     define('DB_SERVER', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'testing');
     define('DSN', "mysql:host=".DB_SERVER .";dbname=". DB_NAME);


     

     try{

            $connection = new PDO(DSN, DB_USER, DB_PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch(PDOException $e)
        {
          echo "Connection failed: " . $e->getMessage();
        }