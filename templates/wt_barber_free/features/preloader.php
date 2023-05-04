<?php

/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die();

class HelixUltimateFeaturePreloader
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
        $this->position = 'preloader';
    }

	/**
	 * Render the contact features
	 * Fallback support Helix3 preloader
	 * @return	string
	 * @since	1.0.0
	 */
	public function renderFeature()
	{
        return '';
	} 
}
