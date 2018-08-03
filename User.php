<?php

require_once('connectdb.php');

class USER
{

    private $conn;
    private $userconn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;

        $userdb = new UserDB();
        $udb = $userdb->dbConnection();
        $this->userconn = $udb;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);

        return $stmt;
    }

    public function register($uid, $umail, $upass, $level)
    {
        try {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare(
                "INSERT INTO admin(uid,email,password,level) VALUES(:id, :mail, :pass, :level)"
            );

            $stmt->bindparam(":id", $uid);
            $stmt->bindparam(":mail", $umail);
            $stmt->bindparam(":pass", $new_password);
            $stmt->bindparam(":level", $level);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function pkgSign($id)
    {
        try {
            $time = date("Y-m-d H:i:s");
            $stmt = $this->conn->prepare(
                "UPDATE `package_info` SET is_pick=TRUE,timestamp_pickup='$time' WHERE id=:id"
            );

            $stmt->bindparam(":id", $id);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addPackage($rpt, $ptype, $storage, $pid, $timestamp_arrive)
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO package_info(recipients,ptype,storage,pid ,timestamp_arrive) 
		                                               VALUES(:rpt, :ptype, :storage, :pid, :timestamp_arrive)"
            );

            $stmt->bindparam(":rpt", $rpt);
            $stmt->bindparam(":ptype", $ptype);
            $stmt->bindparam(":storage", $storage);
            $stmt->bindparam(":pid", $pid);
            $stmt->bindparam(":timestamp_arrive", $timestamp_arrive);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editPackage($id, $rpt, $ptype, $storage, $pid, $timestamp_arrive)
    {
        try {
            $stmt = $this->conn->prepare(
                "UPDATE package_info SET recipients = :rpt, ptype=:ptype, storage=:storage,pid=:pid ,timestamp_arrive=:timestamp_arrive WHERE id = :id"
            );

            $stmt->bindparam(":rpt", $rpt);
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":ptype", $ptype);
            $stmt->bindparam(":storage", $storage);
            $stmt->bindparam(":pid", $pid);
            $stmt->bindparam(":timestamp_arrive", $timestamp_arrive);

            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

//    public function sendMAil($username)
//    {
//        try {
//            $stmt = $this->conn->prepare(
//                "UPDATE package_info SET recipients = :rpt, ptype=:ptype, storage=:storage,pid=:pid ,timestamp_arrive=:timestamp_arrive WHERE id = :id"
//            );
//
//            $stmt->bindparam(":rpt", $rpt);
//            $stmt->bindparam(":id", $id);
//            $stmt->bindparam(":ptype", $ptype);
//            $stmt->bindparam(":storage", $storage);
//            $stmt->bindparam(":pid", $pid);
//            $stmt->bindparam(":timestamp_arrive", $timestamp_arrive);
//
//            $stmt->execute();
//
//            if ($stmt->rowCount() == 0) {
//                return false;
//            }
//            return true;
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//    }

    public function delPackage($id)
    {
        try {
            $del = $this->conn->prepare("DELETE FROM package_info WHERE id=:id");
            $del->bindparam(":id", $id);
            $del->execute();
            $del->setFetchMode(PDO::FETCH_ASSOC);
            if ($del->rowCount() == 0) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    public function signPackage($id)
    {
        try {
            $time = date("Y-m-d H:i:s");
            $sign = $this->conn->prepare("UPDATE `package_info` SET is_pick=TRUE,timestamp_pickup='$time' WHERE id=:id");
            $sign->bindparam(":id", $id);
            $sign->execute();
            $sign->setFetchMode(PDO::FETCH_ASSOC);
            if ($sign->rowCount() == 0) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    public function unsignPackage($id)
    {
        try {
            $sign = $this->conn->prepare("UPDATE `package_info` SET is_pick=FALSE,timestamp_pickup=null WHERE id=:id");
            $sign->bindparam(":id", $id);
            $sign->execute();
            $sign->setFetchMode(PDO::FETCH_ASSOC);
            if ($sign->rowCount() == 0) {
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }


    public function doLogin($uid, $upass, $logintype)
    {
        try {
            if ($logintype == 'admin') {
//            print('admin login');
                try {
                    $stmt = $this->conn->prepare("SELECT uid, password, level FROM admin WHERE uid=:uid");
                    $stmt->execute(array(':uid' => $uid));
                    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($stmt->rowCount() == 1) {
                        if (password_verify($upass, $userRow['password'])) {
                            $_SESSION['user_session'] = $userRow['uid'];
                            $_SESSION['level'] = $userRow['level'];
//                        print ('admin login success');

                            return true;
                        } else {
//                        print ("weird");

                            return false;
                        }
                    }
                    //twice try
                    $stmt_nice_try = $this->userconn->prepare("SELECT xoops2_users.name,xoops2_users.uname,xoops2_users.pass,xoops2_groups_users_link.groupid From xoops2_groups_users_link INNER JOIN xoops2_users ON xoops2_users.uid = xoops2_groups_users_link.uid WHERE groupid = 5 AND uname ='changta'");
                    $stmt_nice_try->execute(array(':uid' => $uid));
                    $userRow_retry = $stmt_nice_try->fetch(PDO::FETCH_ASSOC);
                    if ($stmt_nice_try->rowCount() == 1) {
                        if (md5($upass) == $userRow_retry['pass']) {
                            $_SESSION['user_session'] = $userRow_retry['uname'];
                            $_SESSION['level'] = 1;
//                        print ('admin login success');

                            return true;
                        } else {
//                        print ("weird");

                            return false;
                        }
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    var_dump($e);
                }
            } else {
//            print('usr login');
                try {
                    $stmt = $this->userconn->prepare("SELECT name, uname, pass FROM xoops2_users WHERE uname=:uid");
                    $stmt->execute(array(':uid' => $uid));
                    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    //echo $userRow;
                    if ($stmt->rowCount() == 1) {
                        if (md5($upass) == $userRow['pass']) {
                            $_SESSION['level'] = 3;
                            $_SESSION['user_session'] = $userRow['uname'];
                            $_SESSION['username'] = $userRow['name'];

//                        print('user login success');

                            return true;
                        }
                    }
                } catch (PDOException $e) {
//                print('usr login error');
                    echo $e->getMessage();
                    var_dump($e);
                }
            }
        } catch (Exception $ex) {
            print('error');
            echo $ex->getMessage();
        }
    }

    public function is_loggedin()
    {
        if (isset($_SESSION['user_session'])) {
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

//$test = new USER();
//var_dump($test->doLogin('changta', '640715', 'admin'));
//$test->doLogin('403840308', '640715', 'admin');
?>