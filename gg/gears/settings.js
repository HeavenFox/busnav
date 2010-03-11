var localServer;
var store;

function checkGG()
{
	// Check Google Gears
	if (!window.google || !google.gears) {
		window.location = 'install.html';
	}
}

function init()
{
	localServer = google.gears.factory.create('beta.localserver', '1.0');
}

checkGG();
init();





function update_local_data()
{
	store = localServer.openManagedStore("bus_nav_offline");
	document.getElementById("update_localdata_log").innerHTML += "成功建立本地数据库<br />";
	
	store.manifestUrl = "gears/manifest.json";
	document.getElementById("update_localdata_log").innerHTML += "正在下载数据库...<br />";
	store.checkForUpdate();
	
	var timerId = window.setInterval(function() {
		if (store.currentVersion) {
			window.clearInterval(timerId);
			document.getElementById("update_localdata_log").innerHTML += "数据库下载完毕! 版本:" + store.currentVersion;
		} else if (store.updateStatus == 3) {
			document.getElementById("update_localdata_log").innerHTML += "发生错误! 错误代码:" + store.lastErrorMessage;
		}
  	}, 500);
}