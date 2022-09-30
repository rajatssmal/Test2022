<?php
require_once  './vendor/autoload.php';
use Connection\Connection ;
$db=new Connection;

// Escape all $_POST variables to protect against SQL injections
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
if(isset($_POST['address'])){
$address = $_POST['address'];
}
else{
    $address = '';
}
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$result = $db->rowCount("SELECT * FROM customers WHERE email='$email'") ;

if ( $result > 0 ) {

    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");

}
else {

    $sql = "INSERT INTO customers (first_name, last_name, email, phone, address, password, hash, created, modified) "
            . "VALUES ('$first_name','$last_name','$email','$phone','$address','$password','".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";

    if ( $db->query($sql) ){

        $_SESSION['active'] = 1; 
        $_SESSION['logged_in'] = true;
        $user = $db->query("SELECT * FROM customers WHERE email='$email'");
        $_SESSION['sessCustomerID'] = $user['id'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['first_name'] = $_POST['firstname'];
        $_SESSION['last_name'] = $_POST['lastname'];

        header("location: ../view/profile.php");

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
