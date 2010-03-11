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
|   POINT MANAGER CLASS
|   Module written by HeavenFox
|   Start:    07-04-17
|   Last Mod: 07-04-17
|
+-------------------------------------------------------------
*/

/**
 * IN_BUS_NAV
 * Not direct access?
 */
define( 'IN_BUS_NAV', 1 );

/**
 * ROOT_PATH
 * Place to save anything
 */
define( 'ROOT_PATH', dirname( __FILE__ ) .'/' );

/**
 * CLASS_PATH
 * Place to save classes
 */
define( 'CLASS_PATH', dirname( __FILE__ ) .'/classes/' );


/**
 * TEMPLATE_PATH
 * Place to save classes
 */
define( 'TEMPLATE_PATH', dirname( __FILE__ ) .'/template/' );

/**
 * MODULE_PATH
 * Place to save classes
 */
define( 'MODULE_PATH', dirname( __FILE__ ) .'/modules/' );

/**
 * VERSION
 * Bus Navigator's Version
 */
define ( 'VERSION', '3.0.0 Alpha');

/**
 * REQUIRE BASIC LIBRARY
 */
require ROOT_PATH . 'lib/function.php';

?>