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
|   INFORMATION DISPLAY CLASS
|   Module written by HeavenFox
|   Start:    07-03-19
|   Last Mod: 07-05-16
|
+-------------------------------------------------------------
*/

class info
{
	var $tp;
	
	/**
	 * @constructor
	 */
	function info()
	{
		// INCLUDE FILE
		require_once CLASS_PATH . 'class_template.php';
		
		// INIT TEMPLATE
		$this->tp = new template();
	}
	
	function showError($msg, $end = true)
	{
		// LOAD TEMPLATE
		$this->tp->load_template('info');
		
		// REPLACE HEADER
		$this->tp->replaceHF('stdError');
		
		// REPLACE ERROR MESSAGE
		$this->tp->replaceTxt($msg, 'Content', 'stdError');
		
		// OUTPUT TEMPLATE
		$this->tp->out('stdError');
		
		// END EXECUTE
		if ( $end )
			die();
	}
	
	function showInfo( $title, $msg, $end = true )
	{
		// LOAD TEMPLATE
		$this->tp->load_template('info');
		
		// REPLACE HEADER
		$this->tp->replaceHF('stdInfo');
		
		// REPLACE TITLE & MESSAGE
		$this->tp->replaceTxt($title, 'Title', 'stdInfo');
		$this->tp->replaceTxt($msg, 'Content', 'stdInfo');
		
		// OUTPUT TEMPLATE
		$this->tp->out('stdInfo');
		
		// END EXECUTE
		if ( $end )
			die();
	}
}
?>