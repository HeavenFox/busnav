<?php
/*
+-------------------------------------------------------------
|   Bus Navigator Module
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   SIDEBAR MODULE
|   Module written by HeavenFox
|   Start:    07-03-13
|   Last Mod: 07-03-15
|
+-------------------------------------------------------------
*/

// User Login Box & My Zone
if ( $logged_in )
{
	// Replace Welcome Message
	$tp->replaceTxt($_COOKIE['bus_uname'], 'UserName', 'UserLogin_member');
	// Replace My Zone
	$tp->replaceTxt($usrmgr->get_info('circuit',$uid), 'Circuit', 'MyZone_member');
	$tp->replaceTxt($usrmgr->get_info('station',$uid), 'Station', 'MyZone_member');
	$tp->replaceTxt($usrmgr->get_info('alias',$uid), 'Alias', 'MyZone_member');
	$tp->replaceTxt($usrmgr->get_info('credit',$uid), 'Credit', 'MyZone_member');
	
	$tp->replaceTPL('UserLogin_member', 'UserLogin', 'IndexWrapper');
	$tp->replaceTPL('MyZone_member', 'MyZone', 'IndexWrapper');
}else{
	$tp->replaceTPL('UserLogin_guest', 'UserLogin', 'IndexWrapper');
	$tp->replaceTPL('MyZone_guest', 'MyZone', 'IndexWrapper');
}

$db->connDB();
$db->query("SELECT username,i_credit FROM bus_users ORDER BY i_credit DESC LIMIT 0,10;");
$urank = "";
while ( $res = $db->fetch_array() )
{
	$uname  = $res['username'];
	$credit = $res['i_credit'];
	$urank .= "<li>{$uname}({$credit})</li>";
}
$db->closeDB();
$tp->replaceTxt($urank, 'Rank', 'UserRank');
$tp->replace('UserRank', 'IndexWrapper');

?>