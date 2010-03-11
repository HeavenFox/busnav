<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Bus Navigator</title>
	<!-- Style Sheet -->
	<link rel="stylesheet" type="text/css" href="template/style.css" />
	<!-- Javascript -->
	<script type="text/javascript" src="gears/gears_init.js"></script>
	<script type="text/javascript" src="gears/gears.js"></script>
</head>
<body>
<div id='container'>
	<div id='header'>
	</div>
	<div id='main'>
		<div id='content'>
			<div id="findroute">
				<div class='content-head'>
					站站查询:
				</div>
				<div class='content-main'>
					请选择城市:
					<select id='fr_prov_list' onchange="getCities('fr_prov_list','fr_city_list')">
						<option value='nothing'>请选择省</option>
						<option>吉林省</option>
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
			</div>
			<!-- Save Result -->
			<div id="fr_result" style='display:none'>
				<div class='content-head' id='fr_result_head'>
				</div>
				<div class='content-main' id='fr_result_box'>
				</div>
				<div class='content-foot'>
				<a href='javascript: close_fr_result();'>[X]</a>
				</div>
			</div>
			<div id='circuitinfo'>
				<div class='content-head' id='circuitinfo_head'>
					线路信息:
				</div>
				<div class='content-main'>
					请选择城市:<select id='ci_prov_list' onchange='getCities("ci_prov_list","ci_city_list")'>
					<option value='nothing'>请选择省</option>
					<option>吉林省</option></select>
					<select id='ci_city_list'>
					<option value='nothing'>请选择市</option>
					</select><br />
					请输入线路:<input id='ci_cname' type='text' name='' /><input type='button' value='查询' onclick='get_circuit_info()' />
				</div>
				<div class='content-foot'>
				</div>
			</div>
			<div id='ci_result' style='display:none'>
				<div class='content-head' id='ci_result_head'>
					线路信息:
				</div>
				<div class='content-main' id='ci_result_box'>
				</div>
				<div class='content-foot'>
				<a href='javascript: close_ci_result();'>[X]</a>
				</div>
			</div>
		</div>
		<!-- Side Bar -->
		<div id='sidebar'>
			<div id='user-login'>
				<div class='sb-head'>
					欢迎使用
				</div>
				<div class='sb-main'>
					<div style='text-align:center'>
						欢迎使用城市公交导航!<br /><br />
						<a href='../'>[切换到在线]</a>
						<a href='settings.html'>[设置]</a>
					</div>
				</div>
				<div class='sb-foot'>
				</div>
			</div>
		</div>
		<!-- Loading Tag -->
		<div id='loading'>
		Working...
		</div>
	</div>
	<div id='footer'>
	Bus Navigator Offline Edition by <a href='http://www.msannu.cn'>东北师大附中</a> <a href='http://www.heavenfox.org'>祝靖斯</a>
	</div>
</div>
</body>
</html>