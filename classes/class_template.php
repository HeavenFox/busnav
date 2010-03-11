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
|   TEMPLATE CLASS
|   Module written by HeavenFox
|   Start:    07-03-19
|   Last Mod: 07-05-04
|
+-------------------------------------------------------------
*/

class template {
	var $tmpl;
	
	function template()
	{
		// Autoload Global Template
		$this->load_template('global');
	}
	
	/**
	 * load_template
	 * Load a template file
	 *
	 * @param string Template filename
	 * @since v1.0.0
	 * @last  v1.0.0
	 */
	function load_template($tname)
	{
		// INCLUDE TEMPLATE
		require TEMPLATE_PATH . $tname . '.tpl.php';
		// READ IN TEMPLATE
		foreach ( $TPL as $key => $value )
		{
			$this->tmpl[$key] = $value;
		}
	}
	
	/**
	 * replace
	 * Replace template inner with another template
	 *
	 * @param string Template Name to replace
	 * @param string Template Name to replace in
	 * @since v1.0.0
	 * @last  v1.5.0
	 */
	function replace($tvar, $tname)
	{
		$this->tmpl[$tname] = str_replace( "<!-- TVAR:{$tvar} -->", $this->tmpl[$tvar], $this->tmpl[$tname] );
	}
	
	/**
	 * replaceTPL
	 * Replace template's var with another template
	 * @since v1.0.0
	 * @last  v1.5.0
	 */
	function replaceTPL($txt, $tvar, $tname)
	{
		$this->tmpl[$tname] = str_replace( "<!-- TVAR:{$tvar} -->", $this->tmpl[$txt], $this->tmpl[$tname] );
	}
	
	
	/**
	 * replaceTxt
	 * Replace variables in template
	 *
	 * @param string String to replace
	 * @param string Variable to be replaced
	 * @param string Template name to replace in
	 * @since v1.0.0
	 * @last  v1.5.0
	 */
	function replaceTxt($txt, $v, $tname)
	{
		$this->tmpl[$tname] = str_replace( "<!-- TVAR:{$v} -->", $txt, $this->tmpl[$tname] );
	}
	
	/**
	 * out
	 * Output a template
	 * @param string Template Name
	 * @since v1.0.0
	 * @last  v1.0.0
	 */
	function out($tname)
	{
		echo $this->tmpl[$tname];
	}
	
	/**
	 * replaceHF
	 * Replace Template Header and Footer
	 * @param string Template Name
	 * @since v1.0.0
	 * @last  v1.5.0
	 */
	function replaceHF($tname)
	{
		$this->replace( 'HeaderWrapper', $tname );
		$this->replace( 'FooterWrapper', $tname );
	}
}

?>