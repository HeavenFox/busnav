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
|
+-------------------------------------------------------------
*/
if (!defined('IN_BUS_NAV'))
	die('No Direct Access Allowed');

$TPL['RegStep1'] = <<<EOF
<!-- TVAR:HeaderWrapper -->
<div class="widecontent">
<div style='float:left;'>
<h1>注册一个账号</h1>
<p>有了自己的账号,您可以添加别名和线路,参与积分排名</p>
<form method="post" action="register.php?act=adduser">
<table>
<tr>
	<td>用户名:</td>
	<td>
		<input id='username' type='text' name="username" onblur='checkUserName()' />
		<span id='unExists'></span>
	</td>
<tr>
	<td>密码:</td>
	<td>
		<input id='password' type="password" name="password" />
	</td>
</tr>
<tr>
	<td>确认密码:</td>
	<td>
		<input id='cpassword' type="password" name="cpassword" onblur='checkPassword()' />
		<span id='pMatch'></span>
	</td>
</tr>
<tr>
	<td>Email:</td>
	<td>
	<input type='text' name="email" />
	</td>
</tr>
<tr>
	<td colspan='2'>
	<input type="submit" name="submit" value="注册" />
	</td>
</tr>
</table>
</form>
</div>
<div style='float:right; margin:40px 20px 20px 20px'>
<img src='template/images/tip/createaccount.png' />
</div>
</div>
<!-- TVAR:FooterWrapper -->
EOF;

?>