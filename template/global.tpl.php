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
|   GLOBAL ELEMENTS
|   Module written by HeavenFox
|
+-------------------------------------------------------------
*/
if (!defined('IN_BUS_NAV'))
	die('No Direct Access');

$TPL['HeaderWrapper'] = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Bus Navigator</title>
	<!-- Style Sheet -->
	<link rel="stylesheet" type="text/css" href="template/style.css" />
	<!-- Javascript -->
	<script type="text/javascript" src="ajax/ajax.js"></script>
	<script type="text/javascript" src="ajax/meta.js.php"></script>
	<script type="text/javascript" src="ajax/functions.js"></script>
<!-- TVAR:JavaScript -->
</head>
<body>
<div id='container'>
	<div id='header'>
	</div>
	<div id='main'>
EOF;

$TPL['FooterWrapper'] = <<<EOF
	</div>
	<div id='footer'>
	Bus Navigator <!-- TVAR:Version --> by <a href='http://www.msannu.cn'>东北师大附中</a> <a href='http://www.heavenfox.org'>祝靖斯</a>
	</div>
</div>
</body>
</html>
EOF;

?>