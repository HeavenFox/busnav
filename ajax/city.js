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
|   Start:    07-05-17
|   Last Mod: 07-05-28
|
+-------------------------------------------------------------
*/

// Space to save Provinces and Cities
var provBox;
var cityBox;

function getCities(prov_list,city_list)
{
	// Global Vars
	provBox = document.getElementById(prov_list);
	cityBox = document.getElementById(city_list);
	if ( provBox.value == 'nothing' )
	{
		return false;
	}
	showLoadTag();
	empty(city_list);
	// Add Default Option
	node = document.createElement('option');
	node.setAttribute('value','nothing');
	tx   = document.createTextNode("请选择市");
	node.appendChild(tx);
	cityBox.appendChild(node);
	// Query
	createXML();
	xmlhttp.onreadystatechange = handleGetCities;
	request("act=getcity&province=" + getSelectedText(prov_list));
}

function handleGetCities()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			txt = xmlhttp.responseText;
			cities = txt.split(';');
			for( i in cities )
			{
				cities[i] = cities[i].split('&');
				node      = document.createElement("option");
				node.setAttribute('value',cities[i][0]);
				val       = document.createTextNode(cities[i][1]);
				node.appendChild(val);
				cityBox.appendChild(node);
			}
			hideLoadTag();
		}
	}
}