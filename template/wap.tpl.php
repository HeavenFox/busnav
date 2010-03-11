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
|   STYLE TEMPLATE FILE
|   REGISTER
|   Module written by HeavenFox
|   Start:    07-03-19
|   Last Mod: 07-03-19
|
+-------------------------------------------------------------
*/
if (!defined('IN_BUS_NAV'))
	die('No Direct Access Allowed');

$TPL['Index'] = <<<EOF
<html>
<head>
	<title>城市公交导航</title>
</head>
<body>
<h1 style='text-align:center'>城市公交导航</h1>
<form action='findroute.php' method='post'>
查询公交线路
<select>
<!-- TVAR:Province -->
</select>
<select>
<!-- TVAR:City -->
</select>
从:<input type='text' name='from' /><br />
到:<input type='text' name='to' /><br />
<input type='submit' value='查询' />
</form>
<form action='circuitinfo.php' method='post'>
查询线路信息
<select>
<!-- TVAR:Province -->
</select>
<select name='city'>
<!-- TVAR:City -->
</select>
线路名称:<input type='text' name='circuit' /><br />
<input type='submit' value='查询' />
</form>
</body>
</html>
EOF;

?>