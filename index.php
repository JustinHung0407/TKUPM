<?php

require_once("session.php");

$auth_user = new USER();

if (isset($_SESSION['level']) && $_SESSION['level'] == 3) {
    $auth_user->redirect('student.php');
}

if (isset($_POST['add_pkg']) && isset($_SESSION['level']) && $_SESSION['level'] != 3) {
    $rcp = strip_tags($_POST['rcp']);
    $cat = strip_tags($_POST['cat']);
    $strg = strip_tags($_POST['strg']);
    $pid = strip_tags($_POST['pid']);
    $arr_time = strip_tags($_POST['arr_time']);
    $auth_user->addPackage($rcp, $cat, $strg, $pid, $arr_time);
    $auth_user->redirect('index.php?add=success');
}

if (isset($_POST['edit_save']) && isset($_SESSION['level']) && $_SESSION['level'] != 3) {
    $id = strip_tags($_POST['id']);
    $rcp = strip_tags($_POST['rcp']);
    $cat = strip_tags($_POST['cat']);
    $strg = strip_tags($_POST['strg']);
    $pid = strip_tags($_POST['pid']);
    $arr_time = strip_tags($_POST['arr_time']);
    if ($auth_user->editPackage($id, $rcp, $cat, $strg, $pid, $arr_time)) {
        header('Location: index.php?edit=success');
    } else
        header('Location: index.php?edit=fail');
}

$list = $auth_user->runQuery("SELECT * FROM `package_info` WHERE is_pick is FALSE ");
$list->execute();
$list->setFetchMode(PDO::FETCH_ASSOC);


if (isset($_POST['del'])) {
    if ($auth_user->delPackage($_POST['del']))
        header('Location: index.php?del=success');
    else
        header('Location: index.php?del=fail');
}

if (isset($_POST['pick'])) {

    if ($auth_user->signPackage($_POST['pick']))
        header('Location: index.php?pick=success');
    else
        header('Location: index.php?pick=fail');
}

?>
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
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- DateTime Picker-->
    <script src="vendor/laydate/laydate.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<?php include_once('admin_header.php'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">dev@root:~/$ Hello ! This System Has Updated !</h4>
            Operating Button Works Now !
            <br/>
            Several Bug Fixed
            <br/>
            Enjoy :)
            <hr>
            <link class="mb-0">Report any bug or problems go to <link>https://github.com/MingtseChen/TKUPM/issues</link></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php if ((@$_GET['edit'] == 'success' || @$_GET['del'] == 'success' || @$_GET['pick'] == 'success' || @$_GET['add'] == 'success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Operation Success !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } elseif ((@$_GET['edit'] == 'fail' || @$_GET['del'] == 'fail' || @$_GET['pick'] == 'fail')) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Operation Fail !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span>新增包裹</span>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault01">收件人</label>
                            <input type="text" class="form-control" id="validationDefault01" placeholder="收件人" required
                                   name="rcp" autocomplete="off">
                            <div class="invalid-feedback">
                                Invalid
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault02">包裹類型</label>
                            <input type="text" class="form-control" id="validationDefault02" placeholder="包裹類型"
                                   autocomplete="off"
                                   required name="cat">
                            <div class="invalid-feedback">
                                Invalid
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault04">存放位置</label>
                            <input type="text" class="form-control" id="validationDefault04" placeholder="存放位置"
                                   autocomplete="off"
                                   required name="strg">
                            <div class="invalid-feedback">
                                Invalid
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03">包裹編號</label>
                            <input type="text" class="form-control" id="validationDefault03" placeholder="包裹編號"
                                   autocomplete="off"
                                   name="pid">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05">抵達時間</label>
                            <input type="text" class="form-control " id="dtp"
                                   placeholder="抵達時間" autocomplete="off"
                                   required name="arr_time" data-toggle="" data-target="#dtp">
                            <div class="invalid-feedback">
                                Invalid
                            </div>
                            <script>
                                laydate.render({
                                    elem: '#dtp',
                                    type: 'datetime'
                                });

                            </script>
                        </div>
                    </div>

                    <button class="btn btn-success btn-sm" type="submit" name="add_pkg">送出</button>
                </form>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-list" aria-hidden="true"></i>
                <span>包裹列表</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>收件人</th>
                            <th>包裹類型</th>
                            <th>存放位置</th>
                            <th>包裹編號</th>
                            <th>已領取</th>
                            <th>已通知</th>
                            <th>抵達時間</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach ($list->fetchAll() as $item) { ?>
                            <tr>
                                <td><?php echo "$i";
                                    $i++; ?></td>
                                <td><?php echo $item['recipients']; ?></td>
                                <td><?php echo $item['ptype']; ?></td>
                                <td><?php echo $item['storage']; ?></td>
                                <td><?php echo $item['pid']; ?></td>
                                <td><?php echo $item['is_pick'] == 0 ? 'N' : 'Y' ?></td>
                                <td><?php echo $item['is_notify'] == 0 ? 'N' : 'Y' ?></td>
                                <td><?php echo $item['timestamp_arrive']; ?></td>
                                <!--                                <td>-->
                                <?php //echo $item['timestamp_pickup'] == null ? '-' : $item['timestamp_pickup'] ?><!--</td>-->
                                <td>
                                    <form class="form-group" method="post">
                                        <button class="btn btn-info btn-sm" type="button"
                                                data-id="<?php echo $item['id']; ?>"
                                                data-toggle="modal" data-target="#edit"
                                                data-recipients="<?php echo $item['recipients']; ?>"
                                                data-ptype="<?php echo $item['ptype']; ?>"
                                                data-storage="<?php echo $item['storage']; ?>"
                                                data-pid="<?php echo $item['pid']; ?>"
                                                data-timestamp_arrive="<?php echo $item['timestamp_arrive']; ?>"
                                                name="edit">編輯
                                        </button>
                                        <button class="btn btn-success btn-sm" type="submit"
                                                value="<?php echo $item['id']; ?>" name="pick">簽收
                                        </button>
                                        <button class="btn btn-danger btn-sm" type="submit"
                                                value="<?php echo $item['id']; ?>" name="del">刪除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Package Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" autocomplete="off" id="edit_form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01">收件人</label>
                                <input type="text" class="form-control" id="rec" placeholder="收件人"
                                       required
                                       name="rcp">
                                <div class="invalid-feedback">
                                    Invalid
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault02">包裹類型</label>
                                <input type="text" class="form-control" id="ptype" placeholder="包裹類型"
                                       required name="cat">
                                <div class="invalid-feedback">
                                    Invalid
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04">存放位置</label>
                                <input type="text" class="form-control" id="storage" placeholder="存放位置"
                                       required name="strg">
                                <div class="invalid-feedback">
                                    Invalid
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">包裹編號</label>
                                <input type="text" class="form-control" id="pid" placeholder="包裹編號"
                                       name="pid">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05">抵達時間</label>
                                <input type="text" class="form-control timestamp_arrive" id="edit_dtp"
                                       placeholder="抵達時間"
                                       required name="arr_time" data-toggle="" data-target="#edit_dtp">
                                <div class="invalid-feedback">
                                    Invalid
                                </div>
                                <script>
                                    laydate.render({
                                        elem: '#edit_dtp',
                                        type: 'datetime'
                                    });

                                </script>
                            </div>
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-primary" form="edit_form" name="edit_save">Save changes
                    </button>
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
