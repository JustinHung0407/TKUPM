<?php
session_start();
require_once('User.php');
$user = new USER();

if ($user->is_loggedin() == "") {
    $user->redirect('login.php');
}
if ($_SESSION['level'] != 1) {
    $user->redirect('login.php?denied=true');
}

if (isset($_POST['btn-signup']) && $_SESSION['level'] == 1) {
    $uid = strip_tags($_POST['uid']);
    $umail = strip_tags($_POST['umail']);
    $upw = strip_tags($_POST['pw']);
    $cpw = strip_tags($_POST['cpw']);
    $level = strip_tags($_POST['level']);

    if ($uid == "") {
        $error[] = "provide username !";
    } else {
        if ($umail == "") {
            $error[] = "provide email id !";
        } else {
            if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
                $error[] = 'Please enter a valid email address !';
            } else {
                if ($upw == "") {
                    $error[] = "provide password !";
                } else {
                    if (strlen($upw) < 6) {
                        $error[] = "Password must be atleast 6 characters";
                    } else {
                        if ($upw != $cpw) {
                            $error[] = "Passwords don't match";
                        } else {
                            try {
                                $stmt = $user->runQuery("SELECT uid, email FROM admin WHERE uid=:uid OR email=:mail");
                                $stmt->execute(array(':uid' => $uid, ':mail' => $umail));
                                //print ($uid);
                                //print ($umail);
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                if ($row['uid'] == $uid) {
                                    $error[] = "sorry id already taken !";
                                } else {
                                    if ($row['email'] == $umail) {
                                        $error[] = "sorry email id already taken !";
                                    } else {
                                        if ($user->register($uid, $umail, $upw, $level)) {
                                            $user->redirect('register.php?joined');
                                        }
                                    }
                                }
                            } catch (PDOException $e) {
                                //echo $e->getMessage();
                                $error[] = $e->getMessage();
                            }
                        }
                    }
                }
            }
        }
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
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
<?php include_once('admin_header.php'); ?>
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                ?>
                <div class="alert alert-danger">
                    &nbsp; <?php echo $error; ?>
                </div>
                <?php
            }
        } else {
            if (isset($_GET['joined'])) {
                ?>
                <div class="alert alert-info">
                    Successfully registered <a href='login.php'>login</a> here
                </div>
                <?php
            }
        }
        ?>
        <div class="card-body">
            <form method="post" class="form-signin">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="id">ID</label>
                            <input class="form-control" id="id" type="text" aria-describedby="nameHelp"
                                   placeholder="Enter Student ID" name="uid"
                                   value="<?php echo isset($_POST['uid']) ? $_POST['uid'] : ''; ?>"
                                   onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                ID contain only numbers
                            </small>
                        </div>
                        <div class="col-md-6">
                            <label for="level">User Level</label>
                            <select class="form-control" id="level"
                                    name="level">
                                <option value="1" <?php if ($_POST['level'] == 1) {
                                    echo 'selected="selected"';
                                } ?> >Admin
                                </option>
                                <option value="0" <?php if ($_POST['level'] == 0) {
                                    echo 'selected="selected"';
                                } ?> >Student
                                </option>
                            </select>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Admin has Super Cow Powers.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input class="form-control" id="email" type="email" aria-describedby="emailHelp"
                           placeholder="Enter email" name="umail"
                           value="<?php echo isset($_POST['umail']) ? $_POST['umail'] : ''; ?>">
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input class="form-control" id="password" type="password"
                                   placeholder="Password" name="pw">
                        </div>
                        <div class="col-md-6">
                            <label for="passwordconf">Confirm password</label>
                            <input class="form-control" id="passwordconf" type="password"
                                   placeholder="Confirm password" name="cpw">
                        </div>
                    </div>
                </div>
                <button type="submit" name="btn-signup" class="btn btn-primary">Register</button>
            </form>
<!--            <div class="text-center">-->
<!--                <a class="d-block small" href="forgot-password.html">Forgot Password?</a>-->
<!--            </div>-->
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
