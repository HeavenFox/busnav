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
|   CITY LIST COMMON MODULE
|   Module written by HeavenFox
|   Start:    07-05-23
|   Last Mod: 07-05-23
|
+-------------------------------------------------------------
*/
//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require_once CLASS_PATH . 'class_city.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$city     = new city();

$PL = $city->listProv();
$ls = '';
for ( $i = 0; $i < count($PL); $i++ )
{
	$ls .= '<option>'. $PL[$i]. '</option>';
}

?>