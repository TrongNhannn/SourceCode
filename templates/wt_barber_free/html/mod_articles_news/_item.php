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
<div class="el-item uk-panel uk-margin-remove-first-child">

<div class="uk-child-width-expand uk-grid-small" uk-grid>

  <?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>
	<div class="uk-width-1-4">
	  <a href="<?php echo $item->link; ?>">
	  <div class="uk-inline-clip uk-transition-toggle">
  		<img class="el-image uk-transition-scale-up uk-transition-opaque" src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>">
	  </div>
	  </a>
	</div>
  <?php endif; ?>

<div class="uk-margin-remove-first-child">

  <?php if ($params->get('item_title')) : ?>
  	<?php $item_heading = $params->get('item_heading', 'h4'); ?>
  	<<?php echo $item_heading; ?> class="el-title uk-h5 uk-margin-remove-bottom<?php echo $params->get('moduleclass_sfx'); ?>">
  	<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
  		<a class="uk-link-text" href="<?php echo $item->link; ?>">
  			<?php echo $item->title; ?>
  		</a>
  	<?php else : ?>
  		<?php echo $item->title; ?>
  	<?php endif; ?>
  	</<?php echo $item_heading; ?>>
  <?php endif; ?>

  <?php if (!$params->get('intro_only')) : ?>
  	<?php echo $item->afterDisplayTitle; ?>
  <?php endif; ?>

  <?php echo $item->beforeDisplayContent; ?>

  <?php if ($params->get('show_introtext', 1)) : ?>
	<div class="el-content uk-panel uk-margin-top">
  		<?php echo $item->introtext; ?>
	</div>
  <?php endif; ?>

  <?php echo $item->afterDisplayContent; ?>

<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
	<?php echo '<p class="uk-margin-top"><a class="uk-button uk-button-primary" href="' . $item->link . '">' . $item->linkText . '</a></p>'; ?>
<?php endif; ?>

</div>
</div>
</div>
