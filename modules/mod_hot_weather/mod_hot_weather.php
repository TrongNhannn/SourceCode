<?php
/*------------------------------------------------------------------------
# "Hot Weather" Joomla module
# Copyright (C) 2009-2021 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: https://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$mosConfig_absolute_path = JPATH_SITE;
$mosConfig_live_site = JURI :: base();
if(substr($mosConfig_live_site, -1)=="/") { $mosConfig_live_site = substr($mosConfig_live_site, 0, -1); }
 
// get parameters from the module's configuration
$api_key = $params->get('api_key','');
$location = $params->get('location','London');
$state = $params->get('state','');
$country = $params->get('country','');
$units = $params->get('units','metric');
$temperature_feels = $params->get('temperature_feels','');
$temperature_min = $params->get('temperature_min','');
$temperature_max = $params->get('temperature_max','');
$pressure = $params->get('pressure','');
$humidity = $params->get('humidity','');
$visibility = $params->get('visibility','');
$wind = $params->get('wind','');
$module_id = $params->get('module_id','');
$direction = $params->get('direction','row');
$value_font = $params->get('value_font','2em');
$desc_font = $params->get('desc_font','1em');

require(JModuleHelper::getLayoutPath('mod_hot_weather'));