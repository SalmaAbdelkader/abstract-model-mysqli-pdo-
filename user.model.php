<?php



session_start();

use LDAP\Result;
require_once "config/connect.php";
require 'abstractmodel.php';
require "users.class.php";




// This Function For Returning Data To The Form When I Want To Update My Data
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['user_id'])) {
    $user_id = filter_input(INPUT_GET, "user_id", FILTER_SANITIZE_NUMBER_INT);
    // Check If user_id > 0 or not
    if ($user_id > 0) {
        $user = users::getDataByPrimaryKey($user_id);
        return $user;
    }
}

// This function Using for Deleting User based On $user_id
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['user_id'])) {
    $user_id = filter_input(INPUT_GET, "user_id", FILTER_SANITIZE_NUMBER_INT);
    // Check If user_id > 0 or not
    if ($user_id > 0) {
        $result = users::getDataByPrimaryKey($user_id);
        if ($result->delete() === true) {

            $_SESSION['msg']=  '<div class=" container alert alert-success"> User Deletes Successfully </div> ';
           
            header("location: index.php");
            session_write_close();
        }
    }
}

 
// Inserting Data Of User in the Table User

if(isset($_POST['submit'])) {

    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);
    $age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_NUMBER_INT);
    $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $salary = filter_input(INPUT_POST, "salary", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $tax = filter_input(INPUT_POST, "tax", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
     
    // Updating Data Of User
    if (isset($_POST['user_id'])) {
        $user_id = filter_input(INPUT_POST, "user_id", FILTER_SANITIZE_NUMBER_INT);
        if($user_id > 0)
        {
            $user = users::getDataByPrimaryKey($user_id);
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->age = $age;
            $user->address = $address;
            $user->salary = $salary;
            $user->tax = $tax;

        }
             
    } // Inserting Data Of User
    else {
        $user = new users($name, $email, $password, $age, $address, $salary, $tax);
        
    }
    
    if ($user->save() ===  true) {
        $_SESSION['msg']=  '<div class=" container alert alert-success"> User Saved Successfully </div> ';
        header("location: index.php");
        session_write_close();
    } else {

        $_SESSION['msg'] = '<div class=" container alert alert-danger">SomeThing Wrong In Saving Data of Users </div> ';
    }
}


// Selecting Data From Table Users And Showing In Table 

function view()
{
    $result = users::getAllData();   
    return $result;
}