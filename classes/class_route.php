<?php
/*
+-------------------------------------------------------------
|   Bus Navigator Class
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   FIND ROUTE CLASS
|   Module written by HeavenFox
|   Start:    07-04-03
|   Last Mod: 07-04-10
|
+-------------------------------------------------------------
*/

class route
{
	// DB Link
	var $db;
	
	// Has solution?
	var $has;
	// Num of solution
	var $num;
	// Num of exchange
	var $dc;
	
	// City
	var $city;
	
	// Nature text strs
	var $nat;
	
	// Weigh
	var $weigh;
	
	/**
	 * @constructor
	 */
	function route()
	{
		// INCLUDE FILES
		require_once CLASS_PATH . 'class_db.php';
		$this->db = new db();
		// SET UP VAR
		$this->weigh = 99999;
	}
	
	/**
 	 * findRoute
 	 * Find route of P1 to P2
 	 * @since v1.0.0
 	 * @last  v2.0.0
 	 */
	function findRoute($P1,$P2,$city)
	{
		// --------- PREPARE DATA ---------
		// No solution
		$this->has = false;
		
		// City
		$this->city = $city;
		
		// Make sure datas are correct
		$P1 = intval($P1);
		$P2 = intval($P2);
		
		// --------- CONNECT DATABASE ---------
		$this->db->connDB();
		
		// --------- DIRECT ---------
		$this->db->query("SELECT id,station FROM bus_circuit WHERE (station LIKE '%{$P1},%{$P2}%' OR station LIKE '%{$P2},%{$P1}%') AND city={$city};");
		
		// Start to find
		while ( $cir = $this->db->fetch_array() )
		{
			// Circuit Name
			$name    = $cir['id'];
			// Convert stations into array
			$station = explode(',', $cir['station']);
			// P1 and P2's index
			$P1_idx  = array_search($P1, $station);
			$P2_idx  = array_search($P2, $station);
			// Weigh
			$wei     = abs($P1_idx - $P2_idx);
			
			// If one is false means not all in this set
			if ( $P1_idx === false || $P2_idx === false )
			{
				// No solution!
				continue;
			}
			
			// Might this is not a best solution
			if ( $wei > $this->weigh )
			{
				continue;
			}
			
			// Better Solution?
			if ( $wei < $this->weigh )
			{
				$this->num = 0;
				unset( $this->dc );
				unset( $this->result );
			}
			
			// So... Has solution
			$this->has  = true;
			$this->num++;
			$i          = $this->num;
			// Save Result
			$this->result[$i][0] = $name;
			$this->result[$i][1] = $P1;
			$this->result[$i][2] = $P2;
			$this->dc[$i]       = 0;
		}
		
		if ( $this->has )
		{
			// CLOSE DATABASE
			$this->db->closeDB();
			return true;
		}
		// --------- NO DIRECT SOLUTION ---------
		$num = 1;
		$CIR1 = array();
		$CIR2 = array();
		// Query station 1
		$this->db->query("SELECT id,station FROM bus_circuit WHERE (station LIKE '{$P1},%' OR station LIKE '%,{$P1},%' OR station LIKE '%,{$P1}') AND city={$city};");
		while ( $c = $this->db->fetch_array() )
		{
			$CIR1[] = $c;
		}
		// Query station 2
		$this->db->query("SELECT id,station FROM bus_circuit WHERE (station LIKE '{$P2},%' OR station LIKE '%,{$P2},%' OR station LIKE '%,{$P2}') AND city={$city};");
		while ( $c = $this->db->fetch_array() )
		{
			$CIR2[] = $c;
		}
		// Convert into array
		for ( $i = 0; $i < count($CIR1); $i++ )
		{
			$CIR1[$i]['station'] = explode(',',$CIR1[$i]['station']);
		}
		for ( $i = 0; $i < count($CIR2); $i++ )
			$CIR2[$i]['station'] = explode(',',$CIR2[$i]['station']);
		// Start Find Route
		for ( $i = 0; $i < count($CIR1); $i++ )
		{
			for ( $j = 0; $j < count($CIR2); $j++ )
			{
				for ( $k = 0; $k < count($CIR1[$i]['station']); $k++ )
				{
					$idx = array_search($CIR1[$i]['station'][$k], $CIR2[$j]['station']);
					$idxA = array_search($P1,$CIR1[$i]['station']);
					$idxB = array_search($P2,$CIR2[$j]['station']);
					if ( $idx !== false )
					{
						// It means,we can take $CIR1[$i]['id'],from $P1,pass $CIR1[$i]['station'][$k],change to $CIR2[$j]['id'],get $P2
						// Check weigh
						$wei = abs( $idxA - $k ) + abs( $idxB - $idx );
						if ( $wei > $this->weigh )
						{
							continue;
						}
						if ( $wei < $this->weigh )
						{
							$num = 1;
							unset( $this->dc );
							unset( $this->result );
						}
						$this->result[$num][0] = $CIR1[$i]['id'];
						$this->result[$num][1] = $CIR2[$j]['id'];
						$this->result[$num][2] = $P1;
						$this->result[$num][3] = $CIR1[$i]['station'][$k];
						$this->result[$num][4] = $P2;
						$this->dc[$num]        = 1;
						$this->has             = true;
						$num++;
					}
				}
			}
		}
		// Solution Num
		$this->num = $num - 1;
		if ( $this->has )
		{
			return true;
		}
		// NO SOLUTION
		return false;
	}
	
	/**
	 * nature
	 * gen nature text result with HTML Formatted
	 * @param string P2's name
	 */
	function nature($P2n)
	{
		$city = $this->city;
		$this->db->connDB();
		for ( $i=1;$i <= $this->num; $i++ )
		{
			if ( $this->dc[$i] == 0 )
			{
				// Vars
				$cid = $this->result[$i][0];
				$id1 = $this->result[$i][1];
				$id2 = $this->result[$i][2];
				
				// Query Circuit's type
				$this->db->query("SELECT name,type FROM bus_circuit WHERE id={$cid} AND city={$city};");
				$res = $this->db->fetch_array();
				$name = $res['name'];
				$type = $res['type'];
				
				// Fetch array
				$res = $this->db->fetch_array();
				
				// Query station name
				// station A
				$this->db->query("SELECT name FROM bus_sname WHERE id={$id1} AND is_primary=1;");
				$res2 = $this->db->fetch_array();
				$sname1 = $res2['name'];
				// station B
				$this->db->query("SELECT name,direction FROM bus_sname WHERE id={$id2} AND is_primary=1;");
				$res2 = $this->db->fetch_array();
				$sname2 = $res2['name'];
				// direction
				$this->db->query("SELECT direction FROM bus_sname WHERE name='{$P2n}';");
				$res2 = $this->db->fetch_array();
				$direc  = $res2['direction'];
				
				// Add return str
				$this->nat[$i] = $this->nat[$i]. 
				"乘坐{$name}{$type}<br />
				从
				{$sname1}
				到
				{$sname2} 下车;
				下车后{$direc}即可到达
				<br />
				";
			}else if( $this->dc[$i] == 1 ){
				// Vars
				$name1 = $this->result[$i][0];
				$name2 = $this->result[$i][1];
				$id1   = $this->result[$i][2];
				$id2   = $this->result[$i][3];
				$id3   = $this->result[$i][4];
				
				// Query Circuit's type
				$this->db->query("SELECT name,type FROM bus_circuit WHERE id={$name1} AND city={$city};");
				// Fetch array
				$res = $this->db->fetch_array();
				$n1 = $res['name'];
				$t1 = $res['type'];
				
				$this->db->query("SELECT name,type FROM bus_circuit WHERE id={$name2} AND city={$city};");
				// Fetch array
				$res = $this->db->fetch_array();
				$n2 = $res['name'];
				$t2 = $res['type'];
				
				// Query station name
				// station A
				$this->db->query("SELECT name FROM bus_sname WHERE id={$id1} AND is_primary=1;");
				$res    = $this->db->fetch_array();
				$sname1 = $res['name'];
				// center station
				$this->db->query("SELECT name FROM bus_sname WHERE id={$id2} AND is_primary=1;");
				$res    = $this->db->fetch_array();
				$sname2 = $res['name'];
				// station B
				$this->db->query("SELECT name FROM bus_sname WHERE id={$id3} AND is_primary=1;");
				$res    = $this->db->fetch_array();
				$sname3 = $res['name'];
				// direction
				$this->db->query("SELECT direction FROM bus_sname WHERE name='{$P2n}';");
				$res    = $this->db->fetch_array();
				$direc  = $res['direction'];
				
				// Add return str
				$this->nat[$i] = $this->nat[$i]. 
				"乘坐{$n1}{$t1}<br />
				从
				{$sname1}
				到
				{$sname2} 下车;<br />换乘{$n2}{$t2}<br />到 {$sname3} 下车<br />
				下车后{$direc}即可到达
				<br />
				";
			}
		}
		$this->db->closeDB();
	}
}

?>