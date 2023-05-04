<?php

/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die();

?>
<div class="search">
	<form class="uk-search uk-search-default" action="<?php echo JRoute::_('index.php'); ?>" method="post">
		<?php
		$output = '';

		$output .= '<span uk-search-icon></span>';

		$input  = '<input id="mod-search-searchword' . $module->id . '" name="searchword" class="uk-search-input" type="search" placeholder="' . JText::_("HELIX_ULTIMATE_SEARCH_FEATURE") . '">';
		$output .= $input;
		echo $output;

		?>
		<input type="hidden" name="task" value="search">
		<input type="hidden" name="option" value="com_search">
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>">
	</form>
</div>