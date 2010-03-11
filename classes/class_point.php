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
|   POINT MANAGER CLASS
|   Module written by HeavenFox
|   Start:    07-04-03
|   Last Mod: 07-04-12
|
+-------------------------------------------------------------
*/

class pointmgr
{
	// DB Link & UTF-8 Encode manager
	var $db,$utf8;
	
	// Results
	var $id,$name;
	
	/**
	 * @constructor
	 */
	function pointmgr()
	{
		require_once CLASS_PATH . 'class_db.php';
		require_once CLASS_PATH . 'class_utf8.php';
		$this->db   = new db();
		$this->utf8 = new utf8();
	}
	
	/**
	 * wildcard
	 * Insert wildcard between text
	 * @param  string  Text to insert
	 * @param  string  Charset
	 * @return string  text inserted
	 * @since v1.0.0
	 * @last  v1.0.0
	 */
	
	function wildcard($txt, $charset='GB2312')
	{
		// --------- PROCESS DATA ---------
		// Convert Charset
		if ( $charset == 'GB2312' )
		{
			$txt    = $this->utf8->toUTF8($txt);
		}
		// Add % Between each text
		$UltStr = '%';
		// What's its length?
		$len = $this->utf8->mstrlen($txt);
		// Add
		for ( $i=0;$i < $len ;$i++ )
		{
			$UltStr = $UltStr. $this->utf8->msubstr($txt, $i, 1). '%';
		}
		// Return
		return $UltStr;
	}
	
	/**
	 * ttop
	 * Text-to-point convertor
	 * @param  string  Text to convert
	 * @param  integer Point's city
	 * @since v1.0.0
	 * @last  v1.0.0
	 */
	function ttop($txt,$city)
	{
		unset( $this->id );
		unset( $this->name );
		$txt = $this->wildcard($txt, 'UTF-8');
		// --------- SEARCH POINT ---------
		// Connect database
		$this->db->connDB();
		// Query with 'like'
		$this->db->query("SELECT id,name FROM bus_sname WHERE BINARY name LIKE '{$txt}';");
		
		$fp = fopen('c:\\aa.txt','w');
		
		
		// --------- Get result ---------
		// c: number of matching result(all over the world)
		$c   = 0;
		// num: number of result
		$num = 0;
		// res: matrix to save result from db
		$res = array();
		while ( $r = $this->db->fetch_array() )
		{
			$res[] = $r;
		}
		
		foreach ( $res as $i => $v )
		{
			$id = $v['id'];
			$this->db->query("SELECT id FROM bus_station WHERE id={$id} AND city={$city};");
			if ( $this->db->fetch_array() )
			{
				$this->id[$num]   = $id;
				$this->name[$num] = $v['name'];
				$num++;
			}
		}
		$this->num = $num;
		
	}
}
?>