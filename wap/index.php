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
require_once '../init.php';

require_once CLASS_PATH . 'class_template.php';
require_once CLASS_PATH . 'class_db.php';
require_once CLASS_PATH . 'class_city.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$tp     = new template();
$db     = new db();
$city   = new city();

$tp->load_template('wap');

//-------------------------------------------
// SET PROVINCE MODULE
//-------------------------------------------
$PL = $city->listProv();
$PLHtml = '<option>请选择省</option>';
if ( $province = GET_INC('province') )
{
	// Province selected
	foreach ( $PL as $P )
	{
		$PLHtml .= '<option'. ( $P == $province ? ' selected' : '' ). '>' . $P . '</option>';
	}
}else{
	foreach ( $PL as $P )
	{
		$PLHtml .= '<option>' . $P . '</option>';
	}
}

//-------------------------------------------
// SET CITY MODULE
//-------------------------------------------
$CTHtml = '';
if ( $province )
{
	// Province selected
	$CT = $city->listCity($province);
	foreach ( $CT as $C )
	{
		$CTHtml .= '<option>' . $C . '</option>';
	}
}else{
	$CTHtml = '<option>请选择市</option>';
}

//--------------------------------------------
// REPLACE TEMPLATE
//--------------------------------------------
$tp->replaceTxt($PLHtml,'Province','Index');
$tp->replaceTxt($CTHtml,'City','Index');

$tp->out('Index');
?>