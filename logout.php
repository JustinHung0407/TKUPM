<?php
require_once('session.php');
require_once('User.php');
$user_logout = new USER();

if ($user_logout->is_loggedin() != "") {
    $user_logout->redirect('index.php');
}
if (isset($_GET['logout']) && $_GET['logout'] == "true") {
    $user_logout->doLogout();
    $user_logout->redirect('login.php');
}
?>
