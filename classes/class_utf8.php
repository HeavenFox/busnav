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
|   UTF-8 STRING TOOKIT CLASS
|   Module written by HeavenFox
|   Start:    07-03-24
|   Last Mod: 07-03-24
|
+-------------------------------------------------------------
*/

class utf8
{
	/**
	 * toUTF8
	 * Convert GB2312 string into UTF-8
	 * @param  string GB2312-encoded string
	 * @return string UTF-8 encoded string
	 * @since  v1.0.0
	 * @last   v1.0.0
	 */
	function toUTF8($txt)
	{
		// Try iconv first
		if ( function_exists('iconv') )
		{
			return iconv( 'GB2312', 'UTF-8', $txt );
		}
		
		// And Multibyte String Functions
		if ( function_exists('mb_convert_encoding') )
		{
			return mb_convert_encoding( $txt, 'UTF-8', 'GB2312');
		}
		
		// Otherwise...
		return false;
	}
	
	/**
	 * msubstr
	 * Cut an UTF-8 Encoded string
	 *
	 * @param string  Text to cut
	 * @param integer Text Start
	 * @param integer Text Length
	 * @return string Substring
	 */
	function msubstr($sstr, $start, $num)
	{
		// String to return
		$return_str = '';
		// Original String Length
		$str_length = strlen($sstr);
		// First, get byte start to cut
		$bstart = 0;
		$tstart = 0;
		for ( $tstart = 0;$tstart < $start;$tstart++ )
		{
			// Get ASCII
			$ascii = ord($sstr[$bstart]);
			if ( $ascii >= 224 )
			{
				$bstart += 3;
			}else if ( $ascii >= 192 ){
				$bstart += 2;
			}else{
				$bstart += 1;
			}
		}
		
		// Now start to cut!
		$cut = 0;
		for ( $cut = 0;$cut < $num;$cut++ )
		{
			// Get ASCII
			$ascii = ord($sstr[$bstart]);
			if ( $ascii >= 224 )
			{
				$return_str = $return_str.substr($sstr, $bstart, 3);
				$bstart += 3;
			}else if ( $ascii >= 192 ){
				$return_str = $return_str.substr($sstr, $bstart, 2);
				$bstart += 2;
			}else{
				$return_str = $return_str.substr($sstr, $bstart, 1);
				$bstart += 1;
			}
		}
		return $return_str;
	}
	
	/**
	 * mstrlen
	 * Return UTF-8 String Length
	 *
	 * @return integer String length
	 */
	 function mstrlen($str)
	 {
		$str_length  = strlen($str);
		$byte        = 0;
		$len         = 0;
		while ( $byte < $str_length )
		{
			$len+=1;
			// Get ASCII
			$ascii = ord($str[$byte]);
			if ( $ascii >= 224 )
			{
				$byte += 3;
			}else if ( $ascii >= 192 ){
				$byte += 2;
			}else{
				$byte += 1;
			}
		}
		return $len;
	}
}
?>