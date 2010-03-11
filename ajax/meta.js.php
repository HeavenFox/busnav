<?php
/*
+-------------------------------------------------------------
|   Bus Navigator Javascript
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   Metadata Javascript
|   Module written by HeavenFox
|   Start:    07-05-04
|   Last Mod: 07-05-15
|
+-------------------------------------------------------------
*/
//-------------------------------------------
// SET UP HEADER
//-------------------------------------------
header('Content-Type: text/javascript');

//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require '../init.php';

require_once CLASS_PATH . 'class_user.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$usermgr = new usermgr();

//-------------------------------------------
// INIT VARS
//-------------------------------------------
$logged_in = false;
$uid = 0;

if ( isset($_COOKIE['bus_uid']) )
{
	if ( $usermgr->check_cookie($_COOKIE['bus_uname'], $_COOKIE['bus_password']) )
	{
		$logged_in = true;
		$uid       = $_COOKIE['bus_uid'];
	}else{
		// Destroy invaild cookie
		setcookie('bus_uid','',0);
		setcookie('bus_uname','',0);
		setcookie('bus_password','',0);
	}
}

?>

var uid = <?php echo $uid; ?>;
