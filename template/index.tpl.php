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
|   HOMEPAGE
|   Module written by HeavenFox
|
+-------------------------------------------------------------
*/
if (!defined('IN_BUS_NAV'))
	die('No Direct Access Allowed');

$TPL['IndexWrapper'] = <<<EOF
<!-- TVAR:HeaderWrapper -->
		<div id='content'>
			<div id="findroute">
<!-- TVAR:FindRoute -->
			</div>
			<!-- Save Result -->
			<div id="fr_result" style='display:none'>
<!-- TVAR:FR_result -->
			</div>
			<div id='circuitinfo'>
<!-- TVAR:CircuitInfo -->
			</div>
			<div id='ci_result' style='display:none'>
<!-- TVAR:CI_result -->
			</div>
			<div id="addalias">
<!-- TVAR:AddAlias -->
			</div>
			<div id="addcircuit">
<!-- TVAR:AddCircuit -->
			</div>
		</div>
		<!-- Side Bar -->
		<div id='sidebar'>
			<div id='user-login'>
<!-- TVAR:UserLogin -->
			</div>
			<div id='my-zone'>
<!-- TVAR:MyZone -->
			</div>
			<div id='user-rank'>
<!-- TVAR:UserRank -->
			</div>
		</div>
		<!-- Loading Tag -->
		<div id='loading'>
		Working...
		</div>
<!-- TVAR:FooterWrapper -->
EOF;

//--------------------------------------------------------------

$TPL['FindRoute'] = <<<EOF
				<div class='content-head'>
					站站查询:
				</div>
				<div class='content-main'>
					请选择城市:
					<select id='fr_prov_list' onchange="getCities('fr_prov_list','fr_city_list')">
						<option value='nothing'>请选择省</option>
						<!-- TVAR:FR_ProvList -->
					</select>
					<select id='fr_city_list'><option value='nothing'>请选择市</option></select>
					<br />
					从 <input id='fr_from' type='text' name='from' />
					到 <input id='fr_to' type='text' name='to' />
					<br />
					<input type='button' value='查询' onclick='getChoice_Route()' />
				</div>
				<div class='content-foot'>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['FR_result'] = <<<EOF
				<div class='content-head' id='fr_result_head'>
				</div>
				<div class='content-main' id='fr_result_box'>
				</div>
				<div class='content-foot'>
				<a href='javascript: close_fr_result();'>[X]</a>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['CircuitInfo'] = <<<EOF
				<div class='content-head' id='circuitinfo_head'>
					线路信息:
				</div>
				<div class='content-main'>
					请选择城市:<select id='ci_prov_list' onchange='getCities("ci_prov_list","ci_city_list")'>
					<option value='nothing'>请选择省</option>
					<!-- TVAR:CI_ProvList --></select>
					<select id='ci_city_list'>
					<option value='nothing'>请选择市</option>
					</select><br />
					请输入线路:<input id='ci_cname' type='text' name='' /><input type='button' value='查询' onclick='get_circuit_info()' />
				</div>
				<div class='content-foot'>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['CI_result'] = <<<EOF
				<div class='content-head' id='ci_result_head'>
					线路信息:
				</div>
				<div class='content-main' id='ci_result_box'>
				</div>
				<div class='content-foot'>
				<a href='javascript: close_ci_result();'>[X]</a>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['AddAlias'] = <<<EOF
				<div class='content-head'>
					添加别名:
				</div>
				<div class='content-main'>
					请选择城市:<select id='aa_prov_list' onchange='getCities("aa_prov_list","aa_city_list")'>
					<option value='nothing'>请选择省</option>
					<!-- TVAR:AA_ProvList -->
					</select>
					<select id='aa_city_list' onchange='get_city_circuit_list()'>
					<option value='nothing'>请选择市</option>
					</select>
					<br />
					为站点
					<select id='aa_circuit' onchange='updateSNameList()'>
					<option value='nothing'>请选择线路</option>
					</select>
					<select id='aa_station'>
					</select>
					<br />
					添加新的别名: <input id='add_alias_txt' type='text' name='add_alias_txt' onfocus='showDirectionForm()' />
					<div id='directionForm'></div>
					<input type='button' value='提交' onclick='add_alias()' /><span id='add_return'></span>
				</div>
				<div class='content-foot'>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['AddCircuit'] = <<<EOF
				<div class='content-head'>
					添加线路:
				</div>
				<div class='content-main'>
					请选择城市:<select id="ac_prov_list" onchange='getCities("ac_prov_list","ac_city_list")'>
					<option value='nothing'>请选择省</option><!-- TVAR:AC_ProvList --></select>
					<select id='ac_city_list'><option value='nothing'>请选择市</option></select><br />
					线路名 <input id='ac_c_name' type='text' name='ac_c_name' /><br />
					经过站点:
					<ol id='pass_station'>
					</ol>
					添加站点<input id='new_pass_station' type='text' name='new_pass_station' />
					<input type='button' value='查找并添加' onclick='ac_add_station()' /><br />
					<span id='ac_select_name'></span>
					<br />
					<input type='button' value='提交' onclick="add_circuit()" /><span id='ac_return'></span>
				</div>
				<div class='content-foot'>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['UserLogin_guest'] = <<<EOF
				<div class='sb-head'>
					用户登录
				</div>
				<div class='sb-main'>
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
				</div>
				<div class='sb-foot'>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['UserLogin_member'] = <<<EOF
				<div class='sb-head'>
					用户登录
				</div>
				<div class='sb-main'>
					<div align='center'>欢迎您, <!-- TVAR:UserName --></div>
					<div align='center'><a href='login.php?act=logout'>登出</a></div>
				</div>
				<div class='sb-foot'>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['MyZone_guest'] = <<<EOF
				<div class='sb-head'>
					我的空间
				</div>
				<div class='sb-main'>
					<span align='center'>抱歉,请先登录.</span>
				</div>
				<div class='sb-foot'>
				</div>
EOF;

//--------------------------------------------------------------

$TPL['MyZone_member'] = <<<EOF
				<div class='sb-head'>
					我的空间
				</div>
				<div class='sb-main'>
					我的贡献:
					<ul>
						<li><!-- TVAR:Circuit --> 条线路</li>
						<li><!-- TVAR:Station --> 个站点</li>
						<li><!-- TVAR:Alias --> 个别名</li>
						<li><!-- TVAR:Credit --> 点积分</li>
					</ul>
				</div>
				<div class='sb-foot'>
				</div>
EOF;

$TPL['UserRank'] = <<<EOF
				<div class='sb-head'>
					用户排行
				</div>
				<div class='sb-main'>
					积分排行榜:
					<ol>
					<!-- TVAR:Rank -->
					</ol>
				</div>
				<div class='sb-foot'>
				</div>
EOF;

?>