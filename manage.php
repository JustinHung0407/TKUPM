><?php

require_once("session.php");

require_once("User.php");
$auth_user = new USER();

$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=$user_id");
$stmt->execute();

$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Postal System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">包裹管理</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                <a class="nav-link" href="manage.php">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">學生管理</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>新增學生管理者
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control" id="validationDefault01" placeholder="學號" required>
                            <div class="invalid-feedback">
                                Invalid
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control" id="validationDefault02" placeholder="信箱"
                                   required>
                            <div class="invalid-feedback">
                                Invalid
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control" id="validationDefault02" placeholder="密碼"
                                   required>
                            <div class="invalid-feedback">
                                Invalid
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success btn-sm" type="submit">送出</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>學生管理者列表
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>學號</th>
                            <th>姓名</th>
                            <th>信箱</th>
                            <th>加入時間</th>
                            <th>上次登入</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>403840308</td>
                            <td>Test User</td>
                            <td>test@example.com</td>
                            <td>2018/01/01</td>
                            <td>N/A</td>
                            <td>
                                <input class="btn btn-info btn-sm" type="button" value="編輯">
                                <input class="btn btn-danger btn-sm" type="button" value="撤銷">
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>403840**0</td>
                            <td>Test User2</td>
                            <td>tes257wfvt@examplse.com</td>
                            <td>2012/01/01</td>
                            <td>2017/12/30</td>
                            <td>
                                <input class="btn btn-info btn-sm" type="button" value="編輯">
                                <input class="btn btn-danger btn-sm" type="button" value="撤銷">
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © TKUMP 2017</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php?logout=true">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
</div>
</body>

</html>
