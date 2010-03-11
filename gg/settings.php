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
|   OFFLINE VERSION SETTINGS FILE
|   Module written by HeavenFox
|   Start:    07-06-16
|   Last Mod: 07-07-15
|
+-------------------------------------------------------------
*/
//-------------------------------------------
// INCLUDE FILES
//-------------------------------------------
require '../init.php';
require_once CLASS_PATH . 'class_city.php';

//-------------------------------------------
// INIT CLASSES
//-------------------------------------------
$city     = new city();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Bus Navigator</title>
	<!-- Style Sheet -->
	<link rel="stylesheet" type="text/css" href="template/style.css" />
	<link rel="stylesheet" type="text/css" href="template/gears_settings.css" />
	<!-- Javascript -->
	<script type="text/javascript" src="gears/gears_init.js"></script>
	<script type="text/javascript" src="gears/settings.js"></script>
	<!-- We should use Ajax tech -->
	<script type="text/javascript">
	var uid = 0;
	</script>
	<script type="text/javascript" src="../ajax/ajax.js"></script>
	<script type="text/javascript" src="../ajax/city.js"></script>
	<script type="text/javascript" src="../ajax/functions.js"></script>
</head>
<body>
<div id='container'>
	<div id='header'>
	</div>
	<div id='main'>
		<div class="widecontent">
		<h1>城市公交导航设置</h1>
		<p>在这里,您可以更新数据或下载新城市</p>
			<div id='add_city_data' class='box'>
				<h1>添加城市数据</h1>
				<select id='acd_prov_list' onchange='getCities("acd_prov_list","acd_city_list");'>
					<option value='nothing'>请选择省</option>
					<?php
					//---------------------------------
					// PROVINCE LIST
					//---------------------------------
					$PL = $city->listProv();
					$ls = '';
					for ( $i = 0; $i < count($PL); $i++ )
					{
						$ls .= '<option>'. $PL[$i]. '</option>';
					}
					echo $ls;
					?>
				</select>
				<select id='acd_city_list'>
					<option value='nothing'>请选择市</option>
				</select>
				<input type='button' value='下载数据' />
			</div>
			<div id='remove_city_data' class='box'>
				<h1>删除城市数据</h1>
				<div id='rmv_city_list'>
				</div>
			</div>
			<div id='update_localdata' class='box'>
				<h1>更新数据</h1>
				在这里,您可以更新您本地缓存的网页文件<br />
				通常情况下,网页文件不会做出大的改动<br />
				我们建议您每个月执行该操作-Beta 期间频率应增加<br />
				<input type='button' value='更新本地数据库' onclick='update_local_data()' />
				<div id='update_localdata_log'>
				</div>
			</div>
			<div id='remove_all' class='box'>
				<h1>删除城市公交导航</h1>
				如果您不再需要离线访问城市公交导航,您可以将我们的数据删除<br />
				该操作将删除所有本地的数据和网页<br />
				如果您日后仍需要城市公交导航,您需要重新下载一切<br />
				<input type='button' value='删除本地数据库' onclick='remove_local_data()' />
			</div>
		</div>
	</div>
	<div id='footer'>
	Bus Navigator Offline Edition by <a href='http://www.msannu.cn'>东北师大附中</a> <a href='http://www.heavenfox.org'>祝靖斯</a>
	</div>
</div>
		<div id='loading'>
		Working...
		</div>
</body>
</html>