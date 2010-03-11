/*
+-------------------------------------------------------------
|   Bus Navigator Javascript
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   Circuit Info AJAX Library
|   Module written by HeavenFox
|   Start:    07-05-25
|   Last Mod: 07-06-14
|
+-------------------------------------------------------------
*/
function get_circuit_info()
{
	if ( document.getElementById("ci_city_list").value == 'nothing' )
	{
		alert("您需要先选择一个城市");
		return;
	}
	document.getElementById('ci_result').style.display = 'block';
	document.getElementById('ci_result_box').innerHTML = '正在查找线路信息';
	createXML();
	xmlhttp.onreadystatechange = handleGetCInfo;
	request('act=getcinfo&circuit=' + document.getElementById("ci_cname").value + '&city=' + document.getElementById("ci_city_list").value);
}

function handleGetCInfo()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			txt = xmlhttp.responseText;
			document.getElementById('ci_result_box').innerHTML = txt;
		}
	}
}

function close_ci_result()
{
	document.getElementById('ci_result').style.display = 'none';
}