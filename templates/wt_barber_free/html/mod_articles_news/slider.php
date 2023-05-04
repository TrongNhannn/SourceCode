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

<div class="uk-slider" uk-slider>

<div class="uk-position-relative uk-visible-toggle" tabindex="-1">

  <div class="uk-slider-container uk-slider-container-offset">

	<ul class="uk-slider-items uk-grid-match uk-grid">
		<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
			<?php $item = $list[$i]; ?>
			<li class="el-item uk-width-1-1 uk-width-1-3@m">
				<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_item_slider'); ?>
			</li>
		<?php endfor; ?>
	</ul>

 </div>

 <div class="uk-visible@l uk-hidden-hover uk-hidden-touch">
	<a class="uk-position-center-left-out" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
	<a class="uk-position-center-right-out" href="#" uk-slidenav-next uk-slider-item="next"></a>
 </div>

 </div>

<ul class="el-nav uk-slider-nav uk-dotnav uk-flex-center uk-margin-top uk-position-relative">
<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
			<?php $item = $list[$i]; ?>
			<li uk-slider-item="<?php echo $i; ?>">
			<a href></a>
			</li>
		<?php endfor; ?>
</ul>

</div>
 