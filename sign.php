<?php
require_once("session.php");
require_once("User.php");

$auth_user = new USER();

if (isset($_GET['sign']) && isset($_SESSION['level'])) {
    $auth_user->pkgSign($_GET['sign']);
    $auth_user->redirect('student.php');
}

?>