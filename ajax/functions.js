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
|   General function library
|   Module written by HeavenFox
|   Start:    07-06-12
|   Last Mod: 07-06-12
|
+-------------------------------------------------------------
*/
//-----------------------------------------------
// LOADING TAG RELATED
//-----------------------------------------------
function showLoadTag()
{
	document.getElementById('loading').style.display = 'block';
}

function hideLoadTag()
{
	document.getElementById('loading').style.display = 'none';
}

//-----------------------------------------------
// INPUT ELEMENT RELATED
//-----------------------------------------------
function disable(id)
{
	document.getElementById(id).disabled = true;
}

function enable(id)
{
	document.getElementById(id).disabled = false;
}

//-----------------------------------------------
// SELECT BOX RELATED
//-----------------------------------------------
function empty(id)
{
	document.getElementById(id).innerHTML = "";
}

function getSelectedText(id)
{
	idx = document.getElementById(id).selectedIndex;
	name = document.getElementById(id).options[idx].innerHTML;
	return name;
}

//-----------------------------------------------
// ARRAY RELATED
//-----------------------------------------------
function array_search(name,arr)
{
	for ( i in arr )
	{
		if ( arr[i] == name )
		{
			return i;
		}
	}
	return false;
}