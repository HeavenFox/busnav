<?php
/*
+-------------------------------------------------------------
|   Bus Navigator
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi and MSANNU
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   REGISTER MODULE
|   Module written by HeavenFox
|   Start:    07-03-19
|   Last Mod: 07-05-16
|
+-------------------------------------------------------------
*/

define('IN_BUS_NAV', 1);

//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require_once 'init.php';

require_once CLASS_PATH . 'class_template.php';
require_once CLASS_PATH . 'class_user.php';
require_once CLASS_PATH . 'class_info.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$tp     = new template();
$usrmgr = new usermgr();
$info   = new info();

$tp->load_template('register');

//-------------------------------------------
// EXECUTE ACTION
//-------------------------------------------
switch ( GET_INC('act') )
{
	case 'adduser':
		addUser();
	default:
		showForm();
}

function showForm()
{
	global $tp;
	// Replace Header and Footer
	$tp->replaceTxt("<script type='text/javascript' src='ajax/checkuser.js'></script>", 'JavaScript', 'HeaderWrapper');
	$tp->replaceHF('RegStep1');
	// Print it out
	$tp->out('RegStep1');
}

function addUser()
{
	global $tp,$usrmgr,$info;
	
	$username = GET_INC('username');
	$password = GET_INC('password');
	$confirm  = GET_INC('cpassword');
	$email    = GET_INC('email');
	
	//-------------------------------
	// CHECK INPUT DATA
	//-------------------------------
	// Username exists?
	if ( $usrmgr->uname_exist( $username ) )
	{
		$info->showError('对不起,用户名存在');
	}
	
	// Password not match?
	if ( $confirm != $password )
	{
		$info->showError('对不起,密码不匹配');
	}
	
	// Username too short or too long?
	if ( strlen( $username ) < 2 || strlen( $username ) > 18 )
	{
		$info->showError('对不起,用户名长度必须在 2 到 18 字节之间');
	}
	
	// Password too short or too long?
	if ( strlen( $password ) < 6 || strlen( $password ) > 20 )
	{
		$info->showError('对不起,密码长度必须在 6 到 20 字节之间');
	}
	
	// Email not provided?
	if ( !$email )
	{
		$info->showError('对不起,您必须提供 Email 地址');
	}
	
	// Not an email address?
	if ( !(strstr($email, '@') && strstr($email, '.') && eregi("^([_a-z0-9]+([\._a-z0-9-]+)*)@([a-z0-9]{2,}(\.[a-z0-9-]{2,})*\.[a-z]{2,3})$", $email)) ){ 
		$info->showError('对不起,Email 地址不合法');
	}
	
	// Otherwise,add user
	$usrmgr->add_user( GET_INC('username'), GET_INC('password'), GET_INC('email') );
	
	$info->showInfo('十分感谢', '感谢.您已经成功注册!');
}
?>