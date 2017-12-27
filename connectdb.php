<?php
/**
 * Created by PhpStorm.
 * User: h4090
 * Date: 2017/12/26
 * Time: 下午 05:00
 */

class Database
{
    private $host = "localhost";
    private $db_name = "qccdb";
    private $username = "root";
    private $password = "9901";
    public $conn;

    public function dbConnection()
    {

        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
