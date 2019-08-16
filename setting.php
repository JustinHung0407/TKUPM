<?php

require_once("session.php");
require_once("User.php");
$auth_user = new USER();

$stmt = $auth_user->runQuery("SELECT * FROM `package_info` WHERE recipients=:recipients AND is_pick = FALSE");
$stmt->execute(array(':recipients' => $_SESSION['username']));
$users = $stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


?>
<!doctype html>
<html lang="en">

<head>
    <title>學生郵務系統</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="student.php">學生郵務系統</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"><?php echo 'Hi, ' . $_SESSION['username'] ?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="setting.php">Setting</a>
                            <a class="dropdown-item" href="logout.php?logout=true">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="student.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Setting</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            Setting
        </div>
        <div class="card-body">
            <!--            <h5 class="card-title">You've got a new package !</h5>-->
            <form autocomplete="off" method="GET">
                <fieldset disabled>
                    <div class="form-group">
                        <label for="disabledTextInput">Name</label>
                        <input type="text" id="disabledTextInput" class="form-control"
                               value="<?php echo $_SESSION['username'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledTextInput">Student ID #</label>
                        <input type="text" id="disabledTextInput" class="form-control"
                               value="<?php echo $_SESSION['user_session'] ?>" disabled>
                    </div>
                </fieldset>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email"
                           placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input type="text" class="form-control" name="phone"
                           placeholder="Phone Number">
                </div>
                <input type="hidden" value="<?php echo $_SESSION['user_session']; ?>" name="sid">
                <button type="submit" class="btn btn-info">Save</button>
            </form>
        </div>
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                BLAH BLAH BLAH
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Confirm</button>
            </div>
        </div>
    </div>
</div>
<footer class="sticky-footer" style="width: 100% !important;">
    <div class="container">
        <div class="text-center">
            <small>Copyright © CHENMT 2017-2018</small>
            <small>Proudly Presented by TKU IIT</small>
        </div>
    </div>
</footer>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>