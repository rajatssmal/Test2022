<?php
require_once  './vendor/autoload.php';
use Connection\Connection ;

$db= new Connection;

$email = $_POST['email'];

if(!empty($email)){
    $result = $db->rowCount("SELECT * FROM customers WHERE email='$email'");

    if ( $result == 0 ){ // User doesn't exist
        $_SESSION['message'] = "User with that email doesn't exist!";
        header("location: error.php");
    }
    else { // User exists
        $user = $db->fetchOne("SELECT * FROM customers WHERE email='$email'");
        if ( password_verify($_POST['password'], $user['password']) ) {

            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['sessCustomerID'] = $user['id'];
            $_SESSION['logged_in'] = true;
            if ($_SESSION['email']==="admin@g.c") {
              header("location: admin.php");
            }
            else
              header("location: home.php");
        }
        else {
            $_SESSION['message'] = "You have entered wrong password, try again!";
            header("location: error.php");
        }
    }
}
