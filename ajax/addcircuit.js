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
|   Add Circuit AJAX Library
|   Module written by HeavenFox
|   Start:    07-04-18
|   Last Mod: 07-05-23
|
+-------------------------------------------------------------
*/

/**
 * ac_add_choice
 * Add a choice
 */
function ac_add_choice()
{
	id = document.getElementById("ac_choose_alias").value;
	name = getSelectedText("ac_choose_alias");
	addToList(id,name);
}

/**
 * addToList
 * Add a station to the list to display
 */
function addToList(id,name)
{
	save_place = document.getElementById("pass_station");
	node = document.createElement("li");
	node.setAttribute("id","st_"+id);
	txt = document.createTextNode(name);
	node.appendChild(txt);
	save_place.appendChild(node);
}

/**
 * ac_add_station
 * Add a station to current circuit
 * @since v1.0.0
 * @last  v1.0.0
 */
function ac_add_station()
{
	// Check city
	city = document.getElementById("ac_city_list").value;
	if ( !city )
	{
		alert('请选择一个城市.');
		return;
	}
	// Disable the city select box
	disable("ac_prov_list");
	disable("ac_city_list");
	sn = document.getElementById("new_pass_station").value;
	// Not null?
	if ( sn == "" )
		return;
	document.getElementById("ac_select_name").innerHTML = "Loading...";
	createXML();
	xmlhttp.onreadystatechange = handleAcAddStation;
	request("act=alias&name=" + sn + "&city=" + city);
}

/**
 * handleAcAddStation
 * Handle Add Station for Add Circuit Event
 * @handle ac_add_station
 * @since v1.0.0
 * @last  v1.0.0
 */
function handleAcAddStation()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			txt = xmlhttp.responseText;
			if ( txt == "" )
			{
				document.getElementById("ac_select_name").innerHTML = "";
				addToList("0",document.getElementById("new_pass_station").value);
			}else{
				parseAndDisplay(txt,'ac_select_name','ac_choose_alias');
				btn = document.createElement('input');
				btn.setAttribute("type","button");
				btn.setAttribute("value","添加");
				btn.onclick = function()
				{
					ac_add_choice();
				};
				document.getElementById("ac_select_name").appendChild(btn);
			}
		}
	}
}

/**
 * add_circuit
 * Add current circuit to db
 * @since v1.0.0
 * @last  v2.0.0
 */
function add_circuit()
{
	cn = document.getElementById("ac_c_name").value;
	passed = "";
	slist = document.getElementById("pass_station").childNodes;
	if ( slist.length == 0 )
	{
		// No station?!
		// We should stop this idea
		alert("请至少提供一个站点");
		return;
	}
	showLoadTag();
	for ( i=0;i<slist.length;i++ )
	{
		cid = slist[i].getAttribute("id");
		
		if ( i!=0 )
			passed += ",";
		passed += cid;
		passed += ';';
		passed += slist[i].innerHTML;
	}
	createXML();
	xmlhttp.onreadystatechange = handleAddCircuit;
	request("act=addcircuit&cname=" + cn + "&passed=" + passed + "&city=" + document.getElementById("ac_city_list").value);
	// Enable
	enable('ac_city_list');
	enable('ac_prov_list');
}

/**
 * handleAddCircuit
 * Handle Add Circuit Event
 * @handle add_circuit
 * @since v1.0.0
 * @last  v1.0.0
 */
function handleAddCircuit()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			save_place = document.getElementById("ac_return");
			txt = xmlhttp.responseText;
			if ( txt == "" )
			{
				// It means successful.
				save_place.innerHTML = "<span style='color:green'>添加成功!</span>";
			}else{
				save_place.innerHTML = "<span style='color:red'>添加失败.原因为: " + txt + "</span>";
			}
			hideLoadTag();
		}
	}
}