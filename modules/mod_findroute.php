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
|   FIND ROUTE MODULE
|   Module written by HeavenFox
|   Start:    07-03-13
|   Last Mod: 07-03-15
|
+-------------------------------------------------------------
*/

$tp->replaceTxt($ls,'FR_ProvList','FindRoute');
// Find Route
$tp->replace('FindRoute','IndexWrapper');
// ...and its result
$tp->replace('FR_result','IndexWrapper');

?>