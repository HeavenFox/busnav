<?php
/*
+-------------------------------------------------------------
|   Bus Navigator Library
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   Function Library
|   Module written by HeavenFox
|   Start:    07-05-12
|   Last Mod: 07-05-12
|
+-------------------------------------------------------------
*/

/**
 * GET_INC
 * Get a incoming var and add slashes
 * @since v1.5.0
 * @last  v1.5.0
 */
function GET_INC($var)
{
	if ( !isset($_REQUEST[$var]) )
		return false;
	// MAGIC QUOTES
	// Well,they are really magic...
	if ( !get_magic_quotes_gpc() )
	{
		return addslashes($_REQUEST[$var]);
	}else{
		return $_REQUEST[$var];
	}
}

?>