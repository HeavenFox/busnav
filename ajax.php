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
|   Ajax Module
|   Module written by HeavenFox
|   Start:    07-03-20
|   Last Mod: 07-05-28
|
+-------------------------------------------------------------
*/

define( 'IN_BUS_NAV', 1 );

//---------------------------------------------
// SETUP HEADER
//---------------------------------------------
//header('Content-Type: text/xml');

//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require_once 'init.php';

require_once CLASS_PATH . 'class_db.php';
require_once CLASS_PATH . 'class_utf8.php';
require_once CLASS_PATH . 'class_route.php';
require_once CLASS_PATH . 'class_point.php';
require_once CLASS_PATH . 'class_user.php';
require_once CLASS_PATH . 'class_city.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$db    = new db();
$utf8  = new utf8();
$route = new route();
$point = new pointmgr();
$user  = new usermgr();
$city  = new city();

//---------------------------------------------
// SELECT ACTION TO DO
//---------------------------------------------
/*
  Actions List

  checkuname    Check username
  addpoint      Add a point to database
  alias         Translate point name to id
  findroute     Find route from a to b
  snamelist     List of station in circuit
  addalias      Add an alias
  masteralias   Master Alias
  addcircuit    Add a circuit
  getinfo       Get a station's info
  */
switch ( GET_INC('act') )
{
	case 'checkuname':
		checkUserName();
		break;
	case 'addpoint':
		addPoint();
		break;
	case 'alias':
		getAlias();
		break;
	case 'findroute':
		findRoute();
		break;
	case 'snamelist':
		snameList();
		break;
	case 'addalias':
		addAlias();
		break;
	case 'masteralias':
		masterAlias();
		break;
	case 'addcircuit':
		addCircuit();
		break;
	case 'getcity':
		getCity();
		break;
	case 'citycircuit':
		getCityCircuit();
		break;
	case 'getcinfo':
		getCircuitInfo();
		break;
}

/**
 * checkUserName
 * Check is a username exists
 * @since v1.0.0
 * @last  v1.0.0
 */
function checkUserName()
{
	// --------- GLOBALIZE ---------
	global $user,$utf8;
	// --------- CHECK ---------
	$name = $utf8->toUTF8(GET_INC('name'));
	if ( $user->uname_exist($name) )
	{
		echo 1;
	}else{
		echo 0;
	}
}

/**
 * getAlias
 * Get alias for a point
 * @since v1.0.0
 * @last  v1.0.0
 */
function getAlias()
{
	// --------- GLOBALIZE ---------
	global $point;
	
	// --------- CONVERT TO INT ---------
	$city = intval(GET_INC('city'));
	
	// --------- LOOK FOR ---------
	$point->ttop(GET_INC('name'),$city);

	// ------- OUTPUT RESULT -------
	for ( $i=0; $i < $point->num; $i++ )
	{
		echo $point->id[$i];
		echo '&';
		echo $point->name[$i];
		if ( $i != $point->num-1 )
			echo ';';
	}
}

/**
 * findRoute
 * Get route between two points
 * @since v1.0.0
 * @last  v1.0.0
 */
function findRoute()
{
	// --------- GLOBALIZE ---------
	global $route;
	// ------ CONVERT TO INTEGER ------
	$P1   = intval(GET_INC('p1'));
	$P2   = intval(GET_INC('p2'));
	$P2n  = GET_INC('p2name');
	$city = GET_INC('city');
	// ------- FIND ROUTE -------
	$route->findRoute($P1,$P2,$city);
	$route->nature($P2n);
	// ------- OUTPUT RESULT -------
	for ( $i=1;$i<=$route->num;$i++ )
	{
		// Split with Dollar Sign
		if ( $i != 1 )
			echo '$$$';
		echo $route->nat[$i];
	}
}

/**
 * snameList
 * Get stations in a circuit
 * @since v1.0.0
 * @last  v1.0.0
 */
function snameList()
{
	// --------- GLOBALIZE ---------
	global $db;
	// --------- CONVERT TO INT ---------
	$id = intval(GET_INC('id'));
	// --------- GET LIST ---------
	$db->connDB();
	$db->query("SELECT station FROM bus_circuit WHERE id={$id};");
	$res = $db->fetch_array();
	$res = explode(',',$res['station']);
	// first write?
	$fw = true;
	foreach ( $res as $v )
	{
		if ( !$fw )
		{
			echo ';';
		}else{
			$fw = false;
		}
		echo $v;
		echo '&';
		$db->free();
		$db->query("SELECT name FROM bus_sname WHERE id={$v} AND is_primary=1;");
		$r = $db->fetch_array();
		echo $r['name'];
	}
	$db->closeDB();
}

/**
 * addAlias
 * Add an alias for a station
 * @since v1.0.0
 * @last  v1.0.0
 */
function addAlias()
{
	// --------- GLOBALIZE ---------
	global $db,$user;
	// --------- CHECK ---------
	if ( !GET_INC('uid') )
	{
		echo '请先登录';
		return;
	}
	// --------- CONVERT TO INT ---------
	$id   = intval(GET_INC('id'));
	$name = GET_INC('name');
	$dire = GET_INC('direction');
	$uid  = intval(GET_INC('uid'));
	// --------- INSERT ---------
	$db->connDB();
	$db->query("INSERT INTO bus_sname VALUES ({$id},'{$name}',0,'{$dire}');");
	$db->closeDB();
	// --------- ADD CREDIT ---------
	$user->add_credit('alias',1,$uid);
}

/**
 * masterAlias
 * Get primary alias
 * @since v1.0.0
 * @last  v1.0.0
 * @discontinued
 */
function masterAlias()
{
	// --------- GLOBALIZE ---------
	global $db;
	// --------- CONVERT TO INT ---------
	$id   = intval(GET_INC('id'));
	// --------- INSERT ---------
	$db->connDB();
	$db->query("SELECT name FROM bus_sname WHERE id={$id} AND is_primary=1;");
	$res = $db->fetch_array();
	echo $res['name'];
	$db->closeDB();
}

/**
 * addCircuit
 * Add a circuit
 * @since v1.0.0
 * @last  v1.0.0
 */
function addCircuit()
{
	// --------- GLOBALIZE ---------
	global $db,$user;
	// ------ CONVERT TO SHORT FORM ------
	$cname = GET_INC('cname');
	$pass  = GET_INC('passed');
	$city  = intval(GET_INC('city'));
	// --------- CHECK ---------
	if ( !GET_INC('uid') )
	{
		echo '请先登录';
		return;
	}
	// ------- CONNECT DB -------
	$db->connDB();
	// ------- PROCESS DATA -------
	$pass = str_replace('st_', '', $pass);
	$pas  = explode(',',$pass);
	$uid  = intval(GET_INC('uid'));
	$list = '';
	// station credit
	$sc   = 0;
	foreach ( $pas as $k=>$v )
	{
		// Explode
		$pas[$k] = explode(';',$pas[$k]);
		if ( $pas[$k][0] == 0 )
		{
			// No this station
			// Insert
			$db->query("INSERT INTO bus_station VALUES (NULL,{$city},{$uid},0,0);");
			// Get ID
			$db->query("SELECT max(id) FROM bus_station;");
			$res = $db->fetch_array();
			$cid = $res[0];
			// ID avaliable!
			$pas[$k][0]  = $cid;
			// What is its name
			$name        = $pas[$k][1];
			// Great. So insert the 1st sname
			// And...it is the primary
			$db->query("INSERT INTO bus_sname VALUES ({$cid},'{$name}',1,'');");
			// Add credit
			$sc++;
		}
		if ( $k!=0 )
			$list .= ',';
		$list .= $pas[$k][0];
	}
	// --------- INSERT ---------
	$db->query("INSERT INTO bus_circuit VALUES (NULL,'{$cname}','公交',{$uid},'{$list}',{$city});");
	// --------- DISCONNECT ---------
	$db->closeDB();
	// --------- ADD CREDIT ---------
	$user->add_credit('circuit',1,$uid);
	$user->add_credit('station',$sc,$uid);
}

/**
 * addPoint
 * Add a Point into DB
 * @since v1.0.0
 * @last  v1.0.0
 * @discontinued
 */
function addPoint()
{
	// --------- GLOBALIZE ---------
	global $db;
	// The 1st alias
	$name  = GET_INC('name');
	// City? Lng? Lat?
	$city  = GET_INC('city');
	$lng   = GET_INC('lng');
	$lat   = GET_INC('lat');
	// We need user ID
	$uid   = GET_INC('uid');
	// Query?
	// Looks simple...
	$db->connDB();
	// insert into db
	$db->insert('bus_station', "NULL,{$city},{$lng},{$lat}");
	// get ID
	$db->query('SELECT MAX(id) FROM bus_station;');
	$res = $db->fetch_array();
	// insert 1st alias
	$db->insert('bus_sname', "{$res[0]},{$name}");
	// close db
	$db->closeDB();
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

/**
 * getCityCircuit
 * Get city's circuit
 * @since v2.0.0
 * @last  v2.0.0
 */
function getCityCircuit()
{
	global $db;
	$city = intval(GET_INC('city'));
	$db->connDB();
	$db->query("SELECT id,name FROM bus_circuit WHERE city={$city};");
	$fw = true;
	while ( $res = $db->fetch_array() )
	{
		if ( $fw )
		{
			$fw = false;
		}else{
			echo '&';
		}
		echo $res['id'];
		echo ',';
		echo $res['name'];
	}
	$db->closeDB();
}

function getCircuitInfo()
{
	global $db;
	$cir  = GET_INC('circuit');
	$city = GET_INC('city');
	$db->connDB();
	$db->query("SELECT name,type,station FROM bus_circuit WHERE name LIKE BINARY '{$cir}%' AND city={$city};");
	// Only one result is vaild!
	$res = $db->fetch_array();
	if ( !$res )
	{
		echo '对不起,找不到线路.';
		return false;
	}
	$passed = explode(',',$res['station']);
	$slist = "";
	foreach ( $passed as $key => $value )
	{
		echo "SELECT name FROM bus_sname WHERE id={$value} AND is_primary=1;<br />";
		$db->query("SELECT name FROM bus_sname WHERE id={$value} AND is_primary=1;");
		$res2 = $db->fetch_array();
		$slist .= '<li>'. $res2['name']. '</li>';
	}
	echo "{$res['name']}的线路信息:<br />
		类型:{$res['type']}<br />
		线路:<ol>{$slist}</ol>";
	$db->closeDB();
}

?>