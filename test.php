<?php


require_once "config/connect.php";
require 'abstractmodel.php';
require "users.class.php";

/*
    ================== Method save() ============== 
    $user = users::getDataByPrimaryKey(19);
    $user->setName('Ahmed Ali') ;
    var_dump($user->save());

*/


/*
    ================== Method update() ============== 
    $user = users::getDataByPrimaryKey(19);
    $user->setName('Ali Ahmed') ;
    var_dump($user->update());

*/

/*
    ================== Method create() ============== 
    $user = new users('ali ahmed', 'ali@d.com', 123, 22, 'cairo', 5000, 1.2);
    echo $user = $user->create();

*/
/*
    ================== Method getDataByPrimaryKey($pk) ============== 
    echo "<pre>";
    $user = users::getDataByPrimaryKey(17);
    var_dump($user);

*/
/*
    ================== Method getAllData() ============== 
    echo "<pre>";
    var_dump(users::getAllData());
*/



/*
    ================== Method get() ============== 
    $user = users::get(
            "SELECT * FROM users WHERE name = :name",
                array(
                    'name' => array(users::DATA_TYPE_STRING, 'mahmoud Ahmed')
                )
            );
    echo "<pre>";
    var_dump($user);

*/

/*
    ================== Method delete() ============== 
    $user = users::getDataByPrimaryKey(19);
    echo $user->delete();
*/

