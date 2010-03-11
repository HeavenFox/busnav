<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Bus Navigator</title>
	<!-- Style Sheet -->
	<link rel="stylesheet" type="text/css" href="template/style.css" />
	<link rel="stylesheet" type="text/css" href="template/gears_install.css" />
	<!-- Javascript -->
	<script type="text/javascript" src="gears/gears_init.js"></script>
	<script type="text/javascript" src="gears/install.js"></script>
</head>
<body onload='checkGG()'>
<div id='container'>
	<div id='header'>
	</div>
	<div id='main'>
		<div class="widecontent">
		<h1>离线使用城市公交导航</h1>
		<p>使用该功能,您可以在不联网的情况下使用城市公交导航</p>
			<div id='step1' class='step'>
				<h1>1.安装 Google Gears</h1>
				为了离线使用城市公交导航,您需要安装 Google Gears<br />
				Google Gears 是离线开发 Web 应用程序的工具<br />
				Google Gears 不会对您的机器造成任何影响,同时不会向您收费.<br />
				<a href='http://gears.google.com' onclick='installGG();return false;'>安装 Google Gears</a>
				<div id='step1_finished' class='step_finished'>
					Google Gears 已经成功安装! 您可以继续下一步
				</div>
			</div>
			<div id='step2' class='step'>
				<h1>2.缓存网页文件</h1>
				下一步,您需要缓存网页文件<br />
				缓存的网页文件会存放在您的计算机上,因此您可以在离线时访问<br />
				Google Gears 缓存和浏览器缓存是分开的,这意味着您清空浏览器缓存后,页面仍能离线访问<br />
				<b>注意:您可能会遇到这样的一个对话框</b><br />
				<img src='template/images/gears/install/security_warning.gif' /><br />
				请选择 Allow,允许本站使用 Google Gears,同时建议您勾选"Remember my decision for this site"<br />
				<input type='button' value='缓存数据' onclick='do_step2()' />
				<div id='step2_log' class='info_box'>
				</div>
				<div id='step2_finished' class='step_finished'>
					数据缓存完成!
				</div>
			</div>
			<div id='step3' class='step'>
				<h1>3.初始化数据</h1>
				您需要将您所需要城市的公交线路数据导入到本地<br />
				您只需要导入您所需要城市的数据.当然,日后您可以添加其他城市<br />
				对于大城市,数据可能会很多<br />
				<a href='settings.php' onclick='toStep(4)'>点击这里访问导入页面</a>
			</div>
			<div id='step4' class='step'>
				<h1>4.完成</h1>
				全部完成!您可以享受离线查询线路的乐趣!
			</div>
		</div>
	</div>
	<div id='footer'>
	Bus Navigator Offline Edition by <a href='http://www.msannu.cn'>东北师大附中</a> <a href='http://www.heavenfox.org'>祝靖斯</a>
	</div>
</div>
</body>
</html>