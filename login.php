<?php
session_start();
require_once("User.php");
$login = new USER();

if ($login->is_loggedin() != "") {
    if ($_SESSION['level'] != 3) {
        $login->redirect('index.php');
    } else {
        $login->redirect('student.php');
    }
}

if (isset($_GET['denied'])) {
    if ($_GET['denied'] == true) {
        $error = "Access Denied";
    }
}

if (isset($_POST['admin-login'])) {
    $uid = strip_tags($_POST['uid']);
    $upass = strip_tags($_POST['upw']);
    if ($login->doLogin($uid, $upass, 'admin')) {
        $login->redirect('index.php');
    } else {
        $error = "Wrong Details !";
    }
}
if (isset($_POST['usr-login'])) {
    $uid = strip_tags($_POST['uid']);
    $upass = strip_tags($_POST['upw']);
    if ($login->doLogin($uid, $upass, 'usr')) {
        $login->redirect('index.php');
    } else {
        $error = "Wrong Details !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>學生郵務系統</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <?php
        if (isset($error)) {
            ?>
            <div class="alert alert-danger">
                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
            </div>
            <?php
        }
        ?>
        <div class="card-body">
            <form role="form" method="post">
                <div class="form-group">
                    <label>Student ID</label>
                    <input class="form-control" id="InputId" type="text" aria-describedby="IDHelp"
                           placeholder="Enter Studen ID" name="uid">
                </div>
                <!-- <div class="form-group">
                      <label>Email</label>
                      <input class="form-control" id="InputEmail1" type="text" aria-describedby="emailHelp" placeholder="Email" name="umail">
                </div> -->
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password"
                           name="upw">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Remember Password</label>
                    </div>
                </div>
                <div class="btn-group btn-block">
                    <button type="submit" name="usr-login" class="btn btn-info btn-block">Login</button>
                    <button type="submit" name="admin-login"
                            class="btn btn-info  dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <button type="submit" name="admin-login" class="dropdown-item">Login as Admin</button>
                    </div>
                </div>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="register.php">Register an Account</a>
                <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
