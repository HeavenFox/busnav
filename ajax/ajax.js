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
|   General AJAX Library
|   Module written by HeavenFox
|   Start:    07-03-21
|   Last Mod: 07-04-18
|
+-------------------------------------------------------------
*/
/**
 * Global Variables
 */
var xmlhttp;
var result;

/**
 * createXML
 * Create XML Object
 */
function createXML()
{
	if (window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}else if (window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}else
	{
		alert("Your browser may NOT support AJAX. Please download Firefox.");
	}
	xmlhttp.open("post", "ajax.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
}

function request(req)
{
	// If no XML supported
	if ( !xmlhttp )
		alert("Sorry. XMLHTTPRequest not inited");
	// Any UID?
	if ( uid )
		req = "uid=" + uid + "&" + req;
	xmlhttp.send(req);
}

