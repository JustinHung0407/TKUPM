<?php
/**
 * Created by PhpStorm.
 * User: h4090
 * Date: 2017/12/26
 * Time: 下午 04:14
 */

	session_start();

	require_once 'User.php';
	$session = new USER();

	// if user session is not active(not loggedin) this page will help 'home.php and profile.php' to redirect to login page
	// put this file within secured pages that users (users can't access without login)

	if(!$session->is_loggedin())
    {
        // session no set redirects to login page
        $session->redirect('login.php');
    }