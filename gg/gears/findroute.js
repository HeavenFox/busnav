function find_route(P1,P2,P2name,city)
{
	function findRoute()
	{
		// --------- PREPARE DATA ---------
		// No solution
		has = false;
		
		// --------- DIRECT ---------
		var rs = db.execute("SELECT id,station FROM bus_circuit WHERE (station LIKE '%?,%?%' OR station LIKE '%?,%?%') AND city = ?;",[P1,P2,P2,P1,city]);
		
		// Start to find
		while ( rs.isValidRow() )
		{
			// Circuit Name
			name    = rs.field(0);
			// Convert stations into array
			station = rs.field(1).split(',');
			// P1 and P2's index
			P1_idx  = array_search(P1, station);
			P2_idx  = array_search(P2, station);
			// Weigh
			wei     = Math.abs(P1_idx - P2_idx);
			
			// If one is false means not all in this set
			if ( P1_idx === false || P2_idx === false )
			{
				// No solution!
				rs.next();
				continue;
			}
			
			// Might this is not a best solution
			if ( wei > weigh )
			{
				rs.next();
				continue;
			}
			
			// Better Solution?
			if ( wei < weigh )
			{
				num = 0;
			}
			
			// So... Has solution
			has  = true;
			num++;
			i          = num;
			// Save Result
			result[i][0] = name;
			result[i][1] = P1;
			result[i][2] = P2;
			dc[i]       = 0;
			rs.next();
		}
		rs.close();
		
		if ( has )
		{
			nature();
			return;
		}
		// --------- NO DIRECT SOLUTION ---------
		num = 1;
		CIR1 = new array();
		CIR2 = new array();
		// Query station 1
		var rs = db.execute("SELECT id,station FROM bus_circuit WHERE (station LIKE '?,%' OR station LIKE '%,?,%' OR station LIKE '%,?') AND city=?;",[P1,P1,P1,city]);
		
		while ( rs.isVaildRow() )
		{
			CIR1.push([rs.field(0),rs.field(1)]);
			rs.next();
		}
		rs.close();
		// Query station 2
		var rs = db.execute("SELECT id,station FROM bus_circuit WHERE (station LIKE '?,%' OR station LIKE '%,?,%' OR station LIKE '%,?') AND city=?;",[P2,P2,P2,city]);
		while ( c = db->fetch_array() )
		{
			CIR2.push([rs.field(0),rs.field(1)]);
			rs.next();
		}
		rs.close();
		// Convert into array
		for ( i = 0; i < CIR1.length; i++ )
		{
			CIR1[i][1] = CIR1[i][1].split(',');
		}
		for ( i = 0; i < CIR2.length; i++ )
			CIR2[i][1] = CIR2[i][1].split(',');
		// Start Find Route
		for ( i = 0; i < CIR1.length; i++ )
		{
			for ( j = 0; j < CIR2.length; j++ )
			{
				for ( k = 0; k < CIR1[i][1].length); k++ )
				{
					idx = array_search(CIR1[i][1][k], CIR2[j][1]);
					if ( idx !== false )
					{
						// It means,we can take CIR1[i]['id'],from P1,pass CIR1[i]['station'][k],change to CIR2[j]['id'],get P2
						result[num][0] = CIR1[i][0];
						result[num][1] = CIR2[j][0];
						result[num][2] = P1;
						result[num][3] = CIR1[i][1][k];
						result[num][4] = P2;
						dc[num]        = 1;
						has             = true;
						num++;
					}
				}
			}
		}
		// Solution Num
		num = num - 1;
		if ( has )
		{
			nature();
			return;
		}
	}
	function nature()
	{
		for ( i in dc )
		{
			if ( dc[i] == 0 )
			{
			}
			if ( dc[i] == 1 )
			{
			}
		}
	}
}