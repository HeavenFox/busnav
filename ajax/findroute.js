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
|   Find Route AJAX Library
|   Module written by HeavenFox
|   Start:    07-04-18
|   Last Mod: 07-05-24
|
+-------------------------------------------------------------
*/

/**
 * fr_city
 * Find Route Mod's City Select
 */
var fr_city;

/**
 * found
 * All aliases found?
 */
var found = true;

/**
 * routes
 * Routes found
 */
var routes = new array();

var curRoute = 0;

function getChoice_Route()
{
	fr_city = parseInt(document.getElementById("fr_city_list").value);
	if ( !fr_city )
	{
		alert("您需要先选择一个城市");
		return;
	}
	// Disable to prevent change
	disable("fr_city_list");
	disable("fr_prov_list");
	// Init Header
	document.getElementById("fr_result_head").innerHTML = "别名选择:";
	// Display Return Box
	document.getElementById("fr_result").style.display = "block";
	// Set Loading Tag
	document.getElementById("fr_result_box").innerHTML = "<table><tr><td>对于您输入的名称可能含有歧义或存在拼写相近的站点.<br />为了获得您需要的结果,请您在这里进行选择</td></tr></table>";
	/*node2 = document.createElement("br");
	node3 = document.createTextNode("");*/
	node4 = document.createElement("div");
	node4.setAttribute("id","fr_choice_from");
	node5 = document.createElement("div");
	node5.setAttribute("id","fr_choice_to");
	node4.appendChild(document.createTextNode("正在载入候选..."));
	node5.appendChild(document.createTextNode("正在载入候选..."));
	//document.getElementById("fr_result_box").appendChild(node1);
	//document.getElementById("fr_result_box").appendChild(node2);
	//document.getElementById("fr_result_box").appendChild(node3);
	document.getElementById("fr_result_box").appendChild(node4);
	document.getElementById("fr_result_box").appendChild(node5);
	/*
	document.getElementById("fr_choice_from").innerHTML = "<span style='color:gray'>正在载入候选...</span>";
	document.getElementById("fr_choice_to").innerHTML = "<span style='color:gray'>正在载入候选...</span>";
	*/
	// Add
	fr_btn = document.createElement("input");
	fr_btn.setAttribute("type","button");
	fr_btn.setAttribute("value","查找");
	fr_btn.onclick = function()
	{
		findRoute();
	};
	document.getElementById("fr_result_box").appendChild(fr_btn);
	// Get Choice
	getChoiceFrom();
}

function getChoiceFrom()
{
	createXML();
	xmlhttp.onreadystatechange = handleChoiceFrom;
	request("act=alias&name=" + document.getElementById("fr_from").value + "&city=" + fr_city);
}

function handleChoiceFrom()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			parseAndDisplay(xmlhttp.responseText,"fr_choice_from","choose_from");
			getChoiceTo();
		}
	}
}

function getChoiceTo()
{
	createXML();
	xmlhttp.onreadystatechange = handleChoiceTo;
	request("act=alias&name=" + document.getElementById("fr_to").value + "&city=" + fr_city);
}

function handleChoiceTo()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			parseAndDisplay(xmlhttp.responseText,"fr_choice_to","choose_to");
		}
	}
}

/**
 * parseAndDisplay
 * Parse server response into HTML
 * @since v1.0.0
 * @last  v1.0.0
 */
function parseAndDisplay(txt,save,id)
{
	// Where to save
	save_place = document.getElementById(save);
	
	// Clean 1st
	empty(save);
	
	// Found Station?
	if ( txt == "" )
	{
		save_place.innerHTML = "<p>抱歉,没有找到站点</p>";
		return false;
	}
	
	/*prompt = document.createTextNode("请选择一个别名:");
	save_place.appendChild(prompt);*/
	
	con = txt.split(";");
	// Create select box
	select_box = document.createElement("select");
	select_box.setAttribute("id",id);
	for ( i in con )
	{
		arr = con[i].split("&");
		// DOM Add
		node = document.createElement("option");
		node.setAttribute("value",arr[0]);
		// Text Node
		tx = document.createTextNode(arr[1]);
		node.appendChild(tx);
		select_box.appendChild(node);
		// This is another way.It is more simple,but I'd like to use DOM standard
		// If you'd like to use this method,comment all code above and uncomment next line
		//select_box.options[select_box.options.length] = new Option(arr[1],arr[0]);
	}
	// Add to the place to save
	save_place.appendChild(select_box);
}

function findRoute()
{
	// Check...
	// All data found?
	if ( !document.getElementById("choose_from") || !document.getElementById("choose_to") )
	{
		alert('抱歉,一个或多个地点不存在在数据库中.\n您可以尝试:\n 更换为该地附近的名称查询');
		return false;
	}
	// 
	id1 = parseInt(document.getElementById("choose_from").value);
	id2 = parseInt(document.getElementById("choose_to").value);
	if ( !id1 || !id2 )
	{
		alert("您需要先选择一个名称");
		return false;
	}
	
	// Oops...which one selected?
	name = getSelectedText("choose_to");
	
	// Prepare User Interface
	document.getElementById("fr_result_head").innerHTML = "公交线路:";
	document.getElementById("fr_result_box").innerHTML = "<span style='color:gray'>正在计算线路...</span>";
	
	createXML();
	xmlhttp.onreadystatechange = handleFindRoute;
	request("act=findroute&p1=" + id1 + "&p2=" + id2 + "&p2name=" + name + "&city=" + fr_city);
	// Enable
	enable('fr_city_list');
	enable('fr_prov_list');
}

function handleFindRoute()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			txt = xmlhttp.responseText;
			if ( txt == "" )
			{
				document.getElementById("fr_result_box").innerHTML = "抱歉,没有找到线路";
			}else{
				routes = txt.split("$$$");
				// Save here
				sp = document.getElementById("fr_result_box");
				empty('fr_result_box');
				
				node = document.createElement("div");
				node.setAttribute('id','fr_result_text');
				node.innerHTML = routes[0];
				sp.appendChild(node);
				// Add a linebreak
				node = document.createElement("br");
				sp.appendChild(node);
				
				prev = document.createElement("a");
				prev.setAttribute('href','javascript:prevRoute();');
				prev.innerHTML = "上一条";
				sp.appendChild(prev);
				
				spaces = document.createTextNode('  共' + routes.length + '条  ');
				sp.appendChild(spaces);
				
				next = document.createElement("a");
				next.setAttribute('href','javascript:nextRoute();');
				next.innerHTML = "下一条";
				sp.appendChild(next);
				curRoute = 0;
			}
		}
	}
}

function prevRoute()
{
	curRoute--;
	
	if ( curRoute == -1 )
	{
		curRoute = routes.length - 1;
	}
	
	sp = document.getElementById('fr_result_text');
	sp.innerHTML = routes[curRoute];
}

function nextRoute()
{
	curRoute++;
	
	if ( curRoute == routes.length )
	{
		curRoute = 0;
	}
	sp = document.getElementById('fr_result_text');
	sp.innerHTML = routes[curRoute];
}

/**
 * close_fr_result
 * Close Find Route Box's result
 * @since v1.0.0
 * @last  v1.0.0
 */

function close_fr_result()
{
	// Hide Return Box
	document.getElementById("fr_result").style.display = "none";
	// However,enable the select box
	enable('fr_city_list');
	enable('fr_prov_list');
}