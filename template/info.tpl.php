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
|   INFORMATION
|   Module written by HeavenFox
|
+-------------------------------------------------------------
*/
if (!defined('IN_BUS_NAV'))
	die('No Direct Access');

$TPL['stdError'] = <<<EOF
<!-- TVAR:HeaderWrapper -->
<div class='message'>
	<!-- Tip Image -->
	<div class='tip-image'>
		<img src='template/images/tip/error.png' />
	</div>
	<h1>对不起,发生错误!</h1>
	<!-- TVAR:Content -->
	<div id='msgnav'>
	<a href='index.php'>[返回首页]</a> <a href='javascript:history.go(-1)'>[返回上一页]</a>
	</div>
</div>
<!-- TVAR:FooterWrapper -->
EOF;

$TPL['stdInfo'] = <<<EOF
<!-- TVAR:HeaderWrapper -->
<div class='message'>
	<!-- Tip Image -->
	<div class='tip-image'>
		<img src='template/images/tip/info.png' />
	</div>
	<div>
		<h1><!-- TVAR:Title --></h1>
		<!-- TVAR:Content -->
		<div id='msgnav'>
			<a href='index.php'>[返回首页]</a> <a href='javascript:history.go(-1)'>[返回上一页]</a>
		</div>
	</div>
</div>
<!-- TVAR:FooterWrapper -->
EOF;

?>