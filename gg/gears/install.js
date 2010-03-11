var localServer;
var store;

function toStep(step)
{
	document.getElementById("step"+step).className += ' cur_step';
	if ( step != 1 )
		document.getElementById("step"+(step-1)).className = 'step';
}

function showFinished(step)
{
	document.getElementById("step" + step + "_finished").style.display = 'block';
}
//-------------------------------------------------
function checkGG()
{
	// Check Google Gears
	if ( window.google && google.gears )
	{
		toStep(2);
		showFinished(1);
	}else{
		toStep(1);
	}
	
	// Check webpage local
	localServer = google.gears.factory.create('beta.localserver', '1.0');
	
	loc = window.location.href;
	loc = loc.substring(0,loc.lastIndexOf('/'))+'/index.html';
	
	if ( localServer.canServeLocally(loc) )
	{
		toStep(3);
		showFinished(2);
	}
}

function installGG()
{
	location.href = "http://gears.google.com/?action=install&message=欢迎安装Google Gears!&return=" + window.location.toString();
}

//-------------------------------------------------

function do_step2()
{
	if (!window.google || !google.gears) {
		alert("请安装 Google Gears");
		return;
	}
	store = localServer.createManagedStore("bus_nav_offline");
	document.getElementById("step2_log").style.display = "block";
	document.getElementById("step2_log").innerHTML += "成功建立本地数据库<br />";
	
	store.manifestUrl = "gears/manifest.json";
	document.getElementById("step2_log").innerHTML += "正在下载数据库...<br />";
	store.checkForUpdate();
	
	var timerId = window.setInterval(function() {
		if (store.currentVersion) {
			window.clearInterval(timerId);
			document.getElementById("step2_log").innerHTML += "数据库下载完毕! 版本:" + store.currentVersion;
			showFinished(2);
			toStep(3);
		} else if (store.updateStatus == 3) {
			document.getElementById("step2_log").innerHTML += "发生错误! 错误代码:" + store.lastErrorMessage;
		}
  	}, 500);
}

