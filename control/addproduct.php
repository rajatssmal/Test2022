<?php
use app\conection;
// include database configuration file
$db=new connetion();

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
        extract($_POST);
        $query = $db->query("INSERT INTO `products` (`name`, `description`, `price`, `created`, `modified`) VALUES
        ('".$name."', '".$description."',".$price.", '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."');");
        header("Location: admin.php");
    }
    }else{
        header("Location: home.php");
    }
