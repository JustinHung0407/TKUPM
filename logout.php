<?php
/**
 * Created by PhpStorm.
 * User: h4090
 * Date: 2017/12/26
 * Time: 下午 04:15
 */
    require_once('session.php');
	require_once('User.php');
	$user_logout = new USER();

	if($user_logout->is_loggedin()!="")
    {
        $user_logout->redirect('index.php');
    }
	if(isset($_GET['logout']) && $_GET['logout']=="true")
    {
        $user_logout->doLogout();
        $user_logout->redirect('login.php');
    }
