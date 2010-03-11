var db;
var localServer;

function checkGG()
{
	// Check Google Gears
	if (!window.google || !google.gears) {
		window.location = 'install.php';
	}
	
	// Check creating db
	db = google.gears.factory.create('beta.database', '1.0');
	
	if ( !db )
	{
		window.location = 'install.php';
	}
	
	// Check webpage local
	localServer = google.gears.factory.create('beta.localserver', '1.0');
	
	loc = window.location.href;
	loc = loc.substring(0,loc.lastIndexOf('/'))+'/index.php';
	
	if ( !localServer.canServeLocally(loc) )
	{
		window.location = 'install.php';
	}
	
	// Check tables installed
	// Open DB
	db.open('bus_nav');
	
	try
	{
		rs = db.execute('SELECT * FROM bus_circuit');
		rs.close();
	}catch (e){
		window.location = 'install.php';
	}
}

// Check!
checkGG();

