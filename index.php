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
|   INDEX Wrapper Script
|   Module written by HeavenFox
|   Start:    07-03-13
|   Last Mod: 07-04-05
|
+-------------------------------------------------------------
*/

//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require_once 'init.php';

require_once CLASS_PATH . 'class_template.php';
require_once CLASS_PATH . 'class_user.php';
require_once CLASS_PATH . 'class_db.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$tp     = new template();
$usrmgr = new usermgr();
$db     = new db();

$tp->load_template('index');

//-------------------------------------------
// CHECK USER LOGIN
//-------------------------------------------
$logged_in = false;
$uid = 0;

if ( isset($_COOKIE['bus_uid']) )
{
	if ( $usrmgr->check_cookie($_COOKIE['bus_uname'],$_COOKIE['bus_password']) )
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

//-------------------------------------------
// LOAD MODULES
//-------------------------------------------
require_once MODULE_PATH . 'mod_city.php';
require_once MODULE_PATH . 'mod_findroute.php';
require_once MODULE_PATH . 'mod_addcircuit.php';
require_once MODULE_PATH . 'mod_addalias.php';
require_once MODULE_PATH . 'mod_sidebar.php';
require_once MODULE_PATH . 'mod_circuitinfo.php';

//-------------------------------------------
// OUTPUT INDEX
//-------------------------------------------
// Replace Additional JavaScripts
$tp->replaceTxt("<script type='text/javascript' src='ajax/findroute.js'></script>
<script type='text/javascript' src='ajax/addalias.js'></script>
<script type='text/javascript' src='ajax/addcircuit.js'></script>
<script type='text/javascript' src='ajax/city.js'></script>
<script type='text/javascript' src='ajax/circuitinfo.js'></script>",'JavaScript','HeaderWrapper');
// Replace Version
$tp->replaceTxt(VERSION,'Version','FooterWrapper');
// Add Header
$tp->replaceHF('IndexWrapper');
// Output
$tp->out('IndexWrapper');

?>