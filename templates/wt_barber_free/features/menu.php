<?php
/**
 * @package Helix_Ultimate_Framework
 * @author JoomShaper <support@joomshaper.com>
 * @copyright Copyright (c) 2010 - 2020 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die();

require_once JPATH_PLUGINS. '/system/helixultimate/core/classes/menu.php';

/**
 * Helix Ultimate Menu class
 *
 * @since	1.0.0
 */
class HelixUltimateFeatureMenu
{
	/**
	 * Template parameters
	 *
	 * @var		object	$params		The parameters object
	 * @since	1.0.0
	 */
	private $params;

	/**
	 * Constructor function
	 *
	 * @param	object	$params		The template parameters
	 *
	 * @since	1.0.0
	 */
	public function __construct($params)
	{
		$this->params = $params;
		$this->position = 'menu';
		$this->load_pos = $this->params->get('menu_load_pos', 'default');
	}

	/**
	 * Render the menu features
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	public function renderFeature()
	{

		$output = '';
		$output .= '<div class="sp-megamenu-wrapper">';
		$menu = new HelixUltimateMenu('uk-navbar-nav','');
		$output .= $menu->render();
		$output .= '</div>';

		return $output;

	}
}
