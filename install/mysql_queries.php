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

$QUERY[] = "CREATE TABLE bus_circuit (
	id INT NOT NULL AUTO_INCREMENT,
	name TEXT,
	type TEXT,
	owner INT DEFAULT 1,
	station LONGTEXT,
	city INT,
	PRIMARY KEY(id)
);";

$QUERY[] = "CREATE TABLE bus_city (
	id INT NOT NULL AUTO_INCREMENT,
	name TEXT,
	province TEXT,
	iscapital TINYINT DEFAULT 0,
	PRIMARY KEY(id)
);";

$QUERY[] = "CREATE TABLE bus_sname (
	id INT NOT NULL,
	name TEXT,
	is_primary TINYINT,
	direction TEXT
);";

$QUERY[] = "CREATE TABLE bus_station (
	id INT NOT NULL AUTO_INCREMENT,
	city INT NOT NULL,
	owner INT NOT NULL,
	lng FLOAT,
	lat FLOAT,
	PRIMARY KEY(id)
);";

$QUERY[] = "CREATE TABLE bus_type (
	id INT NOT NULL AUTO_INCREMENT,
	name TEXT,
	PRIMARY KEY(id)
);";

$QUERY[] = "CREATE TABLE bus_users (
	id INT NOT NULL AUTO_INCREMENT,
	username MEDIUMTEXT,
	password MEDIUMTEXT,
	email MEDIUMTEXT,
	i_credit INT DEFAULT 0,
	i_station INT DEFAULT 0,
	i_circuit INT DEFAULT 0,
	i_alias INT DEFAULT 0,
	PRIMARY KEY(id)
);";

?>