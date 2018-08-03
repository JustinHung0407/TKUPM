<?php

require_once("session.php");

require_once("User.php");
$auth_user = new USER();

$stmt = $auth_user->runQuery("SELECT `uid`,`email`,`level` FROM `admin`");
$users = $stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


//var_dump($userRow);
if ($_SESSION['level'] == 3) {
    $auth_user->redirect('student.php');
}
if ($_SESSION['level'] != 1) {
    $auth_user->redirect('index.php');
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
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php include_once('admin_header.php'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-list" aria-hidden="true"></i>
                <span>管理者列表</span>
                <a href="register.php" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Add User</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>學號</th>
                            <th>信箱</th>
                            <th>加入時間</th>
                            <th>上次登入</th>
                            <th>Level</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach ($stmt->fetchAll() as $item) { ?>
                            <tr>
                                <td><?php echo "$i";
                                    $i++; ?></td>
                                <td><?php echo $item['uid']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td><?php if ($item['level'] == 1) {
                                        echo 'Admin';
                                    } else {
                                        echo 'Student';
                                    } ?></td>
                                <td>
                                    <input class="btn btn-info btn-sm" type="button" value="編輯">
                                    <input class="btn btn-danger btn-sm" type="button" value="撤銷">
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include_once("footer.php") ?>
</div>
</body>

</html>
