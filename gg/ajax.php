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
|   OFFLINE VERSION SERVER-SIDE FILE
|   Module written by HeavenFox
|   Start:    07-06-16
|   Last Mod: 07-06-16
|
+-------------------------------------------------------------
*/

//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require '../init.php';

require CLASS_PATH . 'class_db.php';
require CLASS_PATH . 'class_city.php';

$db = new db();
$city = new city();

switch ( GET_INC('act') )
{
	case 'getcity':
		getCity();
	case 'getcircuit':
		getCircuit();
	case 'getstation':
		getStation();
	case 'getalias':
		getAlias();
}


/**
 * getCity
 * Get Province's city list
 * @since v2.0.0
 * @last  v2.0.0
 */
function getCity()
{
	// --------- GLOBALIZE ---------
	global $city;
	$prov = GET_INC('province');
	$cl = $city->listCity($prov);
	// All list related functions contains this var
	// Any ideas?
	$fw = true;
	for ( $i = 0; $i < count($cl); $i++ )
	{
		if ( !$fw )
			echo ';';
		else
			$fw = false;
		echo $cl[$i][0];
		echo '&';
		echo $cl[$i][1];
	}
}

function getCircuit()
{
	global $db;
	$city = intval(GET_INC('city'));
	
	$db->connDB();
	$db->query("SELECT * FROM bus_circuit WHERE city={$city};");
	$fw = true;
	while ( $res = $db->fetch_array() )
	{
		$id    = $res['id'];
		$name  = $res['name'];
		$type  = $res['type'];
		$pass  = $res['station'];
		if ( $fw )
		{
			echo "{$id}&{$name}&{$type}&{$pass}";
			$fw = false;
		}else{
			echo ";{$id}&{$name}&{$type}&{$pass}";
		}
	}
}

function getStation()
{
	global $db;
	$city = intval(GET_INC('city'));
	// First...Get station
	$db->connDB();
	// In fact,bus_station is the most simple table...
	$db->query("SELECT id FROM bus_station WHERE city={$city};");
	$res = array();
	$fw = true;
	while ( $res = $db->fetch_array() )
	{
		if ( $fw )
		{
			$fw = false;
			echo $res['id'];
		}else{
			echo ','.$res['id'];
		}
	}
}

function getAlias()
{
	
}

?>