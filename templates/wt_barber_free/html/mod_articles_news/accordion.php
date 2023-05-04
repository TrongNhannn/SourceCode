<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="uk-card uk-card-default uk-card-body uk-card-small">
<ul uk-accordion="collapsible: false">
	<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
		<?php $item = $list[$i]; ?>
		<li class="el-item uk-panel">
			<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_item_accordion'); ?>
		</li>
	<?php endfor; ?>
</ul>
</div>