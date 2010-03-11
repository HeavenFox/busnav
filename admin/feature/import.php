<?php
/*
+-------------------------------------------------------------
|   Bus Navigator Admin Module
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   ADMIN DATA IMPORT MODULE
|   Module written by HeavenFox
|   Start:    07-05-31
|   Last Mod: 07-05-31
|
+-------------------------------------------------------------
*/
// File URL
$f = 'c:/changchun data.txt';
// Type
$type = '公交';
// City ID
$city = 179;
// Split between circuit & passed station
$s1 = ' ';
$s2 = '→';
$owner = 1;
// ALL DONE
// Have fun!
// OK Now...Main things start

//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require_once '../../init.php';
require_once CLASS_PATH . 'class_db.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$db = new db();

//-------------------------------------------
// READ IN & PREPARE DATA
//-------------------------------------------
$data = file_get_contents($f);
$data = explode("\n",$data);
for ( $i = 0;$i < count($data);$i++ )
{
	// Windows Format
	$data[$i]   = str_replace("\r",'',$data[$i]);
	// $data[$i] will be all circuits
	// Then,explode
	$data[$i]   = explode($s1,$data[$i]);
	$data[$i][1] = explode($s2,$data[$i][1]);
}

// DB Link
$db->connDB();
//------------------------------------------
// INSERT INTO DB
//------------------------------------------
echo 'preparing data...<br />';
echo 'total num of circuit:'.count($data).'<br />';
for ( $i = 0; $i < count($data); $i++ )
{
	echo 'processing circuit ' . $i . '...<br />';
	// data[i] is a circuit's info
	$name = $data[$i][0];
	$pass = '';
	for ( $j = 0; $j < count($data[$i][1]); $j++ )
	{
		$curname = $data[$i][1][$j];
		$db->query("SELECT id FROM bus_sname WHERE name='{$curname}';");
		// Not in the same city?
		// MySQL 4.0 doesn't support subquery
		$res = array();
		// Terrible... `func()[i]` not allowed
		while ( $r = $db->fetch_array() )
		{
			$res[] = $r['id'];
		}
		foreach ( $res as $k=>$v )
		{
			$db->query("SELECT id FROM bus_station WHERE city={$city} AND id={$v};");
			if ( $db->num_rows() == 0 )
			{
				unset($res[$k]);
			}
		}
		// OK.If station exists...
		if ( count($res) )
		{
			$pass .= ',' . $res[0];
		}else{
			// INSERT station
			$db->query("INSERT INTO bus_station VALUES (null,{$city},{$owner},0,0);");
			$db->query("SELECT max(id) FROM bus_station;");
			$r = $db->fetch_array();
			$mid = $r[0];
			$db->query("INSERT INTO bus_sname VALUES ($mid,'$curname',1,'');");
			$pass .= ','.$mid;
		}
	}
	$pass = substr($pass,1);
	$db->query("INSERT INTO bus_circuit VALUES (null,'{$name}','{$type}','{$owner}','{$pass}',{$city});");
	echo 'circuit '.$i.'done.<br />';
}


?>
