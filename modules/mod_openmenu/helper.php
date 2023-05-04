<?php
/**
* @version		$Id: helper.php 14401 2011-01-10 14:10:00Z chris $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2017 OpenMenu. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

if(!function_exists('_get_menu_details')) {

	function _get_menu_details ( $omf_url ) {
		// ------------------------------------- 
		//  Return the menu details from an OMF URL
		// ------------------------------------- 

		$omf_details = false;
		if ( !empty($omf_url) ) {
			include_once dirname(__FILE__).'/toolbox/class-omf-reader.php'; 
			$omfr = new cOmfReader; 
			$omf_details = $omfr->read_file($omf_url.'?ref=joomla'); 
			unset($omfr);
		}
		
		return $omf_details;
	}
	
}

if(!function_exists('build_menu_from_details')) {
	function build_menu_from_details ($omf_details, $columns = '1', $menu_filter = '', $group_filter = '', 
					$background_color = false, $split_on = false, 
					$show_allergy = true, $show_calories = true, $use_short_tag = false, $hide_prices = false) {
		// ------------------------------------- 
		//  Create a menu display from OMF Details 
		// ------------------------------------- 
		
		$retval = '';
		$one_column = ($columns == '1') ? true : false ;
		
		if ( $background_color ) {
			$retval .= '<style type="text/css">';
			$retval .= '#om_menu, #om_menu dt, #om_menu dd.price { background-color:'.$background_color.' }';
			$retval .= '</style>';
		}

		// Only get Split On Global if shortcode isn't overriding
		if (!$split_on) {
			$split_on = 'group' ;
		}

		if ( !empty($omf_details) ) {
			include_once dirname(__FILE__).'/toolbox/class-omf-render.php'; 
			$render = new cOmfRender; 
			$render->disable_entities = true;
			$render->columns = $columns;
			$render->split_on = $split_on;
			$render->show_allergy_information = $show_allergy;
			$render->show_calories = $show_calories;
			$render->show_prices = !$hide_prices;
			$render->use_short_tag = $use_short_tag;
			$retval .= $render->get_menu_from_details($omf_details, $menu_filter, $group_filter);
			unset($render);
		}
		
		return $retval;
	}
	
}