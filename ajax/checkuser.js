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
|   User Check AJAX Library
|   Module written by HeavenFox
|   Start:    07-04-13
|   Last Mod: 07-04-13
|
+-------------------------------------------------------------
*/

var ac = true;

function checkUserName()
{
	document.getElementById("unExists").innerHTML = "<span style='color:gray'>正在检查,请等待...</span>";
	uname = document.getElementById("username").value;
	if ( uname.length < 2 || uname.length > 18 )
	{
		ac = false;
		document.getElementById("unExists").innerHTML = "<img src='template/images/icons/cross.gif' width='13px' height='13px' />";
		return;
	}
	createXML();
	xmlhttp.onreadystatechange = handleUserCheck;
	request("act=checkuname&name=" + uname);
}

function handleUserCheck()
{
	if ( xmlhttp.readyState == 4 )
	{
		if ( xmlhttp.status == 200 )
		{
			ret = xmlhttp.responseText;
			ret = parseInt(ret);
			if ( ret == 1 )
			{
				ac = false;
				document.getElementById("unExists").innerHTML = "<img src='template/images/icons/cross.gif' width='13px' height='13px' />";
			}else{
				document.getElementById("unExists").innerHTML = "<img src='template/images/icons/tick.gif' width='13px' height='13px' />";
			}
		}
	}
}

function checkPassword()
{
	pass  = document.getElementById("password").value;
	pass2 = document.getElementById("cpassword").value;
	if ( pass == pass2 && pass.length > 6 && pass.length < 20 )
	{
		document.getElementById("pMatch").innerHTML = "<img src='template/images/icons/tick.gif' width='13px' height='13px' />";
	}else{
		ac = false;
		document.getElementById("pMatch").innerHTML = "<img src='template/images/icons/cross.gif' width='13px' height='13px' />";
	}
}