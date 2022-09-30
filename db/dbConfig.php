<?php
namespace db\Connection;
use \PDO;
require_once  '../vendor/autoload.php';
class Connection{
  public static $connection= null;
function __construct(){
  //self::$connection = new \PDO("mysql:host=localhost;dbname=test2022",'root' , '');
  // set the PDO error mode to exception

        $this->host     = "localhost";              // Host
        $this->dbname = "test2022";                 // Database Name
        $this->username = "root";              // Username
        $this->password = "";  // Password


        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
        }
        catch(PDOException $e) {
            $this->error = $e->getMessage();
        }
       

    }

	public function query($query) {

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(); 
        } catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 

        $rows = $stmt->fetchAll();
        return $rows;

    }
    	public function fetchOne($query) {

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(); 
        } catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 

        $row = $stmt->fetch();
        return $row;

    }

	public function rowCount($query) {

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(); 
        } catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 

        $count = $stmt->fetchColumn();
        return $count;

    }

	
}

?>