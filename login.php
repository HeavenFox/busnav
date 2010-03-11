<?php
/*
+-------------------------------------------------------------
|   Bus Navigator
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   USER LOGIN MODULE
|   Module written by HeavenFox
|   Start:    07-04-17
|   Last Mod: 07-05-16
|
+-------------------------------------------------------------
*/

define( 'IN_BUS_NAV', 1 );

//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require_once 'init.php';

require_once CLASS_PATH . 'class_user.php';
require_once CLASS_PATH . 'class_template.php';
require_once CLASS_PATH . 'class_info.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$usrmgr = new usermgr();
$tp     = new template();
$info   = new info();

$tp->load_template('login');

// Looks no additional JS
$tp->replaceTxt('','JavaScript','HeaderWrapper');

//-------------------------------------------
// ACTION
//-------------------------------------------
switch ( $_REQUEST['act'] )
{
	case 'check':
		check();
		break;
	case 'logout':
		logout();
		break;
	default:
		showForm();
}
//-------------------------------------------
// CHECK USER
//-------------------------------------------
function showForm()
{
	global $tp;
	$tp->replaceHF('LoginForm');
	$tp->out('LoginForm');
}

function check()
{
	global $usrmgr,$tp,$info;
	if ( $usrmgr->check_user($_REQUEST['username'],$_REQUEST['password']) )
	{
		// Looks great and wonderful
		$usrmgr->set_cookie($_REQUEST['username'],$_REQUEST['password'],24*30);
		$info->showInfo('登录成功','恭喜您,登录成功');
	}else{
		$info->showError("抱歉, 登陆失败!<br />
请检查:<br />
&nbsp;&nbsp;1. 用户名是否正确?<br />
&nbsp;&nbsp;2. 密码是否正确?<br />
&nbsp;&nbsp;3. 您是否有一个账号? 如果没有,请<a href='register.php'>注册</a>");
	}
}

function logout()
{
	global $info;
	// Destroy Cookie
	setcookie('bus_uid','',0);
	setcookie('bus_uname','',0);
	setcookie('bus_password','',0);
	$info->showInfo('登出成功','恭喜您,登出成功');
}

?>