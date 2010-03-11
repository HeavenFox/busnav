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
|   USER LOGIN
|   Module written by HeavenFox
|
+-------------------------------------------------------------
*/
if (!defined('IN_BUS_NAV'))
	die('No Direct Access');


//------------------------------------------------------------

$TPL['Logout'] = <<<EOF
<!-- TVAR:HeaderWrapper -->
<div class='message' style='text-align:center'>
	您已经成功登出
	<div style='margin:10px'>
	<a href='index.php'>[返回首页]</a> <a href='javascript:history.go(-1)'>[返回上一页]</a>
	</div>
</div>
<!-- TVAR:FooterWrapper -->
EOF;

$TPL['LoginForm'] = <<<EOF
<!-- TVAR:HeaderWrapper -->
<form method='post' action='login.php?act=check'>
<table>
<tr>
	<td align='right'>用户名:</td>
	<td><input name='username' size='12' /></td>
</tr>
<tr>
	<td align='right'>密码:</td>
	<td><input type='password' name='password' size='12' /></td>
</tr>
<tr>
	<td align='center' colspan='2'>
		<input type='submit' value='登录' />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='button' value='注册' onclick="window.location.href='register.php'" />
	</td>
</tr>
</table>
</form>
<!-- TVAR:FooterWrapper -->
EOF;

?>