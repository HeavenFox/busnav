<?php
/*
+-------------------------------------------------------------
|   Bus Navigator Class
|   ===============================
|   by HeavenFox
|   Copyright (c) 2007 ZhuJingsi and MSANNU
|   ===============================
|   www.heavenfox.org
|   heavenfox@heavenfox.org
+-------------------------------------------------------------
|
|   CITY MANAGER CLASS
|   Module written by HeavenFox
|   Start:    07-05-22
|   Last Mod: 07-05-23
|
+-------------------------------------------------------------
*/

class city
{
	// DB Link
	var $db;
	
	/**
	 * @constructor
	 */
	function city()
	{
		// INCLUDE FILES
		require_once CLASS_PATH . 'class_db.php';
		$this->db = new db();
	}
	
	/**
	 * addcity
	 * Add a city into db
	 * @param string  City name
	 * @param string  Province name
	 * @param bool    Is capital
	 * @since v2.0.0
	 * @last  v2.0.0
	 */
	function addcity($city,$province,$iscapital)
	{
		if ( $iscapital )
		{
			$c = 1;
		}else{
			$c = 0;
		}
		$this->db->connDB();
		$this->db->query("INSERT INTO bus_city VALUES (NULL, {$city}, {$province}, {$c});");
	}
	
	/**
	 * listProv
	 * List all provinces
	 * @since v2.0.0
	 * @last  v2.0.0
	 */
	function listProv()
	{
		$this->db->connDB();
		$this->db->query("SELECT province FROM bus_city ORDER BY province;");
		// Province list
		$Plist  = array();
		$Pexist = array();
		while ( $res = $this->db->fetch_array() )
		{
			$n = $res['province'];
			// Make sure every province only display once
			if ( !isset($Pexist[$n]) )
			{
				$Pexist[$n] = true;
				$Plist[] = $n;
			}
		}
		return $Plist;
	}
	
	/**
	 * listCity
	 * List cities in a province
	 * @since v2.0.0
	 * @last  v2.0.0
	 */
	function listCity($prov)
	{
		$this->db->connDB();
		$this->db->query("SELECT id,name,iscapital FROM bus_city WHERE province='{$prov}';");
		$idx = 1;
		$Clist = array();
		while ( $res = $this->db->fetch_array() )
		{
			if ( $res['iscapital'] == 1 )
			{
				$Clist[0][0] = $res['id'];
				$Clist[0][1] = $res['name'];
			}else{
				$Clist[$idx][0] = $res['id'];
				$Clist[$idx][1] = $res['name'];
				$idx++;
			}
		}
		return $Clist;
	}
}
?>