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
|   DATABASE CLASS
|   Module written by HeavenFox
|   Start:    07-03-15
|   Last Mod: 07-05-28
|
+-------------------------------------------------------------
*/

class db {
	
	// Config
	var $CFG;
	// Connection Link
	var $connection;
	// Connected?
	var $connected;
	// Result Pointer
	var $result;
	// Query cache
	var $c;
	//-----------------------------------
	// CONSTRUCTOR
	//-----------------------------------
	function db()
	{
		// INCLUDE FILES
		require ROOT_PATH . 'config.php';
		
		// SETUP VARS
		foreach ( $CONFIG as $key => $value )
		{
			$this->CFG[$key] = $value;
		}
		
		$this->connected = false;
	}
	
	//-----------------------------------
	// DATABASE BASIC FUNCTIONS
	//-----------------------------------
	/*
	 * function   connDB
	 * Connect MySQL Database
	 * @Since v1.0.0
	 * @Last  v1.5.0
	 */
	function connDB()
	{
		if ( !$this->connected )
		{
			$this->connection = @mysql_connect($this->CFG['server'], $this->CFG['user'], $this->CFG['pass']) or die('<b>Fatal Error:</b> Could not connect database');
			@mysql_select_db($this->CFG['db'], $this->connection) or die('<b>Fatal Error:</b> Could not find DB');
			if ( mysql_error() )
			{
				die( mysql_error() );
			}
			$this->connected = true;
		}
	}
	
	/**
	 * query
	 * Query Database
	 * @since v1.0.0
	 * @last  v1.5.0
	 */
	function query( $q )
	{
		$this->result = mysql_query( $q, $this->connection );
		// Anything unwanted happens?
		if ( mysql_error() )
		{
			die( mysql_error() );
		}
	}
	
	/**
	 * fetch_array
	 * Get database result by MySQL Fetch Array
	 * @since v1.0.0
	 * @last  v1.0.0
	 */
	function fetch_array()
	{
		return mysql_fetch_array( $this->result );
	}
	
	/**
	 * num_rows
	 * Get result's row num by MySQL Num Row
	 * @since v2.0.0
	 * @last  v2.0.0
	 */
	function num_rows()
	{
		return mysql_num_rows( $this->result );
	}
	
	/**
	 * free
	 * Free MySQL Result
	 */
	function free()
	{
		@mysql_free_result( $this->result );
	}
	
	/**
	 * closeDB
	 * Close Database
	 * @since v1.0.0
	 * @last  v1.0.0
	 */
	function closeDB()
	{
		@mysql_free_result( $this->result );
		@mysql_close( $this->connection );
		$this->connected = false;
	}
	
	//-----------------------------------
	// CACHED QUERY
	//-----------------------------------
	/**
	 * cache
	 * Add a query into queries cache
	 * @since v1.5.0
	 * @last  v1.5.0
	 */
	function cache($q)
	{
		$this->c[] = $q;
	}
	
	/**
	 * execute
	 * Execute all cached queries
	 */
	function execute()
	{
		foreach( $this->c as $q )
		{
			mysql_query($q, $this->connection);
		}
	}
	
	/**
	 * purge
	 * Remove all cached queries
	 */
	function purge()
	{
		unset($this->c);
	}
}

?>