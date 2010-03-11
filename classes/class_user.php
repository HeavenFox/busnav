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
|   USER MANAGER CLASS
|   Module written by HeavenFox
|   Start:    07-03-17
|   Last Mod: 07-04-17
|
+-------------------------------------------------------------
*/

class usermgr
{
	var $db;
	var $flag;
	
	/**
	 * @constructor
	 */
	function usermgr()
	{
		require_once CLASS_PATH . 'class_db.php';
		$this->db = new db();
	}
	
	/* 
	 * add_user
	 * Add a user
	 *
	 * @param string Username
	 * @param string Password
	 * @param string E-mail
	 *
	 * @since v1.0.0
	 * @last  v1.0.0
	 */
	function add_user( $username, $password, $email )
	{
		$password = md5($password);
		
		// INSERT INTO DATABASE
		// Connect
		$this->db->connDB();
		// Query
		$this->db->query("INSERT INTO bus_users VALUES ( NULL, '{$username}', '{$password}', '{$email}', 0, 0, 0, 0 );");
		// Close
		$this->db->closeDB();
	}
	
	/**
	 * check_user
	 * Check username and password
	 *
	 * @param string Username
	 * @param string Password
	 * @since v1.0.0
	 * @last  v1.0.0
	 */
	function check_user( $username, $password )
	{
		$flag     = false;
		$password = md5($password);
		
		$this->db->connDB();
		$this->db->query("SELECT id FROM bus_users WHERE username='{$username}' AND password='{$password}';");
		
		if ( $this->db->fetch_array() )
		{
			$flag = true;
		}else{
			$flag = false;
		}
		$this->db->closeDB();
		return $flag;
	}
	
	/**
	 * check_cookie
	 * Check username and MD5ed password
	 *
	 * @param string Username
	 * @param string Password
	 * @since v1.5.0
	 * @last  v1.5.0
	 */
	function check_cookie( $username, $password )
	{
		$flag     = false;
		
		$this->db->connDB();
		$this->db->query("SELECT id FROM bus_users WHERE username='{$username}' AND password='{$password}';");
		
		if ( $this->db->fetch_array() )
		{
			$flag = true;
		}else{
			$flag = false;
		}
		$this->db->closeDB();
		return $flag;
	}
	
	/**
	 * set_cookie
	 * Set a cookie for a member
	 * @param string  Username
	 * @param string  Password
	 * @param integer Cookie life (in hour)
	 */
	function set_cookie( $username, $password, $life )
	{
		$life = intval($life);
		setcookie( 'bus_uid', $this->get_uid($username), time()+$life*60*60 );
		setcookie( 'bus_uname', $username, time()+$life*60*60 );
		setcookie( 'bus_password', md5($password), time()+$life*60*60 );
	}
	
	/**
	 * uname_exist
	 * Check is a username exists
	 * @param  string username
	 * @return bool   username exist or not
	 * @since  v1.0.0
	 * @last   v1.0.0
	 */
	function uname_exist($username)
	{
		$flag = false;
		// --------- CONNECT DATABASE ---------
		$this->db->connDB();
		// --------- QUERY ---------
		$this->db->query("SELECT id FROM bus_users WHERE username='{$username}';");
		// --------- CHECK ---------
		if ( $this->db->fetch_array() )
		{
			$flag = true;
		}
		// --------- CLOSE DATABASE
		$this->db->closeDB();
		// --------- RETURN ---------
		return $flag;
	}
	
	/**
	 * get_info
	 * Get user info
	 */
	function get_info($info,$uid)
	{
		// --------- CONNECT DB ---------
		$this->db->connDB();
		// --------- PROCESS DATA ---------
		$basic = array('username','password','email');
		$uid  = intval($uid);
		if ( !in_array($info,$basic) )
			$info = 'i_'.$info;
		// --------- QUERY ---------
		$this->db->query("SELECT {$info} FROM bus_users WHERE id={$uid};");
		$res = $this->db->fetch_array();
		$rtn = intval($res[0]);
		// --------- CLOSE DB ---------
		$this->db->closeDB();
		return $rtn;
	}
	
	/**
	 * get_uid
	 * Get User ID
	 */
	function get_uid($uname)
	{
		// --------- CONNECT DB ---------
		$this->db->connDB();
		// --------- QUERY ---------
		$this->db->query("SELECT id FROM bus_users WHERE username='{$uname}';");
		$res = $this->db->fetch_array();
		$rtn = $res[0];
		// --------- CLOSE DB ---------
		$this->db->closeDB();
		return $rtn;
	}
	
	function add_credit($info,$amount,$uid)
	{
		// --------- CONNECT DB ---------
		$this->db->connDB();
		// --------- PROCESS DATA ---------
		$uid    = intval($uid);
		$amount = intval($amount);
		$basic  = array('username','password','email');
		if ( !in_array($info, $basic) )
			$info = 'i_'. $info;
		$this->db->query("UPDATE bus_users SET {$info}={$info}+{$amount} WHERE id={$uid};");
		// --------- CLOSE DB ---------
		$this->db->closeDB();
		$this->refresh_credit($uid);
	}
	
	/**
	 * refresh_uid
	 * Refresh user's credit
	 * @param integer User ID
	 * @since v2.0.0
	 * @last  v2.0.0
	 */
	function refresh_credit($uid)
	{
		// --------- PROCESS DATA ---------
		$uid    = intval($uid);
		// --------- CONNECT DB ---------
		$this->db->connDB();
		$this->db->query("UPDATE bus_users SET i_credit = i_circuit * 5 + i_station * 2 + i_alias WHERE id={$uid};");
		$this->db->closeDB();
	}
}
?>