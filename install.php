<?php
/*
+-------------------------------------------------------------
|   Bus Navigator Installer
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   Installer Wrapper
|   Module written by HeavenFox
|   Start:    07-03-20
|   Last Mod: 07-04-20
|
+-------------------------------------------------------------
*/

define( 'IN_BUS_NAV', 1 );

//------------------------------------------------
// INCLUDE FILES
//------------------------------------------------
require_once 'init.php';

require CLASS_PATH . 'class_db.php';
require CLASS_PATH . 'class_template.php';
require ROOT_PATH  . 'install/mysql_queries.php';
// Sample Data
require ROOT_PATH  . 'install/mysql_data_queries.php';

//------------------------------------------------
// INIT CLASSES
//------------------------------------------------
$db = new db();
$tp = new template();

//------------------------------------------------
// START INSTALLING
//------------------------------------------------
// --------- TEMPLATE ---------
$tp->out('HeaderWrapper');

// --------- CONNECT DATABASE ---------
echo 'Connecting Database ...<br />';
$db->connDB();
echo 'Connect Successful.<br />';

// --------- QUERY ---------
echo 'Starting Query...<br />';
// Query count
$c = 0;
foreach ( $QUERY as $Q )
{
	$c++;
	$db->query($Q);
	echo "Query #{$c} Executed Successfully";
	echo '<br />';
}

// --------- DISCONNECT ---------
$db->closeDB();

//------------------------------------------------
// INSTALLATION SUCCESSFUL
//------------------------------------------------
echo 'Installing Successful.';
$tp->out('FooterWrapper');

?>