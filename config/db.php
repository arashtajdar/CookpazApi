<?php
class DatabaseClass {

    // configuration variables are here
    private $host = "localhost";
    private $username = "root";
    private $pass = "11111111";
//    private $pass = "";
    private $db = "cookpaz";

    public $connection;

    // Try to connect to Database
    public function connect(){
        $this->connection = null;
        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->pass);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "You have Error >>> " . $exception->getMessage();
        }
        return $this->connection;
    }
}
?>
