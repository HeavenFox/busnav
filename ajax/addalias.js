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
|   Add Alias AJAX Library
|   Module written by HeavenFox
|   Start:    07-04-18
|   Last Mod: 07-05-28
|
+-------------------------------------------------------------
*/
var input_method = 'select';
function get_city_circuit_list()
{
	if ( document.getElementById("aa_prov_list").value == 'nothing' || document.getElementById("aa_city_list").value == 'nothing' )
	{
		return false;
	}
	showLoadTag();
	empty("aa_circuit");
	node = document.createElement('option');
	node.setAttribute('value','nothing');
	text = document.createTextNode('请选择线路');
	node.appendChild(text);
	document.getElementById("aa_circuit").appendChild(node);
	createXML();
	xmlhttp.onreadystatechange = handleGetCircuitList;
	request("act=citycircuit&city=" + document.getElementById("aa_city_list").value);
}

function handleGetCircuitList()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			save_place = document.getElementById("aa_circuit");
			txt = xmlhttp.responseText;
			if ( txt == "" )
			{
				// Nothing...
				alert("目前本站没有该市数据.\n如果您是该市居民,为什么不在下面添加一个呢?");
				hideLoadTag();
				return;
			}
			txt = txt.split("&");
			for ( i in txt )
			{
				arr = txt[i].split(",");
				node = document.createElement('option');
				node.setAttribute('value',arr[0]);
				text = document.createTextNode(arr[1]);
				node.appendChild(text);
				save_place.appendChild(node);
			}
			hideLoadTag();
		}
	}
}

function updateSNameList()
{
	if ( document.getElementById("aa_circuit").value != 'nothing' )
	{
		showLoadTag();
		createXML();
		xmlhttp.onreadystatechange = handleUpdSNL;
		request("act=snamelist&id="+document.getElementById("aa_circuit").value);
	}else{
		empty("aa_station");
		empty("directionForm");
	}
}

function handleUpdSNL()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			save_place = document.getElementById("aa_station");
			// Clear
			save_place.innerHTML = "";
			txt = xmlhttp.responseText;
			slist = txt.split(";");
			for ( i=0;i<slist.length;i++ )
			{
				// Split 1st
				slist[i]=slist[i].split("&");
				// Create element
				node = document.createElement("option");
				node.setAttribute("value",slist[i][0]);
				// Create text
				txtNode = document.createTextNode(slist[i][1]);
				node.appendChild(txtNode);
				save_place.appendChild(node);
			}
			hideLoadTag();
		}
	}
}

function add_alias()
{
	showLoadTag();
	createXML();
	xmlhttp.onreadystatechange = handleAddAlias;
	if ( input_method == 'select' )
	{
		request("act=addalias&id=" + document.getElementById("aa_station").value + "&name=" + document.getElementById("add_alias_txt").value + "&direction=" + document.getElementById("aa_direction").value);
	}else{
		request("act=addalias&id=" + document.getElementById("aa_gbi_station").value + "&name=" + document.getElementById("add_alias_txt").value + "&direction=" + document.getElementById("aa_direction").value);
	}
}

function handleAddAlias()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			save_place = document.getElementById("add_return");
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

function showDirectionForm()
{
	if ( input_method == 'select' )
	{
		if ( document.getElementById("aa_circuit").value == 'nothing' )
		{
			return false;
		}
		save_place = document.getElementById("directionForm");
		txt = getSelectedText("aa_station");
	}else{
		save_place = document.getElementById("directionForm");
		txt = getSelectedText("aa_gbi_station");
	}
	save_place.innerHTML = "从" + txt + "到达该站点应该怎样走?<br /><input id='aa_direction' type='text' name='aa_direction' />";
}

function toggleInput()
{
	if ( input_method == 'select' )
	{
		document.getElementById('aa_get_station_by_select').style.display = 'none';
		document.getElementById('aa_get_station_by_input').style.display = 'block';
		input_method = 'input';
	}else{
		document.getElementById('aa_get_station_by_input').style.display = 'none';
		document.getElementById('aa_get_station_by_select').style.display = 'block';
		input_method = 'select';
	}
}

function gbi_search()
{
	// Check city
	city = document.getElementById("aa_city_list").value;
	if ( !city )
	{
		alert('请选择一个城市.');
		return;
	}
	sn = document.getElementById("aa_gbi_name").value;
	// Not null?
	if ( sn == "" )
		return;
	document.getElementById("aa_result").innerHTML = "Loading...";
	createXML();
	xmlhttp.onreadystatechange = handleGbiSearch;
	request("act=alias&name=" + sn + "&city=" + city);
}

function handleGbiSearch()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			txt = xmlhttp.responseText;
			parseAndDisplay(txt,'aa_result','aa_gbi_station');
		}
	}
}