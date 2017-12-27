<?php

require_once('connectdb.php');

class USER
{

    private $conn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function register($uid,$umail,$upass)
    {
        try
        {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO user(id,email,password) 
		                                               VALUES(:id, :mail, :pass)");

            $stmt->bindparam(":id", $uid);
            $stmt->bindparam(":mail", $umail);
            $stmt->bindparam(":pass", $new_password);

            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    public function doLogin($uid,$umail,$upass)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT id, name, email, password FROM user WHERE id=:uid OR email=:mail ");
            $stmt->execute(array(':uid'=>$uid, ':mail'=>$umail));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1)
            {
                if(password_verify($upass, $userRow['password']))
                {
                    print ($userRow['id']);
                    $_SESSION['user_session'] = $userRow['id'];
                    print ($_SESSION['user_session']);
                    return true;
                }
                else
                {
                    print ("weird");
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}
?>