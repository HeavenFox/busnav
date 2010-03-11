<?php
/*
+-------------------------------------------------------------
|   Bus Navigator Installer
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi and MSANNU
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   QUERY LIST FILE
|   Module written by HeavenFox
|   Start:    07-03-14
|   Last Mod: 07-03-15
|
+-------------------------------------------------------------
*/
// Make script safe
if (!defined('IN_BUS_NAV'))
	die('No Direct Access');

$QUERY[] = "INSERT INTO bus_users VALUES ( 1,'HeavenFox','4e453e4a79e8b3fdb0e56f034d19ac4c','heavenfox@heavenfox.org',1,1,1,1);";
//------------------------------------------------------------
/*
$QUERY[] = "INSERT INTO bus_station VALUES ( 1,1,1,13.225945,22.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 2,1,1,14.225945,21.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 3,1,1,15.225945,20.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 4,1,1,16.225945,28.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 5,1,1,17.225945,27.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 6,1,1,18.225945,65.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 7,1,1,19.225945,68.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 8,1,1,10.225945,75.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 9,1,1,11.225945,25.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 10,1,1,12.225945,58.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 11,1,1,22.225945,35.254644 );";
$QUERY[] = "INSERT INTO bus_station VALUES ( 12,1,1,25.225945,82.254644 );";
*/
//------------------------------------------------------------
/*
$QUERY[] = "INSERT INTO bus_sname VALUES ( 1,'东北师大附中',0,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 1,'高速公路客运站',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 1,'高速公路入口',0,'');";

$QUERY[] = "INSERT INTO bus_sname VALUES ( 2,'人民广场',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 3,'长春市电力局',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 4,'长春市政府',1,'');";

$QUERY[] = "INSERT INTO bus_sname VALUES ( 5,'新发广场',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 5,'吉林省政府',0,'');";

$QUERY[] = "INSERT INTO bus_sname VALUES ( 6,'东北师大附小',1,'');";

$QUERY[] = "INSERT INTO bus_sname VALUES ( 7,'工农广场',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 7,'省科协',0,'');";

$QUERY[] = "INSERT INTO bus_sname VALUES ( 8,'名门大酒店',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 9,'卓展',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 10,'中海水岸春城',0,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 10,'欧亚商都',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 11,'东北师范大学',1,'');";
$QUERY[] = "INSERT INTO bus_sname VALUES ( 12,'艺术学院',1,'');";
*/
//------------------------------------------------------------
$QUERY[] = "INSERT INTO bus_city VALUES ( 1,'长春市','吉林省',1 );";
//------------------------------------------------------------
/*
$QUERY[] = "INSERT INTO bus_circuit VALUES ( NULL,'6','公交','路',1,'5,7',1 );";
$QUERY[] = "INSERT INTO bus_circuit VALUES ( NULL,'306','公交','路',1,'5,7,9',1 );";
$QUERY[] = "INSERT INTO bus_circuit VALUES ( NULL,'123','公交','路',1,'1,2,3,7,9',1 );";
$QUERY[] = "INSERT INTO bus_circuit VALUES ( NULL,'155','公交','路',1,'2,5,9',1 );";
$QUERY[] = "INSERT INTO bus_circuit VALUES ( NULL,'176','公交','路',1,'2,3,9',1 );";
*/

?>